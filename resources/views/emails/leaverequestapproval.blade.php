<!DOCTYPE html>

<html>

<head>
	
	<title>Leave Approval!</title>

</head>

<body>

	<h3>Leave Approval (HRMS)</h3>

	<p>Hi,</p>

	<p><strong>{{ $leaveRequestApproval->approved_by->user->name}}</strong>
	<p>Leave request by {{ $leaveRequestApproval->leave_request_approval_id->employee->user->name}}  have been approved </p>
	<p>Please login into the Admin Portal to check and/or approve the leave request.</p>

	<p>--------------------------------------------------------------</p>

	<p>This is an auto-generated leave request notification</p>

</body>

</html>