<!DOCTYPE html>

<html>

<head>
	
	<title>Leave Rejected!</title>

</head>

<body>

	<h3>Leave Rejected (HRMS)</h3>

	<p><strong>Hi {{ $leaveRequest->employee->user->name}},</strong></p>

	<p>	Your leave application for the following date(s) - {{ $leaveRequest->start_date}} to {{ $leaveRequest->end_date}} have been rejected</p>
	
	<p>This is a system generated message.</p>

</body>

</html>