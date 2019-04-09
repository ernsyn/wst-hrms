<!DOCTYPE html>

<html>

<head>
	
	<title>New Leave Request Submission!</title>

</head>

<body>

		<h3>New Leave Request Submission!</h3>

		<p>Hi,</p>
	
		<p><strong>{{ $leaveRequestApproval->leave_request_approval_id->employee->user->name }}</strong> has applied for <strong>{{ $leaveRequestApproval->leave_request_approval_id->applied_days }} {{ $leaveRequestApproval->leave_request_approval_id->am_pm }}</strong> day(s) of leave, from <strong>{{ \Carbon\Carbon::parse($leaveRequestApproval->leave_request_approval_id->start_date)->format('d/m/Y') }}</strong> to <strong>{{ \Carbon\Carbon::parse($leaveRequestApproval->leave_request_approval_id->end_date)->format('d/m/Y') }}</strong>.</p>
	
		<p>The reason for the leave request is:</p>
	
		<p>{{ $leaveRequestApproval->leave_request_approval_id->reason }}</p>
	
		<p>Please login into HRMS Portal to approve/reject the leave request.</p>
	
		<p>This is a system generated message.</p>
	

</body>

</html>