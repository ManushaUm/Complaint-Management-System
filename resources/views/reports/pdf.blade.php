<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Complaint Report #id</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #666;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background-color: #f5f5f5;
            padding: 5px 10px;
            font-weight: bold;
            border-left: 4px solid #3b82f6;
            margin-bottom: 10px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .details-table tr:last-child td {
            border-bottom: none;
        }

        .details-table .label {
            font-weight: bold;
            width: 30%;
            color: #555;
        }

        .log-entry {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ddd;
        }

        .log-entry:last-child {
            border-bottom: none;
        }

        .log-date {
            font-size: 12px;
            color: #666;
        }

        .log-user {
            font-weight: bold;
            color: #3b82f6;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #999;
        }
    </style>
</head>

<body>
    @foreach($complaints as $complaint)

    <div class="header">
        <h1>Complaint Report</h1>
        <p>Generated on {{ now()->format('F j, Y \a\t h:i A') }}</p>
    </div>

    <div class="section">
        <div class="section-title">Complaint Details</div>
        <table class="details-table">
            <tr>
                <td class="label">Complaint ID:</td>
                <td>#{{ $complaint->Reference_number }}</td>
            </tr>
            <tr>
                <td class="label">Status:</td>
                <td>

                    <span>
                        {{ ucfirst($complaint->Status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Created Date:</td>
                <td>{{ $complaint->created_at}}</td>
            </tr>
            <tr>
                <td class="label">Last Updated:</td>
                <td>{{ $complaint->updated_at }}</td>
            </tr>
            <tr>
                <td class="label">Priority:</td>
                <td>N/A</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Policy Information</div>
        <table class="details-table">
            <tr>
                <td class="label">Policy Number:</td>
                <td></td>
            </tr>
            <tr>
                <td class="label">Customer Name:</td>
                <td>N/A</td>
            </tr>
            <tr>
                <td class="label">Customer Contact:</td>
                <td>N/A</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Complaint Description</div>
        <div style="padding: 10px; background-color: #f9f9f9; border-radius: 4px;">

        </div>
    </div>

    @if($complaint->Assigned_to)
    <div class="section">
        <div class="section-title">Assigned To</div>
        <table class="details-table">
            <tr>
                <td class="label">Employee:</td>
                <td>{{ $complaint->Assigned_to }}</td>
            </tr>
            <tr>
                <td class="label">Department:</td>
                <td></td>
            </tr>
        </table>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Resolution Logs</div>

        <div style="color: #666; font-style: italic; padding: 10px;">
            No resolution logs available for this complaint.
        </div>

    </div>

    <div class="footer">
        <p>This report was generated automatically by {{ config('app.name') }}.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
    @endforeach
</body>

</html>