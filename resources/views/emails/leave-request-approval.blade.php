<!DOCTYPE html>

<html>

<head>
	
	<title>Leave Approval!</title>

</head>

<body>

	<h3>Leave Approval (HRMS)</h3>

	<p><strong>Hi {{ $leaveRequestApproval->employee->user->name}},</strong></p>

	<p>	Your leave application for the following date(s) - {{ $leaveRequestApproval->leave_request_approval_id->start_date}} to {{ $leaveRequestApproval->leave_request_approval_id->end_date}} have been approved</p>
	
	<p>This is a system generated message.</p>

</body>

</html>