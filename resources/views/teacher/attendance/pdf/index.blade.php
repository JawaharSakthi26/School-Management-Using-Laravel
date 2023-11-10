<!DOCTYPE html>
<html>

<head>
    <title>My Students PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 6px;
            font-size: 10px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Class Attendance PDF Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Attendance Date</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late Entry</th>
                <th>Permission</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataTable as $index => $attendance)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance['attendance_date'])->format('M d, Y') }}</td>
                    <td>{{ $attendance->statuses->where('status', 1)->count() }}</td>
                    <td>{{ $attendance->statuses->where('status', 2)->count() }}</td>
                    <td>{{ $attendance->statuses->where('status', 3)->count() }}</td>
                    <td>{{ $attendance->statuses->where('status', 4)->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
