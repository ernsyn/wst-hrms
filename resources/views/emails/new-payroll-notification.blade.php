<!DOCTYPE html>
<html>
<head>
	<title>New Payroll is Added</title>
</head>
<body>
	<p>Dear {{ $emailContent['name'] }},</p>

	<p>New payroll {{ $emailContent['payrollMonth'] }} is added. Please login into the Admin Portal to update bonus.</p>
	<br>
	<p>This is a system generated message.</p>

</body>
</html>