<!DOCTYPE html>
<html>
<head>
    <title>Students PDF</title>
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

        th, td {
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

<h2>Students - List PDF Report</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Class Name</th>
            <th>Teacher Name</th>
            <th>Assigned Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataTable as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->class->name }}</td>
                <td>{{ $student->teacher->name }}</td>
                <td>{{ $student->user->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
