<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title></title>
    <style>
    table {
        width: 100%;
    }
    th {
        border-top: 1px solid #000000;
        border-bottom: 1px solid #000000;
    }
    th, td {
        text-align: left;
    }
    </style>
</head>
<body>
	<table cellspacing="0" cellpadding="3">
		<tr>
			<th>No</th>
			@foreach($header as $title)
				<th>{{ $title }}</th>
			@endforeach
		</tr>
		@foreach($rows as $row)
		<tr>
			<td>{{ $loop->iteration }}</td>
			@foreach($row as $column)
			<td>{{ $column }}</td>
			@endforeach
		</tr>
		@endforeach
	</table>
</body>
</html>
