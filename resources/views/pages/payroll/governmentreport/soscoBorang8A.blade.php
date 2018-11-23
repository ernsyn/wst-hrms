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

/*                .table-border-all table, td, th{
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
            font-size: 12pt;
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

    <table class="padded" style="margin-top: 48pt;">
        <tr>
            <th rowspan="6" width="10%"><img style="width: 89pt;height: 94pt;" alt="" src="{{asset('img/report/perkeso_grey.png')}}"/></th>
            <th colspan="5" class="text_center" style="font-size: 16pt;word-spacing: 1pt;">PERTUBUHAN KESELAMATAN SOSIAL</th>
            <td class="text_1"></td>
        </tr>
        <tr class="blank_row">
            <td class="" colspan="5"></td>
            <td class="text_1"></td>
        </tr>
        <tr>
            <td class="text_center" colspan="5">PERATURAN - PERATURAN (AM) KESELAMATAN SOSIAL PEKERJA  1971  (PER.  44A)</td>
            <td class="text_1"></td>
        </tr>
        <tr class="blank_row">
            <td class="" colspan="5"></td>
            <td class="text_1"></td>
        </tr>
        <tr>
            <td class="text_1 text_center" width="50%">CARUMAN GAJI  BULAN </td>
            <td class="text_1 table-border pleft" width="5%">08</td>
            <td class="text_1" width="2%">&nbsp;&nbsp;/&nbsp;&nbsp;</td>
            <td class="text_1 table-border pleft" width="5%">2018</td>
            <td class="text_1" width="10%"></td>
            <td class="text_1 text_right" width="13%">BORANG 8A</td>
        </tr>
        <tr>
            <td class="text_1 text_center"colspan="6"></td>
        </tr>
    </table>


    <table class="padded" style="margin-top: 43pt;">
        <tr style="background: #E5E5E5">
            <td class="table-border pleft" width="27%">No. Kod Majikan</td>
            <td class="table-border pleft" width="45%"> No. MyCoID / No. Pendaftaran Perniagaan</td>
            <td class="table-border text_center" width="28%" colspan="2">Amaun Caruman (RM)</td>
        </tr>
        <tr>
            <td class="table-border pleft">B3200090304M</td>
            <td class="table-border pleft">1075187-D</td>
            <td class="table-border text_center" colspan="2">12,525.60</td>
        </tr>
        <tr class="border_left border_right">
            <td class="pleft" colspan="3">Amaun caruman di atas hendaklah dibayar kepada PERKESO/EJEN PEMUNGUT tidak lewat daripada</td>
            <td class="text_right pright5">15/09/2018</td>
        </tr>
        <tr style="background: #E5E5E5">
            <td class="pleft table-border" colspan="2">Nama dan Alamat Majikan</td>
            <td class="pleft table-border"> Lembaran</td>
            <td class="text_center table-border">Bil. Pekerja</td>
        </tr>
        <tr>
            <td class="pleft table-border" colspan="2" rowspan="4" valign="top">
                OPPO ELECTRONICS SDN BHD<br>
                LEVEL 15, TOWER 1, PJ 33,<br>
                JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,<br>
                SELANGOR. Poskod: 46200<br>
            </td>
            <td class="pleft table-border">1</td>
            <td class="text_center table-border">208</td>
        </tr>
        <tr>
            <td class="pleft table-border" colspan="2" style="background: #E5E5E5">Kegunaan Ejen Pemungut</td>
        </tr>
        <tr>
            <td class="pleft table-border" colspan="2" rowspan="2" style="height: 100pt" valign="top">
                Cop
                <br>
                <br>
                <br>
                <br>
                <br>
                No. Slip Bayaran
            </td>
        </tr>
        <tr>
        </tr>
    </table>

    <table class="padded" style="margin-top: 18pt;">
        <tr style="background: #E5E5E5">
            <td class="tg-s268 table-border pleft" width="15%">TARIKH MULA/ BERHENTI KERJA <br>(1)</td>
            <td class="tg-s268 table-border text_center" width="1%">S T (2)</td>
            <td class="tg-s268 table-border pleft" width="20%">NO. KAD <br> PENGENALAN <br>(3)</td>
            <td class="tg-s268 table-border pleft" width="48%">NAMA PEKERJA (MENGIKUT  KAD  PENGENALAN) <br><br>(4)</td>
            <td class="text_right table-border" width="15%">CARUMAN<br>(RM)<br>(5)</td>
        </tr>
        <tr>
            <td class="tg-s268 table-border pleft">31/08/2018</td>
            <td class="tg-s268 table-border text_center">H</td>
            <td class="tg-s268 table-border pleft">000821081283</td>
            <td class="tg-s268 table-border pleft">ABDUL HALIM BIN  MOHAMED  AYOOB</td>
            <td class="text_right table-border"> 70.90</td>
        </tr>
        <tr>
            <td class="tg-s268 table-border pleft"></td>
            <td class="tg-s268 table-border text_center"></td>
            <td class="tg-s268 table-border pleft">990112145323</td>
            <td class="tg-s268 table-border pleft">ABDUL IKMAL BIN AL  AHFIZ</td>
            <td class="text_right table-border">52.90</td>
        </tr>
        <tr>
            <td class="tg-s268 table-border pleft"></td>
            <td class="tg-s268 table-border text_center"></td>
            <td class="tg-s268 table-border pleft">981019105621</td>
            <td class="tg-s268 table-border pleft">AHMAD IZZAT SYAZWAN  BIN  WAN  CHIK</td>
            <td class="text_right table-border">86.60</td>
        </tr>
        <tr>
            <td class="tg-s268 table-border pleft">31/08/2018</td>
            <td class="tg-s268 table-border text_center">B</td>
            <td class="tg-s268 table-border pleft">000821081283</td>
            <td class="tg-s268 table-border pleft">ABDUL HALIM BIN  MOHAMED  AYOOB</td>
            <td class="text_right table-border"> 70.90</td>
        </tr>
        <tr>
            <td class="tg-s268 table-border pleft"></td>
            <td class="tg-s268 table-border text_center"></td>
            <td class="tg-s268 table-border pleft">990112145323</td>
            <td class="tg-s268 table-border pleft">ABDUL IKMAL BIN AL  AHFIZ</td>
            <td class="text_right table-border">52.90</td>
        </tr>
        <tr>
            <td class="tg-s268 table-border pleft"></td>
            <td class="tg-s268 table-border text_center"></td>
            <td class="tg-s268 table-border pleft">981019105621</td>
            <td class="tg-s268 table-border pleft">AHMAD IZZAT SYAZWAN  BIN  WAN  CHIK</td>
            <td class="text_right table-border">86.60</td>
        </tr>
        <tr>
            <td class="empty_row table-border" colspan="4"></td>
            <td class="empty_row table-border"></td>
        </tr>
        <tr>
            <td class="table-border text_right pright10" colspan="4">JUMLAH MUKA SURAT  INI</td>
            <td class="table-border text_right">1,139.30</td>
        </tr>
        <tr>
            <td class="table-border text_right pright10" colspan="4">JUMLAH DIBAWA  KE  LEMBARAN  HADAPAN</td>
            <td class="table-border text_right"> 1,139.30</td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 40pt;border-collapse: collapse;">
        <tr>
            <td class="tg-s268" width="20%">Tandatangan </td>
            <td class="tg-s268 border_bottom" width="20%"></td>
            <td class="tg-s268" width="20%"></td>
            <td class="tg-s268" colspan="2" width="40%">Kaedah Pembayaran (Sila tandakan (x))</td>
        </tr>
        <tr>
            <td class="tg-s268">Nama </td>
            <td class="tg-s268 border_bottom">CHONG HWEE MIN</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"> [   ] Tunai</td>
            <td class="tg-s268"> [   ] Kiriman Wang</td>
        </tr>
        <tr>
            <td class="tg-s268">No Telefon </td>
            <td class="tg-s268 border_bottom">03-7931 3550</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"> [X  ] Cek  .......</td>
            <td class="tg-s268"> [   ] Lain-lain  ................</td>
        </tr>
        <tr>
            <td class="tg-s268">& Cop Majikan</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268" colspan="2">No. Cek/Kiriman Wang:_________________________</td>
        </tr>
    </table>

</div>
</body>
</html>