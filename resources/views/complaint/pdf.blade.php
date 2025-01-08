<!DOCTYPE html>
<html>

<head>
    <title>Complaint Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Complaint Details</h1>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $complaint->name }}</td>
        </tr>
        <tr>
            <th>Contact No</th>
            <td>{{ $complaint->contact_no }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $complaint->email }}</td>
        </tr>
        <tr>
            <th>Customer Type</th>
            <td>{{ $complaint->customer_type }}</td>
        </tr>
        <tr>
            <th>Policy Number</th>
            <td>{{ $complaint->policy_number }}</td>
        </tr>
        <tr>
            <th>Complaint Date</th>
            <td>{{ $complaint->complaint_date }}</td>
        </tr>
        <tr>
            <th>Complaint Detail</th>
            <td>{{ $complaint->complaint_detail }}</td>
        </tr>
    </table>
</body>

</html>