<!DOCTYPE html>
<html>
<head>
    <title>Teachers PDF</title>
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

<h2>Teachers - List PDF Report</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email ID</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Qualification</th>
            <th>Joining Date</th>
            <th>Address</th>
            <th>Zip Code</th>
            <th>Country</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataTable as $teacher)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $teacher['user']['name'] }}</td>
                <td>{{ $teacher['user']['email'] }}</td>
                <td>{{ $teacher['phone'] }}</td>
                <td>{{ $teacher['dob'] }}</td>
                <td>{{ config('custom.genderOptions')[$teacher['gender']] }}</td>
                <td>{{ $teacher['blood_group'] }}</td>
                <td>{{ $teacher['qualification'] }}</td>
                <td>{{ $teacher['joining_date'] }}</td>
                <td>{{ $teacher['address'] }}{{ $teacher['city'] }}</td>
                <td>{{ $teacher['zip_code'] }}</td>
                <td>{{ $teacher['country'] }}</td>
                <td>{{ $teacher['status'] == '1' ? 'Active' : 'Inactive' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
