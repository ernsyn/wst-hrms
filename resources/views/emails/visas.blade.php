<!DOCTYPE html>

<html>

<head>
	
	<title>Visas Expired Date!</title>

</head>

<body>

	<h3>Visas Expired Date!</h3>

	<p>Hi Admin,</p>

	<p>The following employee's visa going to expired(less than 6 months):</p>

	<table cellpadding="3" cellspacing="0" border="1">
		<tr>
			<th align="left">Name</th>
			<th align="left">Employee</th>
			<th align="left">Star Date</th>


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