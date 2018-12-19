<!DOCTYPE html>

<html>

<head>
	
	<title>Holidays Generated for the New Year!</title>

</head>

<body>

	<h3>Holidays Generated for the New Year!</h3>

	<p>Hi Admin,</p>

	<p>The following annually repeated holidays have been generated for the following year:</p>

	<table cellpadding="3" cellspacing="0" border="1">
		<tr>
			<th align="left">Name</th>
			<th align="left">Star Date</th>
			<th align="left">End Date</th>
			<th align="left">Note</th>
			<th align="left">Total Days</th>
			<th align="left">State(s)</th>
		</tr>
		@foreach($emailContent as $row)
			<tr>
				<td>{{ $row['name'] }}</td>
				<td>{{ \Carbon\Carbon::parse($row['start_date'])->format('d/m/Y') }}</td>
				<td>{{ \Carbon\Carbon::parse($row['end_date'])->format('d/m/Y') }}</td>
				<td>{{ $row['note'] }}</td>
				<td>{{ $row['total_days'] }}</td>
				<td>{{ $row['state'] }}</td>
			</tr>
		@endforeach
	</table>

	<p>-------------------------------------------</p>

	<p>This is an auto-generated notification</p>

</body>

</html>