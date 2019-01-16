<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title></title>
    <style>
        /*                table, td, th {
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

        .empty_row2{
            height:2pt;
        }

        .empty_row{
            height:15pt;
        }

        .empty_row30{
            height:30pt;
        }

        .row_height30{
            height:30pt;
        }

        .row_height25{
            height:25pt;
        }

        .heading1 {
            border-bottom: 1px solid #000;
        }

    </style>
</head>
<body>
<div id="page-container">
    <table class="padded" style="margin-top: 10pt;">
        <tr class="border_top border_left border_right">
            <th class="tg-s268" rowspan="7" style="text-align: center;" width="20%">
                <img style="width: 85pt;height: 85pt;" alt="" src="{{public_path('img/report/epf_grey.png')}}"/>
            </th>
            <th class="tg-s268"></th>
            <th class="tg-s268" width="20%" style="font-size: 13pt;">BORANG(BBCD)</th>
        </tr>
        <tr class="border_right">
            <th class="tg-s268 text_center" style="font-size: 13pt;">KUMPULAN WANG SIMPANAN  PEKERJA</th>
            <td class="tg-s268"></td>
        </tr>
        <tr class="empty_row2 border_right">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="border_right">
            <td class="tg-s268 text_center">(Peraturan-Peraturan Dan Kaedah-Kaedah KWSP 1991(Kaedah 11(1)))</td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="border_right">
            <td class="tg-s268 text_center">(BORANG BAYARAN CARUMAN BULANAN - DISKET  (BBCD))</td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="border_right">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr class="border_right">
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
    </table>
    <table class="padded">
        <tr class="border_left border_right">
            <td class="tg-0lax" width="20%"></td>
            <th class="tg-0lax text_center" style="font-size: 13pt;"><u>SISTEM PENGHANTARAN DATA  PITA/DISKET</u></th>
            <td class="tg-0lax" width="20%"></td>
        </tr>
        <tr class="border_left border_right">
            <td class="tg-0lax"></td>
            <th class="tg-0lax text_center"></th>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right">
            <td class="tg-0lax"></td>
            <th class="tg-0lax text_center"></th>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right">
            <td class="tg-0lax"></td>
            <th class="tg-0lax text_center" style="font-size: 13pt;">JADUAL CARUMAN BULAN  DECEMBER  2018</th>
            <td class="tg-0lax"></td>
        </tr>
    </table>
    <table class="padded" style="font-size: 12pt;">
        <tr class="border_right border_left">
            <td colspan="5"></td>
        </tr>
        <tr class="border_left border_right row_height25">
            <td class="tg-0lax" width="15%"></td>
            <th class="tg-0lax table-border text_center">No.Rujukan Majikan</th>
            <th class="tg-0lax table-border text_center">Bulan Caruman</th>
            <th class="tg-0lax table-border text_center">Amaun Caruman</th>
            <td class="tg-0lax" width="15%"></td>
        </tr>
        <tr class="border_right border_left row_height25">
            <td class="tg-0lax"></td>
            <th class="tg-0lax table-border text_center">018884828 </th>
            <th class="tg-0lax table-border text_center">1218</th>
            <th class="tg-0lax table-border text_center">RM 5,902.00</th>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax" width="15%"></td>
            <td class="border_left border_right" colspan="3"></td>
            <td class="tg-0lax" width="15%"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right pleft" colspan="3" style="font-size: 10pt;">Jumlah caruman untuk bulan diatas (untuk potongan gaji bulan  Ogos 2018) hendaklah</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right pleft" colspan="3" style="font-size: 10pt;">dibayar kepada KWSP/Ejen kutipan KWSP tidak lewat daripada 15hb setiap  bulan.</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right" colspan="3"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right pleft" colspan="3" style="font-size: 10pt;">
                [ &nbsp; &nbsp;] Wang Tunai &nbsp; &nbsp;[ X ] Cek/Kiriman Wang/Wang Pos/Draf Bank *  No. &nbsp; &nbsp;
                <span style="color: white;border-bottom: 1px solid black;"><u>1728282181919112132131</u></span>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right" colspan="3"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax text_center">NAMA & </td>
            <td class="border_left border_right pleft" colspan="3">OPPO ELECTRONICS SDN  BHD  1075187-D</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax text_center">ALAMAT</td>
            <td class="border_left border_right pleft" colspan="3">LEVEL 15, TOWER 1, PJ 33,</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right pleft" colspan="3">JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA,</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right pleft" colspan="3">SELANGOR.  Poskod: 46200</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right" colspan="3"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="border_left border_right border_bottom" colspan="3"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_right border_left">
            <td class="tg-0lax"></td>
            <td class="" colspan="3"></td>
            <th class="tg-0lax text_center">Cop Ejen Kutipan</th>
        </tr>
        <tr class="border_right border_left border_bottom">
            <td class="tg-0lax"></td>
            <td class="" colspan="3"></td>
            <th class="tg-0lax text_center"></th>
        </tr>
    </table>
    <table class="padded">
        <tr class="border_left border_right empty_row">
            <td class="tg-s268" width="5%"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax" width="5%"></td>
        </tr>
        <tr class="border_left border_right empty_row">
            <td class="tg-s268" colspan="6"></td>
        </tr>
        <tr class="border_left border_right empty_row">
            <td class="tg-s268" colspan="6"></td>
        </tr>
        <tr class="border_left border_right">
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft" colspan="4">SAYA MENGESAHKAN DAN MEMBERI JAMINAN BAHAWA BUTIRAN DAN JUMLAH  CARUMAN  BULAN</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right">
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft" colspan="4">SEPTEMBER 2018 SEPERTI YANG TERKANDUNG DI DALAM  PITA/DISKET  KOMPUTER  YANG  DISERTAKAN</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right">
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft" colspan="4">ADALAH SAMA DENGAN AMAUN BAYARAN DALAM BORANG  INI.</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right empty_row">
            <td class="tg-s268" colspan="6"></td>
        </tr>
        <tr class="border_left border_right empty_row">
            <td class="tg-s268" colspan="6"></td>
        </tr>
        <tr class="border_left border_right row_height25">
            <td class="tg-s268" width="5%"></td>
            <td class="tg-s268" width="20%">TANDATANGAN:</td>
            <td class="tg-s268 border_bottom" width="30%"></td>
            <td class="tg-0lax" width="5%"></td>
            <td class="tg-0lax" rowspan="7" style="line-height: 1.6;">
                CATATAN:
                <br>1. Nombor Rujukan Majikan  mesti
                <br>&nbsp;&nbsp;&nbsp; ditulis di belakang cek.
                <br>2. Jumlah cek mesti sama dengan
                <br>&nbsp;&nbsp;&nbsp; jumlah Borang  BBCD
                <br>3. Sekiranya terdapat lebih dari satu
                <br>&nbsp;&nbsp;&nbsp; nombor majikan dalam  disket
                <br>&nbsp;&nbsp;&nbsp; majikan hendaklah  menggunakan
                <br>&nbsp;&nbsp;&nbsp; Borang BBCD berasingan bagi setiap
                <br>&nbsp;&nbsp;&nbsp; nombor yang berkenaan.
            </td>
            <td class="tg-0lax" width="5%"></td>
        </tr>
        <tr class="border_left border_right row_height25">
            <td class="tg-s268"></td>
            <td class="tg-s268">NAMA PENUH:</td>
            <td class="tg-s268 border_bottom">CHONG HWEE MIN</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right row_height25">
            <td class="tg-s268"></td>
            <td class="tg-s268">NO KPDN:</td>
            <td class="tg-s268 border_bottom">931027-14-6428</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right row_height25">
            <td class="tg-s268"></td>
            <td class="tg-s268">JAWATAN: </td>
            <td class="tg-s268 border_bottom">HUMAN RESOURCES OFFICER</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right row_height25">
            <td class="tg-s268"></td>
            <td class="tg-s268">NO. TELEFON:</td>
            <td class="tg-s268 border_bottom">03-7931 3550</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right row_height25">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right row_height25">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr class="border_left border_right border_bottom">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
    </table>
</div>
</body>
</html>
