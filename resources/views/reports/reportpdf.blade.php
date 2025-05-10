<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Complaints Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            /* Reduced font size */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            /* Reduced table font size */
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 6px;
            /* Reduced padding */
        }

        td {
            padding: 6px;
            /* Reduced padding */
            border-bottom: 1px solid #ddd;
        }

        .filters {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 8px;
            /* Reduced padding */
            font-size: 11px;
            /* Reduced font size */
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            /* Reduced font size */
            text-align: center;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Complaints Report</h1>
        <p>Generated on: {{ now()->format('Y-m-d') }}</p>
    </div>

    <div class="filters">
        <p><strong>Date Range:</strong>
            {{ \Carbon\Carbon::parse($startDate)->format('Y-m-d') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('Y-m-d') }}
        </p>
        @if($complaintType !== 'all')
        <p><strong>Complaint Type:</strong> {{ $complaintType }}</p>
        @endif
        @if($customerType !== 'all')
        <p><strong>Customer Type:</strong> {{$customerType}}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Ref Number</th>
                <th>Policy No.</th>
                <th>Customer</th>
                <th>Customer info</th>
                @if($complaintType == 'all')
                <th>Complaint Type</th>
                @endif
                @if($customerType == 'all')
                <th>Customer Type</th>
                @endif
                <th>Department</th>
                <th>Assigned to</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
            <tr>
                <td>{{ $complaint->Reference_number }}</td>
                <td>{{ $complaint->policy_number ?? 'N/A' }}</td>
                <td>{{ $complaint->name ?? 'N/A' }}</td>
                <td>{{ $complaint->contact_no ?? 'N/A' }}</td>
                @if($complaintType == 'all')
                <td>{{ $complaint->complaint_type ?? 'N/A' }}</td>
                @endif
                @if($customerType == 'all')
                <td>{{ $complaint->customer_type ?? 'N/A' }}</td>
                @endif
                <td>{{ $complaint->department ?? 'N/A' }}</td>
                <td>{{ $complaint->Assigned_to ?? 'N/A' }}</td>
                <td>{{ ucfirst($complaint->Status) }}</td>
                <td>{{ $complaint->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>This report was generated automatically by CI Lanka CMS.</p>
        <p>© {{ date('Y') }} CI Lanka CMS. All rights reserved.</p>
    </div>
</body>


</html>