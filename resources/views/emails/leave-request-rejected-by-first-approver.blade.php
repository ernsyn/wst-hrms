<!DOCTYPE html>

<html>

<head>
	
	<title>Leave Rejected!</title>

</head>

<body>

	<h3>Leave Rejected (HRMS)</h3>

	<p><strong>Hi {{ $leaveRequest->employee->user->name }},</strong></p>

	<p>Your leave request on the {{ $leaveRequest->start_date }} to {{ $leaveRequest->end_date }} has been rejected by the first/second level approver</p>
	<p>Please login into the HRMS Portal to check and/or approve the leave request.</p>

	<p>--------------------------------------------------------------</p>

	<p>This is an auto-generated leave request notification</p>

</body>

</html>