<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" href="{{asset('css/report/soscoBorang8A/base.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/report/soscoBorang8A/main.css')}}"/>
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

    <table class="padded">
        <tr>
            <th class="tg-s268" width="30%"></th>
            <th class="text_center" width="40%">AMANAH SAHAM NASIONAL BERHAD</th>
            <th class="text_right pright" width="30%">M/SURAT : 1</th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <th class="text_center">SISTEM SIMPANAN POTONGAN PEKERJA</th>
            <th class="text_right pright">TARIKH : 05/10/2018</th>
        </tr>
        <tr class="empty_row">
            <td class="tg-s268"></td>
            <th class="text_center"></th>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <th class="text_center">LAPORAN MENGIKUT SUSUNAN NOMBOR AKAUN</th>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <th class="text_center">BULAN POTONGAN : 8/2018</th>
            <td class="tg-s268"></td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 10pt">
        <tr>
            <th class="tg-s268 pleft15" width="15%">KOD MAJIKAN</th>
            <th class="" width="30%">: </th>
            <th class="text_right pright" width="55%"></th>
        </tr>
        <tr>
            <th class="tg-s268 pleft15" width="13%">NOMBOR CEK</th>
            <th class="" width="30%">: </th>
            <th class="text_right pright" width="55%"></th>
        </tr>
    </table>

    <table class="padded" style="margin-top: 30pt;">
        <tr class="border_top border_bottom">
            <th class="pleft">BIL. </th>
            <th class="pleft">No.Pekerja</th>
            <th class="pleft">Kod Jabatan</th>
            <th class="pleft">No.Akaun </th>
            <th class="pleft">Nama Pelabur</th>
            <th class="pleft">No.I/C</th>
            <th class="text_right pright">Jum.Potongan</th>
        </tr>
        <tr class="border_bottom">
            <th class="" colspan="5"></th>
            <th class="pleft">Jumlah Besar (RM) :</th>
            <th class="text_right pright">0.00</th>
        </tr>
    </table>

    <table class="padded" style="margin-top: 30pt;">
        <tr>
            <td class="text_center">**** LAPORAN TAMAT ****</td>
        </tr>
    </table>
</div>
</body>
</html>
