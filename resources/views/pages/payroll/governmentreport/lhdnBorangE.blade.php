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
        .padded td.pleft10 { padding-left:10pt; }
        .padded td.pleft15 { padding-left:15pt; }

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

        .empty_row{
            height:10pt;
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



    </style>
</head>
<body>
<div id="page-container">

    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <th class="tg-s268" rowspan="4" width="7%">
                <div class="text_center" style="padding-left: 3pt;">
                    <img style="width: 65pt;height: 65pt;" alt="" src="{{public_path('img/report/lhdn_grey.png')}}"/>
                </div>
            </th>
            <td class="text_center" width="7%" valign="bottom">Borang</td>
            <th class="text_center" style="font-size: 13pt;font-weight: bold" width="67%">LEMBAGA HASIL DALAM NEGERI MALAYSIA</th>
            <td class="text_center" width="18%">SARAAN BAGI TAHUN</td>
        </tr>
        <tr>
            <td class="text_center" rowspan="3" style="font-size: 36pt;" valign="top"><b>E</b></td>
            <td class="text_center" valign="bottom"><b>PENYATA OLEH MAJIKAN<b></td>
            <td class="text_center" rowspan="2" style="font-size: 26pt;letter-spacing: 7pt;" valign="top"><b>{{ date("Y") }}</b></td>
        </tr>
        <tr>
            <td class="text_center"><b>DI BAWAH SUBSEKSYEN 83(1) AKTA CUKAI PENDAPATAN 1967</b></td>
        </tr>
        <tr>
            <td class="text_center">Borang ini ditetapkan di bawah seksyen 152 Akta Cukai Pendapatan 1967</td>
            <td class="text_center" valign="bottom" style="font-size: 10pt;">CP8 - Pin. 2017</td>
        </tr>
        <tr>
            <td class="border_bottom" colspan="4"></td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 15pt;">
        <tr>
            <td class="pleft" width="2%">1.</td>
            <td class="tg-0lax" width="20%">Nama Majikan</td>
            <td class="table-border pleft5" colspan="2" width="58%">{{$data->getEmployerName()}}</td>
            <td class="tg-s268" width="20%"></td>
        </tr>
        <tr class="empty_row" ">
            <td class="pleft"></td>
            <td class="tg-0lax"></td>
            <td class=""></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft">2.</td>
            <td class="tg-0lax">No. Majikan E</td>
            <td class="table-border pleft5" width="29%">{{$data->getEmployerNoE()}}</td>
            <td class="tg-s268" width=""></td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-s268"></td>
            <td class="tg-0lax"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft">3.</td>
            <td class="tg-0lax">Status Majikan</td>
            <td class="table-border pleft5">{{$data->getEmployerStatus()}}</td>
            <td class="pleft15">1=Kerajaan &nbsp;2=Berkanun &nbsp;3=Swasta</td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">4.</td>
            <td class="tg-0lax">Status Perniagaan</td>
            <td class="table-border pleft5">{{$data->getBusinessStatus()}}</td>
            <td class="pleft15" colspan="2">1=Beroperasi &nbsp;2=Belum Beroperasi &nbsp;3=Dorman &nbsp;4=Dalam Proses Pembubaran</td>
        </tr>
        <tr class="empty_row">
            <td class="pleft"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">5.</td>
            <td class="tg-0lax">No. Cukai Pendapatan</td>
            <td class="tg-0lax" colspan="2">
                <div class="table-border" style="display: table-cell;padding-left:5pt;width: 70pt;">
                    &nbsp;{{$data->getFirstIncomeTaxNo()}}
                </div>
                <div class="" style="display: table-cell;padding-left:5pt;padding-right: 5pt;">
                    -
                </div>
                <div class="table-border" style="display: table-cell;padding-left:5pt;width: 250pt">
                    &nbsp; {{$data->getLastIncomeTaxNo()}}
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">6.</td>
            <td class="tg-0lax">No. Pengenalan</td>
            <td class="table-border pleft5">{{$data->getIcNo()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">7.</td>
            <td class="tg-0lax">No. Pasport</td>
            <td class="table-border pleft5">{{$data->getPassportNo()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">8.</td>
            <td class="tg-0lax">No. Pendaftaran</td>
            <td class="table-border pleft5">{{$data->getSsmNo()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax">Dengan SSM</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">Atau Lain-lain</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">9.</td>
            <td class="tg-0lax">Alamat</td>
            <td class="table-border pleft5" colspan="2">{{$data->getAddress1()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">surat-menyurat</td>
            <td class="table-border pleft5" colspan="2">{{$data->getAddress2()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft5" colspan="2">{{$data->getAddress3()}} &nbsp;&nbsp; Poskod: {{$data->getPostcode()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">10.</td>
            <td class="tg-0lax">No. Telefon </td>
            <td class="table-border pleft5" colspan="2">{{$data->getPhoneNo()}}</td>
            <td class="tg-0lax"></td>
        </tr>

        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">11.</td>
            <td class="">No. Telefon Bimbit</td>
            <td class="table-border pleft" colspan="2">{{$data->getMobileNo()}}</td>
            <td class="tg-0lax"></td>
        </tr>

        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">12.</td>
            <td class="tg-0lax">E-Mel </td>
            <td class="table-border pleft5" colspan="2">{{$data->getEmail()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">13.</td>
            <td class="tg-0lax">Cara pengemukaan CP8D</td>
            <td class="table-border pleft5">{{$data->getCP8D()}}</td>
            <td class="pleft15" colspan="2">1=Bersama Borang E &nbsp;2=Melalui Data Praisi &nbsp;3=Cakera Padat</td>
        </tr>
        <tr class="border_bottom empty_row">
            <td class="pleft"></td>
            <td class="tg-0lax"></td>
            <td class="pleft5"></td>
            <td class="pleft15" colspan="2"></td>
        </tr>

    </table>

    <table class="padded" style="margin-top: 15pt;">
        <tr>
            <th class="tg-s268"></th>
            <th class="text_center" colspan="3">UNTUK KEGUNAAN PEJABAT</th>
            <th class="tg-s268"></th>
        </tr>
        <tr style="height:80pt;">
            <td class="tg-s268" width="10%"></td>
            <td class="border_top border_left border_bottom border_right"></td>
            <td class="border_top border_bottom border_right"></td>
            <td class="border_top border_right border_bottom"></td>
            <td class="tg-s268" width="10%"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-s268" colspan="5"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="text_center"><b>Tarikh Terima (1)</b></td>
            <td class="text_center"><b>Tarikh Terima (2)</b></td>
            <td class="text_center"><b>Tarikh Terima (3)</b></td>
            <td class="tg-s268"></td>
        </tr>
    </table>

    <!-- Page 1 -->
    <div style="page-break-before:always">&nbsp;</div>

    <table class="padded" style="margin-top: 10pt;">
        <tr>
            <td class="pleft" width="10%" style="font-weight: bold">Nama Majikan</td>
            <td class="table-border pleft5" width="30%" style="font-weight: bold">{{$data->getEmployerName()}}</td>
            <td></td>
            <td class="pleft" width="10%" style="font-weight: bold">No. Majikan E</td>
            <td class="table-border pleft5" width="30%" style="font-weight: bold">{{$data->getEmployerNoE()}}</td>
        </tr>
        <tr class="empty_row">
            <td class="pleft" width="10%" colspan="5"></td>
        </tr>
        <tr>
            <td class="pleft" width="10%" style="font-size: 10pt;">(C.P.8D - Pin. 2017)</td>
            <td class="pleft5" width="30%"></td>
            <td></td>
            <td class="pleft" width="10%"></td>
            <td class="pleft5" width="30%"></td>
        </tr>
    </table>

    <table class="pf padded " style="margin-top: 15pt;">
        <tbody><tr>
            <td class="table-header-grey pleft" colspan="19">
                BAHAGIAN A: MAKLUMAT BILANGAN PEKERJA BAGI TAHUN BERAKHIR 31 DISEMBER 2018
            </td>
        </tr>
        </tbody>
    </table>

    <table class="padded">
        <tr class="empty_row">
            <th class="tg-s268"></th>
            <th class="tg-s268"></th>
            <th class="tg-s268"></th>
            <th class="tg-s268"></th>
            <th class="tg-s268"></th>
        </tr>
        <tr>
            <td class="pleft" width="15%">A1. Bilangan pekerja</td>
            <td class="table-border pleft5" width="25%">{{$data->getTotalEmployee()}}</td>
            <td class="tg-s268" width=""></td>
            <td class="pleft" width="15%">A3. Bilangan pekerja baru</td>
            <td class="table-border pleft5" width="25%">{{$data->getTotalNewEmployee()}}</td>
        </tr>
        <tr class="empty_row">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft">A2. Bilangan pekerja</td>
            <td class="table-border pleft5">{{$data->getTotalEmployeeWithPCB()}}</td>
            <td class="tg-s268"></td>
            <td class="pleft">A4. Bilangan pekerja berhenti</td>
            <td class="table-border pleft5">{{$data->getTotalEmployeeResigned()}}</td>
        </tr>
        <tr>
            <td class="" style="padding-left: 20pt;">terlibat dengan PCB</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft" colspan="2">A5. Bilangan pekerja yang berhenti kerja untuk meninggalkan Malaysia</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">
                <div class="table-border" style="width: 30pt;float: left;">
                    &nbsp;{{$data->getTotalEmployeeResignedLeaveMalaysia()}}
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft" colspan="2">A6. Telah melaporkan kepada LHDNM ? (jika A5 berkaitan)</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">
                <div class="table-border" style="width: 30pt;float: left;">
                    &nbsp;{{$data->getReportLHDNM()}}
                </div>

                <div class="" style="width: 30pt display: table-cell;">
                    &nbsp;&nbsp;1=Ya &nbsp;&nbsp; 2=Tidak
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
    </table>

    <table class="pf padded " style="margin-top: 30pt;">
        <tbody><tr>
            <td class="table-header-grey pleft" colspan="19">
                BAHAGIAN B: AKUAN
            </td>
        </tr>
        </tbody>
    </table>


    <table class="padded">
        <tr class="empty_row">
            <th class="tg-s268" width="15%"></th>
            <th class="tg-s268"></th>
            <th class="tg-s268" width="15%"></th>
            <th class="tg-s268" width="15%"></th>
            <th class="tg-s268"></th>
        </tr>
        <tr>
            <td class="pleft">Saya</td>
            <td class="table-border pleft5" colspan="3">{{$data->getOfficerName()}}</td>
            <td class="pleft"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft">No. Kad Pengenalan/Polis/</td>
            <td class="table-border pleft5" colspan="3">{{$data->getOfficerIC()}}</td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft">Tentera/No Pasport*</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft">Jawatan</td>
            <td class="table-border pleft5" colspan="3">{{$data->getOfficerPosition()}}</td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="empty_row">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft" colspan="3">dengan ini mengakui bahawa penyata oleh majikan ini mengandungi maklumat yang benar,lengkap dan</td>
            <td class="pleft5"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft" colspan="3">betul seperti mana yang dikehendaki di bawah Akta Cukai Pendapatan 1967.</td>
            <td class="pleft5"></td>
            <td class="tg-s268"></td>
        </tr>
    </table>
    <table class="padded" style="margin-top: 60pt;">
        <tr>
            <td class="pleft" width="15%">Tarikh</td>
            <td class="table-border pleft5" width="20%">{{$data->getDate()}}</td>
            <td class="pleft5" width="30%"></td>
            <td class="pleft" width="10%">Tandatangan</td>
            <td class="border_bottom pleft5" width="25%"></td>
        </tr>
        <tr class="empty_row">
            <td class="pleft" colspan="5"></td>
        </tr>
        <tr>
            <td class="pleft" colspan="5">* Potong yang mana tidak berkenaan</td>
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
    @endphp

    @for($i=0; $i<$num_pages; $i++)
    @php
        if($i != 0){
            $start += $num_per_page;
        }

        //total amount
        $totalAmountOfDeparture = 0.00;
        $totalGrossRemuneration = 0.00;
        $totalBenefitsOfGoods = 0.00;
        $totalValuePlaceOfResidence = 0.00;
        $totalBenefitsOfESOS = 0.00;
        $totalTaxExemptPerquisites = 0.00;
        $totalTP1Departure = 0.00;
        $totalTP1Zakat = 0.00;
        $totalEmployeeEPFContributions = 0.00;
        $totalZakatDeductions = 0.00;
        $totalTaxDeductionOfPCB = 0.00;
        $taxDeductionOfCP38 = 0.00;
    @endphp
    <div style="page-break-before:always">&nbsp;</div>

    <table class="padded" style="margin-top: 10pt;">
        <tr>
            <td class="pleft" width="10%" style="font-weight: bold">Nama Majikan</td>
            <td class="table-border pleft5" width="30%" style="font-weight: bold">{{$data->getEmployerName()}}</td>
            <td></td>
            <td class="pleft" width="10%" style="font-weight: bold">No. Majikan E</td>
            <td class="table-border pleft5" width="30%" style="font-weight: bold">{{$data->getEmployerNoE()}}</td>
        </tr>
        <tr class="empty_row">
            <td class="pleft" width="10%" colspan="5"></td>
        </tr>
        <tr>
            <td class="pleft" width="10%" style="font-size: 10pt;">(C.P.8D - Pin. 2017)</td>
            <td class="pleft5" width="30%"></td>
            <td></td>
            <td class="pleft" width="10%"></td>
            <td class="pleft5" width="30%"></td>
        </tr>
    </table>

    <table class="table-border-all padded" style="margin-top: 15pt; font-size: 10pt;">
        <tr>
            <th class="table-border"></th>
            <th class="table-border pleft">C</th>
            <th class="table-border pleft">D</th>
            <th class="table-border pleft">E</th>
            <th class="table-border pleft">F</th>
            <th class="table-border pleft">G</th>
            <th class="table-border pleft">H</th>
            <th class="table-border pleft">I</th>
            <th class="table-border pleft">J</th>
            <th class="table-border pleft">K</th>
            <th class="table-border pleft">L</th>
            <th class="table-border pleft">M</th>
            <th class="table-border pleft">N</th>
            <th class="table-border pleft">O</th>
            <th class="table-border pleft">P</th>
            <th class="table-border pleft">Q</th>
            <th class="table-border pleft">R</th>
            <th class="table-border pleft">S</th>
        </tr>
        <tr>
            <th class="table-border pleft">Bil.</th>
            <th class="table-border pleft">No. Cukai Pendapatan</th>
            <th class="table-border pleft">No.Pengenalan / Passport</th>
            <th class="table-border pleft">Kategori Pekerja</th>
            <th class="table-border pleft">Cukai dibayar Majikan</th>
            <th class="table-border pleft">Bil. Anak</th>
            <th class="table-border pleft">Jumlah Perlepasan</th>
            <th class="table-border pleft">Jumlah Saraan Kasar</th>
            <th class="table-border pleft">Manfaat Berupa Barangan</th>
            <th class="table-border pleft">Nilai Tempat Kediaman</th>
            <th class="table-border pleft">Manfaat ESOS</th>
            <th class="table-border pleft">Perkuisit Dikecualikan Cukai</th>
            <th class="table-border pleft">TP1 Perlepasan</th>
            <th class="table-border pleft">TP1 Zakat</th>
            <th class="table-border pleft">Caruman KWSP Pekerja</th>
            <th class="table-border pleft">Potongan Zakat</th>
            <th class="table-border pleft">Potongan Cukai PCB</th>
            <th class="table-border pleft">Potongan Cukai CP38</th>
        </tr>
        @foreach(array_slice($empData,$start,$end) as $emp )
            <tr class="border_bottom" style="height: 35pt;">
                <td class="pleft">{{$count+1}}</td>
                <td class="tg-s268 pleft">{{$emp->getIncomeTaxNo()}}</td>
                <td class="tg-s268 pleft">{{$emp->getIcNo()}}</td>
                <td class="tg-s268 pleft">{{$emp->getEmployeeCategory()}}</td>
                <td class="tg-s268 pleft">{{$emp->getTaxPayByEmployer()}}</td>
                <td class="tg-0lax pleft">{{$emp->getTotalChildren()}}</td>
                <td class="tg-0lax pleft">{{$emp->getAmountOfDeparture()}}</td>
                <td class="tg-0lax pleft">{{$emp->getTotalGrossRemuneration()}}</td>
                <td class="tg-0lax pleft">{{$emp->getBenefitsOfGoods()}}</td>
                <td class="tg-0lax pleft">{{$emp->getValuePlaceOfResidence()}}</td>
                <td class="tg-0lax pleft">{{$emp->getBenefitsOfESOS()}}</td>
                <td class="tg-0lax pleft">{{$emp->getTaxExemptPerquisites()}}</td>
                <td class="tg-0lax pleft">{{$emp->getTP1Departure()}}</td>
                <td class="tg-0lax pleft">{{$emp->getTP1Zakat()}}</td>
                <td class="tg-0lax pleft">{{$emp->getEmployeeEPFContributions()}}</td>
                <td class="tg-0lax pleft">{{$emp->getZakatDeductions()}}</td>
                <td class="tg-0lax pleft">{{$emp->getTaxDeductionOfPCB()}}</td>
                <td class="tg-0lax pleft">{{$emp->getTaxDeductionOfCP38()}}</td>
            </tr>
        @php
            //total amount
            $totalAmountOfDeparture += $emp->getAmountOfDeparture();
            $totalGrossRemuneration += $emp->getTotalGrossRemuneration();
            $totalBenefitsOfGoods += $emp->getBenefitsOfGoods();
            $totalValuePlaceOfResidence += $emp->getValuePlaceOfResidence();
            $totalBenefitsOfESOS += $emp->getBenefitsOfESOS();
            $totalTaxExemptPerquisites += $emp->getTaxExemptPerquisites();
            $totalTP1Departure += $emp->getTP1Departure();
            $totalTP1Zakat += $emp->getTP1Zakat();
            $totalEmployeeEPFContributions += $emp->getEmployeeEPFContributions();
            $totalZakatDeductions += $emp->getZakatDeductions();
            $totalTaxDeductionOfPCB += $emp->getTaxDeductionOfPCB();
            $taxDeductionOfCP38 += $emp->getTaxDeductionOfCP38();
            $count++
        @endphp
        @endforeach

        @if($cur_page == $num_pages)
        <tr class="blank_row">
            <td colspan="18"></td>
        </tr>
        <tr class="border_top border_bottom">
            <td class="pleft"></td>
            <th class="tg-s268 pleft" colspan="5">Jumlah</th>
            <td class="tg-0lax pleft"><b>{{number_format($totalAmountOfDeparture,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalGrossRemuneration,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalBenefitsOfGoods,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalValuePlaceOfResidence,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalBenefitsOfESOS,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalTaxExemptPerquisites,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalTP1Departure,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalTP1Zakat,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalEmployeeEPFContributions,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalZakatDeductions,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($totalTaxDeductionOfPCB,2)}}</b></td>
            <td class="tg-0lax pleft"><b>{{number_format($taxDeductionOfCP38,2)}}</b></td>
        </tr>
        @endif
    </table>
    @php($cur_page++)
    @endfor
</div>
</body>
</html>
