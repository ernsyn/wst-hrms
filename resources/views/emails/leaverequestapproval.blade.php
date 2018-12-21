<!DOCTYPE html>

<html>

<head>
	
	<title>Leave Approval!</title>

</head>

<body>

	<h3>Leave Approval!</h3>

	<p>Hi,</p>

	<p><strong>{{ $user->name }}</strong> has applied for <strong>{{ $leaveRequest->applied_days }} {{ $leaveRequest->am_pm }}</strong> day(s) of leave, from <strong>{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}</strong> to <strong>{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}</strong>.</p>

	<p>The reason for the leave request is:</p>

	<p><strong>{{ $leaveRequest->reason }}</strong></p>

	<p>Please login into the Admin Portal to check and/or approve the leave request.</p>

	<p>--------------------------------------------------------------</p>

	<p>This is an auto-generated leave request notification</p>

</body>

</html>