<!DOCTYPE html>
<html>

<head>
    <title>Welcome to PreSkool</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            background-color: #8165e5;
            color: black;
            text-align: center;
            padding: 20px;
        }

        .content {
            padding: 20px;
        }

        .content p {
            margin: 0 0 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .content ul {
            list-style: none;
            padding: 0;
        }

        .content ul li {
            font-size: 16px;
            margin: 0 0 10px;
        }

        .footer {
            background-color: #8165e5;
            color: black;
            text-align: center;
            padding: 10px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to PreSkool!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            <p>Your login credentials for PreSkool are:</p>
            <ul>
                <li>Email: {{ $user->email }}</li>
                <li>Password: {{ $password }}</li>
            </ul>
            <p>You can log in using these credentials at the PreSkool website.</p>
        </div>
        <div class="footer">
            <p>Thanks for choosing PreSkool!</p>
        </div>
    </div>
</body>

</html>
