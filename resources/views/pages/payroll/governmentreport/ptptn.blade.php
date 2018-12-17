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
            font-size: 11pt;
            font-family: Arial;
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
            <td class="tg-s268" width="20%" rowspan="3">
                <img style="display:block;width: 130pt;height: 65pt;" alt="" src="{{asset('img/report/ptptn-logo.png')}}"/>
            </td>
            <td class="text_center text_bold" width="60%">PERBADANAN TABUNG PENDIDIKAN TINGGI NASIONAL (PTPTN)</td>
            <td class="text_right pright text_bold" width="20%" style="font-size: 20pt" rowspan="2">PTPTN</td>
        </tr>
        <tr class="">
            <th class="text_center">BORANG POTONGAN GAJI PTPTN OLEH MAJIKAN</th>
        </tr>
        <tr>
            <th class="text_center"></th>
            <th class="text_right pright" valign="top">P-04/15-2015</th>
        </tr>
    </table>

    <table class="padded" style="margin-top: 20pt;">
        <tr>
            <th class="tg-s268" width="25%">POTONGAN BAGI BULAN:</th>
            <th class="border_bottom pleft" width="20%">{{$data->getMonth()}}</th>
            <th class="" width="10%"></th>
            <th class="" width="10%">TAHUN :</th>
            <th class="border_bottom pleft" width="10%">{{$data->getYear()}}</th>
            <th class="pleft"></th>
        </tr>
        <tr>
            <th class="tg-s268">NO. RUJUKAN MAJIKAN :</th>
            <th class="border_bottom pleft">{{$data->getEmployerReferenceNo()}}</th>
            <th class=""></th>
            <th class=""></th>
            <th class="pleft"></th>
        </tr>
    </table>

    <table class="padded" style="margin-top: 20pt;">
        <tr>
            <th class="table-border table-header-grey" width="45%" >NAMA & ALAMAT MAJIKAN</th>
            <th class="" width="10%"></th>
            <th class="table-border table-header-grey" width="45%" colspan="2">PEGAWAI YANG MENYEDIAKAN BORANG</th>
        </tr>
        <tr>
            <td class="border_right border_left pleft">{{$data->getCompanyName()}}</td>
            <td class=""></td>
            <td class="border_left pleft">Nama</td>
            <td class="border_right">: {{$data->getOfficerName()}}</td>
        </tr>
        <tr>
            <td class="border_right border_left pleft">{{$data->getCompanyAddress1()}}</td>
            <td class=""></td>
            <td class="border_left pleft">Jawatan </td>
            <td class="border_right">: {{$data->getOfficerPosition()}}</td>
        </tr>
        <tr>
            <td class="border_right border_left pleft">{{$data->getCompanyAddress2()}}</td>
            <td class=""></td>
            <td class="border_left pleft">No Telefon</td>
            <td class="border_right">: {{$data->getOfficerNoTel()}}</td>
        </tr>
        <tr>
            <td class="border_right border_left pleft">{{$data->getCompanyAddress3()}} Poskod: 46200  </td>
            <td class=""></td>
            <td class="border_left pleft">Email</td>
            <td class="border_right">: {{$data->getOfficerEmail()}}</td>
        </tr>
        <tr>
            <td class="border_right border_left pleft border_bottom">No. Pendaftaran Perniagaan:{{$data->getCompanyBusinessRegistrationNo()}} </td>
            <td class=""></td>
            <td class="border_left pleft border_bottom"></td>
            <td class="border_right border_bottom"></td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 20pt;">
        <tr>
            <th class="table-border table-header-grey" colspan="5">Maklumat Bayaran</th>
        </tr>
        <tr>
            <td class="border_left pleft" colspan="2">PINDAHAN DANA ELEKTRONIK</td>
            <td class="text_center">-atau-</td>
            <td class="border_right pleft" colspan="2">CEK</td>
        </tr>
        <tr>
            <td class="border_left pleft" width="20%">Tarikh Pindahan: </td>
            <td class="border_bottom pleft" width="25%">{{$data->getTransferDate()}}</td>
            <td class="" width="10%"></td>
            <td class="pleft" width="25%">Nombor Cek:</td>
            <td class="border_bottom border_right pleft" width="20%">{{$data->getCheckNo()}}</td>
        </tr>
        <tr>
            <td class="border_left pleft">No. Rujukan Pindahan: </td>
            <td class="border_bottom pleft">{{$data->getTransferReferenceNo()}}</td>
            <td class=""></td>
            <td class="pleft">Bank Pengeluar Cek:</td>
            <td class="border_bottom border_right pleft">{{$data->getBankProduceCheck()}}</td>
        </tr>
        <tr>
            <td class="border_left pleft">Amaun Pindahan: </td>
            <td class="border_bottom pleft">{{$data->getTransferAmount()}}</td>
            <td class=""></td>
            <td class="pleft">Tarikh Cek: </td>
            <td class="border_bottom border_right pleft">{{$data->getCheckDate()}}</td>
        </tr>
        <tr>
            <td class="border_left pleft"></td>
            <td class="border_bottom pleft"></td>
            <td class=""></td>
            <td class="pleft">Amaun Cek:</td>
            <td class="border_bottom border_right pleft">{{number_format($totalCheckAmount,2)}}</td>
        </tr>
        <tr>
            <td class="border_left pleft"></td>
            <td class="border_bottom pleft"></td>
            <td class=""></td>
            <td class="pleft">Tarikh Pos Cek ke PTPTN HQ:</td>
            <td class="border_bottom border_right pleft">{{$data->getCheckPostDateToPTPTN()}}</td>
        </tr>
        <tr>
            <td class="border_left pleft"></td>
            <td class="border_bottom pleft"></td>
            <td class=""></td>
            <td class="pleft">Tarikh Deposit Cek*:</td>
            <td class="border_bottom border_right pleft">{{$data->getCheckDepositDate()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="border_left border_right empty_row" colspan="5"></td>
        </tr>
    </table>

    <!-- page 2 -->
    @php
    $total_items = count($empData);
    $num_per_page = 15;
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
            <th class="table-border pleft">BIL </th>
            <th class="table-border pleft">NO KP PEKERJA </th>
            <th class="table-border pleft">NAMA PEKERJA</th>
            <th class="table-border text_right pright">AMAUN (RM)</th>
            <th class="table-border pleft">NO. PEKERJA</th>
        </tr>
        @foreach(array_slice($empData,$start,$end) as $emp )
        <tr>
            <td class="table-border pleft">{{$count+1}}</td>
            <td class="table-border pleft">{{$emp->getStaffIcNo()}}</td>
            <td class="table-border pleft">{{$emp->getStaffName()}}</td>
            <td class="table-border text_right pright">{{number_format($emp->getAmount(),2)}}</td>
            <td class="table-border pleft">{{$emp->getStaffNo()}}</td>
        </tr>
        @php
        //calculate amount
        $amount += $emp->getAmount();
        $count++
        @endphp
        @endforeach
        <tr>
            <th class="pleft" colspan="2"></th>
            <th class="pleft">JUMLAH</th>
            <th class="table-border text_right pright">{{number_format($amount,2)}}</th>
            <th class="pleft"></th>
        </tr>

        @php($totalAmount += $amount)

        @if($cur_page == $num_pages)
        <tr>
            <th class="pleft" colspan="2"> </th>
            <th class="pleft">JUMLAH BESAR</th>
            <th class="table-border text_right pright">{{number_format($totalAmount,2)}}</th>
            <th class="pleft"></th>
        </tr>
        @endif
    </table>

    <table class="padded">
        <tr>
            <th>
                Muka Surat : {{$cur_page}}
            </th>
        </tr>
    </table>
    @php($cur_page++)
    @endfor
</div>
</body>
</html>
