<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title></title>
    <style>
        /*        table, td, th {
                    border: 1px solid black;
                }*/
        .table-border{
            border: 1px solid grey;
        }

        /*        .table-border-all table, td, th{
                    border: 1px solid grey;
                }*/

        .padded td.pleft { padding-left:3pt; }
        .padded td.pright { padding-right:3pt; }

        .padded td.pleft5 { padding-left:5pt; }
        .padded td.pright5 { padding-right:5pt; }

        .padded td.pleft10 { padding-left:10pt; }
        .padded td.pright10 { padding-right:10pt; }

        .padded td.pleft15 { padding-left:15pt; }

        .padded th.pleft { padding-left:3pt; }
        .padded th.pleft10 { padding-left:10pt; }
        .padded th.pleft15 { padding-left:15pt; }

        .blank_row
        {
            height: 10pt !important; /* overwrites any other rules */
            background-color: #FFFFFF;
        }

        body {
            font-family: Arial;
            font-size: 11pt;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .border_bottom{
            border-bottom-style: solid;
            border-bottom-color: grey;
            border-bottom-width: 1px;
        }

        .border_right{
            border-right-style: solid;
            border-right-color: grey;
            border-right-width: 1px;
        }

        .border_left{
            border-left-style: solid;
            border-left-color: grey;
            border-left-width: 1px;
        }

        .border_top{
            border-top-style: solid;
            border-top-color: grey;
            border-top-width: 1px;
        }

        th {
            text-align: left;
        }

        .text_center{
            text-align: center;
        }

        .text_right{
            text-align: right;
            padding-right: 3pt;
        }

        .text_left{
            text-align: left;
        }

        .text_bold{
            font-weight: bold;
        }

        td:empty:after{
            content: "\00a0";
        }

        .table-small{
            width: 200pt;
        }

        .table-header-black{
            background-color: #000000;
            color: #FFFFFF;
            padding-left: 3pt;
        }

        .table-header-grey{
            background-color: #E5E5E5;
            color: #000000;
            padding-left: 3pt;
            text-align: center;
            font-weight: bold;
        }

        .d-table {
            display: table;
            width:100%;
        }

        .d-row { display:table-row; }

        .d-cell {
            display:table-cell;
            width: 50%;
        }

        .d-cell-1 {
            display:table-cell;
        }

        .empty_row5{
            height:5pt;
        }

        .empty_row{
            height:15pt;
        }

        .empty_row30{
            height:30pt;
        }

    </style>
</head>
<body>
<div id="page-container">

    <table class="padded" style="margin-top: 10pt;">
        <tr>
            <th class="tg-s268" width="30%"></th>
            <th class="text_center" width="40%" style="font-size: 18pt;">PUSAT KUTIPAN ZAKAT</th>
            <th class="text_right pright" width="30%"></th>
        </tr>
        <tr class="">
            <td class="tg-s268"></td>
            <th class="text_center"></th>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <th class="text_center">BORANG BAYARAN ZAKAT BULANAN</th>
            <th class="text_right pright"></th>
        </tr>
    </table>

    <table class="padded" style="margin-top: 20pt;">
        <tr>
            <td class="tg-s268" width="2%"></td>
            <td class="text_right pright">Nama Majikan</td>
            <td class="table-border pleft5" colspan="5">{{$data->getCompanyName()}} {{$data->getCompanyBusinessRegistrationNo()}}</td>
            <td class="tg-s268" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268" width="2%"></td>
            <td class="text_right pright">Alamat</td>
            <td class="border_right border_left pleft5" colspan="5">{{$data->getCompanyAddress1()}}</td>
            <td class="tg-s268" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268" width="2%"></td>
            <td class="text_right pright"></td>
            <td class="border_right border_left pleft5" colspan="5">{{$data->getCompanyAddress2()}}</td>
            <td class="tg-s268" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268" width="2%"></td>
            <td class="text_right pright"></td>
            <td class="border_right border_left pleft5" colspan="5">{{$data->getCompanyAddress3()}} Poskod: {{$data->getCompanyPostcode()}}</td>
            <td class="tg-s268" width="2%"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-s268" width="2%"></td>
            <td class="text_right pright"></td>
            <td class="border_right border_left pleft5" colspan="5"></td>
            <td class="tg-s268" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268" width="2%"></td>
            <td class="tg-s268" width="16%"></td>
            <td class="table-border pleft5 text_bold" width="16%">Kod Majikan</td>
            <td class="table-border pleft5 text_bold" width="16%">Bulan</td>
            <td class="table-border pleft5 text_bold" width="16%">Nama Bank</td>
            <td class="table-border pleft5 text_bold" width="16%">No. Cek</td>
            <td class="table-border text_right pright5 text_bold" width="16%">Jumlah (RM)</td>
            <td class="tg-0lax" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="table-border pleft5">{{$data->getEmployerCodeNo()}}</td>
            <td class="table-border pleft5">{{$data->getMonth()}}</td>
            <td class="table-border pleft5">{{$data->getBankName()}}</td>
            <td class="table-border pleft5">{{$data->getCheckNo()}}</td>
            <td class="table-border text_right pright5 text_bold">{{number_format($data->getTotalAmount(),2)}}</td>
            <td class="tg-0lax"></td>
        </tr>
    </table>

    <!-- page 2 -->
    @php
    $total_items = count($empData);
    $num_per_page = 25;
    $num_pages = ceil($total_items / $num_per_page);
    $count=0;
    $start=0;
    $end=$num_per_page;
    $cur_page=1;

    //total amount
    $totalAmount=0;
    @endphp

    @for($i=0; $i<$num_pages; $i++)
    @php
    if($i != 0){
    $start += $num_per_page;
    }

    //amount
    $amount=0;
    @endphp

    @if($cur_page > 1)
    <div style="page-break-before:always">&nbsp;</div>
    @endif

    <table class="padded" style="margin-top: 30pt;">
        <tr>
            <th class="table-border pleft" rowspan="2">Bil </th>
            <th class="table-border pleft" rowspan="2">No. Kad
                <br>Pengenalan Lama
            </th>
            <th class="table-border pleft" rowspan="2">No. Kad
                <br>Pengenalan Baru
            </th>
            <th class="table-border pleft" rowspan="2">Nama Pembayar
                <br>&nbsp;
            </th>
            <th class="table-border text_right pright" rowspan="2">Jumlah
                <br>(RM)
            </th>
            <th class="table-border pleft" rowspan="2">Jenis Zakat
                <br>&nbsp;
            </th>
        </tr>
        <tr>
        </tr>
        @foreach(array_slice($empData,$start,$end) as $emp )
        <tr>
            <td class="table-border pleft">{{$count+1}}</td>
            <td class="table-border pleft">{{$emp->getEmployeeOldIcNo()}}</td>
            <td class="table-border pleft">{{$emp->getEmployeeNewIcNo()}}</td>
            <td class="table-border pleft">{{$emp->getEmployeeName()}}</td>
            <td class="table-border text_right pright">{{number_format($emp->getEmployeeAmount(),2)}}</td>
            <td class="table-border pleft">{{$emp->getZakatType()}}</td>
        </tr>
        @php
        $count++
        @endphp
        @endforeach

        @if($cur_page == $num_pages)
        <tr>
            <th class="table-border pleft"></th>
            <th class="table-border pleft"></th>
            <th class="table-border pleft"></th>
            <th class="table-border pleft">Jumlah Besar</th>
            <th class="table-border text_right pright">{{number_format($data->getTotalAmount(),2)}}</th>
            <th class="table-border pleft"></th>
        </tr>
        @endif
    </table>

    <table class="padded" style="margin-top: 30pt;">
        <tr>
            <td width="2%"></td>
            <td>Maklumat Wakil Majikan :</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td width="2%"></td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 30pt;">
        <tr>
            <td width="2%"></td>
            <td width="13%">Tandatangan
                <div style="float: right">:</div>
            </td>
            <td class="border_bottom pleft" width="40%"></td>
            <td width="10%"></td>
            <td width="20%"></td>
            <td width="10%"></td>
            <td width="2%"></td>
        </tr>
        <tr>
            <td></td>
            <td>Nama Penuh
                <div style="float: right">:</div>
            </td>
            <td class="border_bottom pleft">{{$data->getOfficerName()}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>No K.P.
                <div style="float: right">:</div>
            </td>
            <td class="border_bottom pleft">{{$data->getOfficerIcNo()}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Jawatan
                <div style="float: right">:</div>
            </td>
            <td class="border_bottom pleft">{{$data->getOfficerPosition()}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>No Telefon
                <div style="float: right">:</div>
            </td>
            <td class="border_bottom pleft">{{$data->getOfficerNoTel()}}</td>
            <td></td>
            <td class="border_bottom" colspan="2"></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td> E-mel
                <div style="float: right">:</div>
            </td>
            <td class="border_bottom pleft">{{$data->getOfficerEmail()}}</td>
            <td></td>
            <td class="">Cop Rasmi Majikan</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    @php($cur_page++)
    @endfor
</div>
</body>
</html>
