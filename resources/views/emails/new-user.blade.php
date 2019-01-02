<!DOCTYPE html>
<html>
<head>
	<title>OPPO HRMS System Access</title>
</head>

<body>
	<p>Dear {{ $emailContent['name']}},</p>

	<p>An account has been created for you to access the new OPPO HRMS System. Please find below the details for your usage.<p>

	<p>URL:  http://14.192.70.153/<br>
    Username: {{ $emailContent['email']}}<br>
    Password: {{ $emailContent['password']}}<br>
    </p>
	<br>
	<p>This is a system generated message.</p>

</body>

</html>