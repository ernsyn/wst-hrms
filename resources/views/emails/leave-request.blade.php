<!DOCTYPE html>

<html>

<head>
	
	<title>New Leave Request Submission!</title>

</head>

<body>

	<h3>New Leave Request Submission!</h3>

	<p>Hi,</p>

	<p><strong>{{ $name }}</strong> has applied for <strong>{{ $applied_days }} {{ $am_pm }}</strong> day(s) of leave, from <strong>{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}</strong> to <strong>{{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</strong>.</p>

	<p>The reason for the leave request is:</p>

	<p>{{ $reason }}</p>

	<p>Please login into HRMS Portal to approve/reject the leave request.</p>

	<p>This is a system generated message.</p>

</body>

</html>