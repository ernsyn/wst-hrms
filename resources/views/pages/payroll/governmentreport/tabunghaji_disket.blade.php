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
            <th class="tg-s268" width="20%"></th>
            <th class="text_center" width="60%">LEMBAGA TABUNG HAJI</th>
            <th class="tg-s268" width="20%"></th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <th class="text_center">SENARAI CARUMAN TABUNG HAJI BAGI</th>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <th class="text_center">AUGUST 2018</th>
            <td class="tg-s268"></td>
        </tr>
    </table>

    <table class="padded">
        <tr>
            <td class="tg-s268" width="10%">Majikan : </td>
            <td class="tg-s268" width="40%">OPPO ELECTRONICS SDN BHD</td>
            <td class="tg-0lax" width="30%"></td>
            <td class="tg-0lax">Lembaran:</td>
            <td class="tg-0lax">1</td>
            <td class="tg-0lax" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268">LEVEL 15, TOWER 1, PJ 33,</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">Tarikh :</td>
            <td class="tg-0lax">05/10/2018</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268">JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">SELANGOR.</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">Poskod : 46200</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax">Kod Majikan :</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 30pt;">
        <tr>
            <th class="table-border pleft">BIL. </th>
            <th class="table-border pleft">NOMBOR AKAUN</th>
            <th class="table-border pleft">NO. PEKERJA </th>
            <th class="table-border pleft">NO. KAD PENGENALAN </th>
            <th class="table-border pleft">NAMA PEKERJA</th>
            <th class="table-border text_right pright">CARUMAN (RM)</th>
            <th class="tg-0lax"></th>
        </tr>
        <tr>
            <th class="border_bottom border_left" colspan="4"></th>
            <th class="border_bottom border_right pleft">JUMLAH LEMBARAN INI</th>
            <th class="table-border text_right pright">0.00</th>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <th class="border_bottom border_left" colspan="4"></th>
            <th class="border_bottom border_right pleft">JUMLAH BESAR</th>
            <th class="table-border text_right pright">0.00</th>
            <td class="tg-0lax"></td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 30pt;">
        <tr>
            <td class="pleft10">
                Cek/Kiriman POS bernombor _____________________ sebanyak RM <u>0.00</u> di lampirkan bersama.
            </td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 50pt;">
        <tr>
            <td class="pleft" width="20%">Tandatangan Majikan/Wakil : </td>
            <td class="border_bottom pleft" width="30%"></td>
            <td class="pleft" width="50%"></td>
        </tr>
        <tr>
            <td class="pleft" width="20%">Tarikh : </td>
            <td class="border_bottom pleft" width="30%">05/10/2018</td>
            <td class="pleft" width="50%"></td>
        </tr>
    </table>
</div>
</body>
</html>
