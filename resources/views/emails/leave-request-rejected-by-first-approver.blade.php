<!DOCTYPE html>

<html>

<head>
	
	<title>Leave Rejected!</title>

</head>

<body>

	<h3>Leave Rejected (HRMS)</h3>

	<p><strong>Hi {{ $leaveRequest->employee->user->name}},</strong></p>
	
	<p>Your leave application for the following date(s) from <strong>{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}</strong> to <strong>{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}</strong> have been rejected</p>
	
	<p>This is a system generated message.</p>

</body>

</html>