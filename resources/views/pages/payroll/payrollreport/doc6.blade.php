<table>
    <thead>
    <tr>
    	<td>PAYMENT DATE : (DD/MM/YYYY)</td>
    	<td valign="middle">{{ $data[0]['7'] }}</td>
    	<td></td>
    </tr>
    <tr>
       <th align="center" valign="middle">Payment Type/ Mode : LIP/LGP/LSP</th>
       <th align="center" valign="middle">Payment Amount </th>
       <th align="center" valign="middle">BIC </th>
       <th align="center" valign="middle">Bene Full Name</th>
       <th align="center" valign="middle">Bene Account No.</th>
       <th align="center" valign="middle">Payment Purpose</th>
       <th align="center" valign="middle">Bene Email</th>
       <th align="center" valign="middle">Bene Identification No / Passport</th>
       <th align="center" valign="middle">ID Type: NI, OI, PL, ML, PP, BR</th>
       <th align="center" valign="middle">Bene Mobile No.</th>
       <th align="center" valign="middle">Payor Corporation's Reference No.</th>
    </tr>
    <tr>
    	<th align="center" valign="middle">(M) - Char: 3 - A</th>
    	<th align="center" valign="middle">(M) - Char:        20 - N</th>
    	<th align="center" valign="middle">(M) - Char:      11 - A</th>
    	<th align="center" valign="middle">(M) - Char: 120 - A</th>
    	<th align="center" valign="middle">(M) - Char:20 - A</th>
    	<th align="center" valign="middle">(M) - Char: 50 - A</th>
    	<th align="center" valign="middle">(O) - Char: 30 - A</th>
    	<th align="center" valign="middle">(O) - Char: 18 - A</th>
    	<th align="center" valign="middle">(O) - Char: 2 - A</th>
    	<th align="center" valign="middle">(O) - Char: 15 - A</th>
    	<th align="center" valign="middle">(O) - Char: 16 - A</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
    	@if($loop->last)
         <tr>
        	<td>{{ $row['1'] }}</td>
        	<td>{{ $row['2'] }}</td>
        </tr>
        @else
        <tr>
        	<td>{{ $row['1'] }}</td>
        	<td>{{ $row['2'] }}</td>
        	<td>{{ $row['3'] }}</td>
        	<td>{{ $row['4'] }}</td>
        	<td>{{ $row['5'] }}</td>
        	<td>{{ $row['6'] }}</td>
        </tr>
     	@endif
        
    @endforeach
    </tbody>
</table>