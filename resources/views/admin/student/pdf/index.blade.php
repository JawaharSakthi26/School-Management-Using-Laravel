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
            <th>Admission ID</th>
            <th>Roll Number</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Class</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Religion</th>
            <th>Address</th>
            <th>Zipcode</th>
            <th>Country</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataTable as $student)
            <tr>
                <td>{{ $student->admission_id }}</td>
                <td>{{ $student['roll_number'] }}</td>
                <td>{{ $student['user']['name'] }}</td>
                <td>{{ $student['user']['email'] }}</td>
                <td>{{ $student['phone'] }}</td>
                <td>{{ $student['class']['name'] }}</td>
                <td>{{ config('custom.genderOptions')[$student['gender']] }}</td>
                <td>{{ $student['dob'] }}</td>
                <td>{{ config('custom.religionOptions')[$student['religion']] }}</td>
                <td>{{ $student['address'] }}{{ $student['city'] }}</td>
                <td>{{ $student['zip_code'] }}</td>
                <td>{{ $student['country'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
