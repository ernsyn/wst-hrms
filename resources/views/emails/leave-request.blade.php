<!DOCTYPE html>

<html>

<head>
	
	<title>New Leave Request Submission!</title>

</head>

<body>

	<h3>New Leave Request Submission!</h3>

	<p>Hi,</p>

	<p><strong>{{ $leaveRequest->employee->user->name }}</strong> has applied for <strong>{{ $leaveRequest->applied_days }} {{ $leaveRequest->am_pm }}</strong> day(s) of leave, from <strong>{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}</strong> to <strong>{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}</strong>.</p>

	<p>The reason for the leave request is:</p>

	<p>{{ $leaveRequest->reason }}</p>

	<p>Please login into HRMS Portal to approve/reject the leave request.</p>

	<p>This is a system generated message.</p>

</body>

</html>