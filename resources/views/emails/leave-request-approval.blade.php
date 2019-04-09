<!DOCTYPE html>

<html>

<head>
	
	<title>Leave Approval!</title>

</head>

<body>

	<h3>Leave Approval (HRMS)</h3>

	<p><strong>Hi {{ $leaveRequestApproval->leave_request_approval_id->employee->user->name}},</strong></p>
	
	<p>Your leave application for the following date(s) from <strong>{{ \Carbon\Carbon::parse($leaveRequestApproval->leave_request_approval_id->start_date)->format('d/m/Y') }}</strong> to <strong>{{ \Carbon\Carbon::parse($leaveRequestApproval->leave_request_approval_id->end_date)->format('d/m/Y') }}</strong> have been approved</p>
	
	<p>This is a system generated message.</p>

</body>

</html>