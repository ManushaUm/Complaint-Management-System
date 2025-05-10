<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Branch;
use App\Models\ComplaintLog;
use App\Models\complaintType;
use App\Models\NewComplaint;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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

    public function summaryComplaint()
    {
        return view('reports.complaintsummary');
    }

    public function searchPolicies(Request $request)
    {
        $searchTerm = $request->input('term');

        $results = DB::table('new_complaints')
            ->select(
                'new_complaints.policy_number',
                'new_complaints.name'
            )
            ->where('new_complaints.policy_number', 'like', '%' . $searchTerm . '%')
            ->limit(10)
            ->get();

        return response()->json($results);
    }

    public function searchResults(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'policySearch' => 'required|string|min:2'
        ]);

        $searchTerm = $request->input('policySearch');

        // Search for complaints related to the policy number
        $complaints = DB::table('new_complaints')
            ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
            ->where('new_complaints.policy_number', 'like', '%' . $searchTerm . '%')
            ->orWhere('new_complaints.name', 'like', '%' . $searchTerm . '%')
            ->select(
                'new_complaints.*',
                'complaint_main.*'
            )
            ->get();

        return view('reports.results', [
            'complaints' => $complaints,
            'searchTerm' => $searchTerm
        ]);
    }

    public function downloadPDF($complaintId)
    {
        // Load the complaint with all related data
        $complaints = DB::table('complaint_logs')->select('complaint_logs.*')->where('Reference_number', $complaintId)->get();
        //dd($complaints);

        // Generate the PDF
        $pdf = Pdf::loadView('reports.pdf', compact('complaints'));

        // display in browser:
        return $pdf->stream();
        // Download the PDF with a filename
        return $pdf->download("complaint-{$complaints[0]->Reference_number}-report.pdf");
    }
    public function reportPdf(Request $request)
    {
        //dd($request->all());
        // Validate inputs
        $validated = $request->validate([
            'report_type' => 'required|string|in:1,2,3,4,5', // assuming these are your valid report types
            'date_range_preset' => 'required|string|in:custom,7,30,today', // make required and specify allowed values
            'start_date' => [
                'required_if:date_range_preset,custom',
                'date',
                'nullable'
            ],
            'end_date' => [
                'required_if:date_range_preset,custom',
                'date',
                'after_or_equal:start_date',
                'nullable'
            ],
            'complaint_type' => 'required|string',
            'customer_type' => 'required|string',
        ]);

        // Handle date ranges
        switch ($validated['date_range_preset']) {
            case 'custom':
                $validated['start_date'] = Carbon::parse($validated['start_date'])->startOfDay();
                $validated['end_date'] = Carbon::parse($validated['end_date'])->endOfDay();
                break;

            case '7':
                $validated['start_date'] = Carbon::now()->subDays(7)->startOfDay();
                $validated['end_date'] = Carbon::now()->endOfDay();
                break;

            case '30':
                $validated['start_date'] = Carbon::now()->subDays(30)->startOfDay();
                $validated['end_date'] = Carbon::now()->endOfDay();
                break;

            case 'today':
                $validated['start_date'] = Carbon::today()->startOfDay();
                $validated['end_date'] = Carbon::today()->endOfDay();
                break;
        }

        // Format dates consistently (optional)
        $validated['start_date'] = $validated['start_date']->format('Y-m-d H:i:s');
        $validated['end_date'] = $validated['end_date']->format('Y-m-d H:i:s');


        // Get filtered complaints
        if ($request->report_type == "1"  && $request->complaint_type == "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_logs.*'
                )
                ->get();
        } else if ($request->report_type == "1"  && $request->complaint_type != "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_logs.*'
                )
                ->get();
        } else if ($request->report_type == "1" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_logs.*'
                )
                ->get();
        } else if ($request->report_type == "1" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_logs.*'
                )
                ->get();
        } else if ($request->report_type == "1" && $request->complaint_type != "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_logs', 'new_complaints.id', '=', 'complaint_logs.Reference_number')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_logs.*'
                )
                ->get();
        }

        if ($request->report_type == "2"  && $request->complaint_type == "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'pending')
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "2"  && $request->complaint_type != "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'pending')
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "2" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'pending')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "2" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'pending')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "2" && $request->complaint_type != "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'pending')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        }

        if ($request->report_type == "3"  && $request->complaint_type == "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'in_progress')
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "3"  && $request->complaint_type != "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'in_progress')
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "3" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'in_progress')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "3" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'in_progress')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "3" && $request->complaint_type != "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'in_progress')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        }

        if ($request->report_type == "4"  && $request->complaint_type == "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'rejected')
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "4"  && $request->complaint_type != "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'rejected')
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "4" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'rejected')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "4" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'rejected')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "4" && $request->complaint_type != "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'rejected')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        }

        if ($request->report_type == "5"  && $request->complaint_type == "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'Closed')
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "5"  && $request->complaint_type != "all" && $request->customer_type == "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'Closed')
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "5" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'Closed')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "5" && $request->complaint_type == "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'Closed')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        } else if ($request->report_type == "5" && $request->complaint_type != "all" && $request->customer_type != "all") {
            //dd($validated);
            $complaints = DB::table('new_complaints')
                ->join('complaint_main', 'new_complaints.id', '=', 'complaint_main.reference')
                ->where('complaint_main.status', '=', 'Closed')
                ->where('new_complaints.customer_type', $validated['customer_type'])
                ->where('new_complaints.complaint_type', $validated['complaint_type'])
                ->whereBetween('new_complaints.complaint_date', [
                    $validated['start_date'],
                    $validated['end_date']
                ])
                ->select(
                    'new_complaints.*',
                    'complaint_main.*'
                )
                ->get();
        }
        //dd($complaints);

        // Generate PDF
        return Pdf::loadView('reports.reportpdf', [
            'reportType' => $validated['report_type'],
            'startDate' => $validated['start_date'],
            'endDate' => $validated['end_date'],
            'complaintType' => $validated['complaint_type'],
            'customerType' => $validated['customer_type'],
            'complaints' => $complaints,
        ])->stream();
    }
}
