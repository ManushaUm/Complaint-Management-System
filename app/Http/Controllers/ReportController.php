<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\complaintType;
use App\Models\NewComplaint;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function index()
    {
        $complaintTypes = complaintType::all();
        $branches = Branch::all();
        //dd($branches);
        return view('reports.index', compact('branches', 'complaintTypes'));
    }

    public function summary(Request $request)
    {

        //dd($request->all());
        // Default to last 7 days if no duration is specified
        $duration = $request->input('duration', '7');

        // Calculate date range based on duration
        $now = Carbon::now();

        switch ($duration) {
            case 'today':
                $startDate = $now->startOfDay();
                $endDate = $now->copy()->endOfDay();
                break;
            case '7':
                $startDate = $now->copy()->subDays(7);
                $endDate = $now->copy();
                break;
            case '30':
                $startDate = $now->copy()->subDays(30);
                $endDate = $now->copy();
                break;
            case 'custom':
                $startDate = Carbon::parse($request->input('start_date'));
                $endDate = Carbon::parse($request->input('end_date'));
                break;
            default:
                $startDate = $now->copy()->subDays(7);
                $endDate = $now->copy();
        }

        // Get summary data grouped by complaint type and status
        $complaints = DB::table('new_complaints')
            ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
            ->whereBetween('new_complaints.complaint_date', [$startDate, $endDate])
            ->select(
                'new_complaints.complaint_type',
                'complaint_main.status',
                DB::raw('count(*) as count')
            )
            ->groupBy('new_complaints.complaint_type', 'complaint_main.status')
            ->get();
        //dd($complaints);
        // Transform the data into the required format
        $summary = [];

        foreach ($complaints as $complaint) {
            $typeKey = strtolower(str_replace([' ', '-'], '_', $complaint->complaint_type));
            $statusKey = strtolower(str_replace(' ', '_', $complaint->status));

            if (!isset($summary[$typeKey])) {
                $summary[$typeKey] = [];
            }

            $summary[$typeKey][$statusKey] = [
                'count' => $complaint->count
            ];
        }

        // Ensure all categories exist in the response
        $categories = [
            'marketing_and_sales',
            'motor_underwriting',
            'non_motor_underwriting',
            'motor_claims',
            'non_motor_claims',
            'policy_serving',
            'premium',
            'others'
        ];

        foreach ($categories as $category) {
            if (!isset($summary[$category])) {
                $summary[$category] = [
                    'received' => ['count' => 0],
                    'in_progress' => ['count' => 0],
                    'declined' => ['count' => 0],
                    'recommend_to_close' => ['count' => 0],
                    'refer_to_ceo' => ['count' => 0],
                    'closed' => ['count' => 0]
                ];
            } else {
                // Ensure all statuses exist for each category
                $statuses = [
                    'received',
                    'in_progress',
                    'in-progress',
                    'declined',
                    'recommend_to_close',
                    'recommend to close',
                    'refer_to_ceo',
                    'refer to ceo',
                    'closed'
                ];

                foreach ($statuses as $status) {
                    $normalizedStatus = str_replace(' ', '_', $status);
                    if (!isset($summary[$category][$normalizedStatus])) {
                        $summary[$category][$normalizedStatus] = ['count' => 0];
                    }
                }
            }
        }

        // Handle AJAX request
        if ($request->ajax()) {
            return response()->json([
                'summary' => $summary,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d')
            ]);
        }

        // For non-AJAX requests (fallback)
        $complaintTypes = complaintType::all();
        $branches = Branch::all();
        //dd($summary);
        return view('reports.summary', compact(
            'branches',
            'complaintTypes',
            'summary',
            'startDate',
            'endDate'
        ));
    }

    public function generateReport(Request $request)
    {
        dd($request->all());
        // Validate the request data
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'complaint_type_id' => 'required|exists:complaint_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Retrieve the validated data
        $data = $request->only(['branch_id', 'complaint_type_id', 'start_date', 'end_date']);

        // Generate the report based on the provided data
        // You can implement your report generation logic here

        return redirect()->back()->with('success', 'Report generated successfully!');
    }

    public function complaints()
    {
        //getting HR data
        $hrData = DB::table('hr')->select('emp_id', 'full_name')->get();
        //dd($hrData);
        $complaints = DB::table('new_complaints')
            ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
            ->select(
                'new_complaints.*',
                'complaint_main.*'
            )
            ->get();
        //dd($complaints);

        //call the latest logs
        $NewComplaintsI = new NewComplaint();
        $latestLogs = $NewComplaintsI->getLatestLogs()->map(function ($log) {
            $log->employee = DB::table('hr')->where('emp_id', $log->Assigned_to)->first();
            return $log;
        });


        //dd($latestLogs);

        return view('reports.complaints', compact('complaints', 'latestLogs', 'hrData'));
    }
}
