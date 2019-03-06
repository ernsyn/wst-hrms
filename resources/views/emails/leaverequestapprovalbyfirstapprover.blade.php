<!DOCTYPE html>

<html>

<head>
	
	<title>Leave Approval!</title>

</head>

<body>

	<h3>Leave Approval (HRMS)</h3>

	<p><strong>Hi {{ $leaveRequestApproval->leave_request_approval_id->employee->user->name}},</strong></p>

	<p>Leave request by {{ $leaveRequestApproval->leave_request_approval_id->employee->user->name}} on the {{ $leaveRequestApproval->leave_request_approval_id->start_date}} to {{ $leaveRequestApproval->leave_request_approval_id->end_date}} have been approved by first approver ({{ $leaveRequestApproval->approved_by->user->name}})</p>
	<p>Please login into the HRMS Portal to check and/or approve the leave request.</p>

	<p>--------------------------------------------------------------</p>

	<p>This is an auto-generated leave request notification</p>

</body>

</html>