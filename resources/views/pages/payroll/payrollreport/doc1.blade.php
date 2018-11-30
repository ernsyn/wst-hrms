<!DOCTYPE html>
<html>
<head>
<title></title>
<style type="text/css">
.text-right {
	text-align: right;
}

.text-left {
	text-align: left;
}

.text-center {
	text-align: center;
}

.w-1p {
	width: 1%;
}

.w-2p {
	width: 2%;
}

.w-3p {
	width: 3%;
}

.w-4p {
	width: 4%;
}

.w-5p {
	width: 5%;
}

.w-10p {
	width: 10%;
}

.w-15p {
	width: 15%;
}

.w-20p {
	width: 20%;
}

.w-25p {
	width: 25%;
}

.w-30p {
	width: 30%;
}

.w-35p {
	width: 35%;
}

.w-40p {
	width: 40%;
}

.w-45p {
	width: 45%;
}

.w-50p {
	width: 50%;
}

.w-55p {
	width: 55%;
}

.w-60p {
	width: 60%;
}

.w-65p {
	width: 65%;
}

.w-70p {
	width: 70%;
}

.w-75p {
	width: 75%;
}

.w-80p {
	width: 80%;
}

.w-85p {
	width: 85%;
}

.w-90p {
	width: 90%;
}

.w-95p {
	width: 95%;
}

.w-100p {
	width: 100%;
}

.black-top-border {
	border-top: 1px solid black;
}

.black-bottom-border {
	border-bottom: 1px solid black;
}

.bold {
	font-weight: bold;
}
</style>
</head>
<body>
	<table style="font-weight: bold; margin-bottom: 10px;" cellspacing="0"
		cellpadding="1">
		<tbody>
			<tr>
				<td class="w-15p">COMPANY</td>
				<td class="w-1p">:</td>
				<td class="w-40p">'.$company->name.'
					('.$company->registration_number.')</td>
				<td class="text-right">Date:
					'.date_format(date_create(date('Y-m-d')), 'd-M-Y (D) H:i A').'
					Page: {PAGENO}</td>
			</tr>
			<tr>
				<td class="w-15p">FORMELY KNOWN</td>
				<td class="w-1p">:</td>
				<td class="w-40p">NO CUKAI PENDAPATAN: C2304727002</td>
				<td></td>
			</tr>
			<tr>
				<td class="w-15p">REPORT TITLE</td>
				<td class="w-1p">:</td>
				<td class="w-40p">MONTH-TO-DATE PAYROLL SUMMARY</td>
				<td></td>
			</tr>
			<tr>
				<td class="w-15p">SORTED BY</td>
				<td class="w-1p">:</td>
				<td class="w-40p">DEPARTMENT</td>
				<td></td>
			</tr>
			<tr>
				<td class="w-15p">PERIOD</td>
				<td>:</td>
				<td class="w-40p">'.$period.'</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>
</html>