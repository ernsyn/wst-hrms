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
        .padded th.pleft { padding-left:3pt; }
        .padded td.pright { padding-right:3pt; }

        .padded td.pleft3 { padding-left:3pt; }
        .padded td.pleft5 { padding-left:5pt; }
        .padded td.pleft10 { padding-left:10pt; }

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

        .text_padding{
            padding-top: 3pt;
            padding-bottom: 3pt;
        }

        .circle {
            height: 60pt;
            width: 60pt;
            border:1px solid black;
            background-color: #fff;
            border-radius: 50%;
            margin:0 auto;
        }
    </style>
</head>
<body>
<div id="page-container">

    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <th class="tg-s268 text_center" rowspan="7" width="15%">
                <img style="width: 75pt;height: 75pt;" alt="" src="{{asset('img/report/epf_grey.png')}}"/>
                <br>
                <br>
            </th>
            <th class="tg-s268 text_center" colspan="4">KUMPULAN WANG SIMPANAN PEKERJA</th>
            <td class="tg-s268 text_right" width="13%">KWSP 6</td>
        </tr>
        <tr>
            <td class="tg-s268 text_center" colspan="4">Peraturan-Peraturan Dan Kaedah-Kaedah KWSP 1991 Kaedah 11(1)</td>
            <th class="tg-s268 text_right">BORANG</th>
        </tr>
        <tr>
            <td class="tg-s268 text_center" colspan="4">JADUAL CARUMAN BULAN {{$data->getMonth()}} {{$data->getYear()}}</td>
            <th class="tg-s268 text_right" rowspan="3" style="font-size: 35pt;">A</th>
        </tr>
        <tr>
            <th class="tg-s268 text_center table-border">No Rujukan Majikan</th>
            <th class="tg-s268 text_center table-border">Bulan Caruman</th>
            <th class="tg-s268 text_center table-border">Amaun Caruman (RM)</th>
            <th class="tg-s268 text_center table-border">No. Rujukan</th>
        </tr>
        <tr>
            <td class="tg-s268 text_center table-border">{{$data->getEmployerReferenceNo()}}</td>
            <td class="tg-s268 text_center table-border">{{$data->getContributionMonth()}}</td>
            <td class="tg-s268 text_center table-border">121726.00</td>
            <td class="tg-s268 text_center table-border">{{$data->getReferenceNo()}}</td>
        </tr>
        <tr>
            <td class="tg-s268 pleft5 border_left border_right" colspan="4">Jumlah caruman untuk bulan di atas hendaklah dibayar kepada KWSP/Agen Kutipan</td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268 pleft5 border_left border_right" colspan="4">KWSP sebelum/pada 15 hb setiap bulan</td>
            <td class="tg-s268 text_center">Mukasurat: 1</td>
        </tr>
        <tr>
            <td class="tg-0lax" ></td>
            <td class="tg-0lax pleft10 border_left border_right border_bottom" colspan="4"> [{!! $data->getPaymentCash() !!}] Wang tunai [ {{$data->getPaymentCheck()}} ] Cek/Kiriman Wang/Wang Pos/Draf Bank No. </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax border_left border_right" colspan="4"></td>
            <td class="tg-0lax" rowspan="5">
                <div class="circle"></div>
            </td>
        </tr>
        <tr>
            <td class="tg-0lax" valign="top">Nama Majikan</td>
            <td class="tg-0lax border_left pleft" colspan="2">OPPO ELECTRONICS SDN BHD 1075187-D</td>
            <td class="tg-0lax border_right" colspan="2"></td>
        </tr>
        <tr>
            <td class="tg-0lax">Alamat </td>
            <td class="tg-0lax border_left pleft" colspan="2">LEVEL 15, TOWER 1, PJ 33,</td>
            <td class="tg-0lax border_right" colspan="2">Tarikh DiCetak: 05/10/2018</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax border_left pleft" colspan="2">JALAN SEMANGAT, SEKSYEN 13, PETALING JAYA, </td>
            <td class="tg-0lax border_right" colspan="2">Bil Pekerja: 204</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax border_left pleft" colspan="2">SELANGOR.</td>
            <td class="tg-0lax border_right" colspan="2"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax border_left border_bottom pleft" colspan="2">Poskod: 46200</td>
            <td class="tg-0lax border_right border_bottom" colspan="2"></td>
            <td class="tg-0lax text_center" style="font-size: 10pt;">Cop Agen Kutipan</td>
        </tr>
    </table>
    <table class="padded table-border" style="margin-top: 20pt;">
        <tr>
            <th class="tg-s268 pleft border_right" width="2%">BIL</th>
            <th class="tg-s268 pleft border_right">NO AHLI</th>
            <th class="tg-s268 pleft border_right">NO KAD</th>
            <th class="tg-s268 pleft border_right">NAMA PEKERJA/AHLI </th>
            <th class="tg-s268 text_right pright border_right">UPAH</th>
            <th class="tg-s268 text_center" colspan="2">CARUMAN (RM)</th>
        </tr>
        <tr>
            <th class="tg-s268 border_right border_bottom"></th>
            <th class="tg-s268 pleft border_right border_bottom">KWSP</th>
            <th class="tg-s268 pleft border_right border_bottom">PENGENALAN</th>
            <th class="tg-s268 pleft border_right border_bottom">(Seperti yang terdapat di dalam Kad Pengenalan) </th>
            <th class="tg-s268 text_right pright border_right border_bottom">(RM) </th>
            <th class="tg-s268 text_center border_bottom">MAJIKAN</th>
            <th class="tg-0lax text_center border_bottom">PEKERJA</th>
        </tr>
        <tr>
            <td class="tg-s268 text_right pright border_right border_bottom" colspan="5">Jumlah yang dibawa dari mukasurat terdahulu (jika ada)</td>
            <td class="tg-s268 border_bottom border_right"></td>
            <td class="tg-0lax border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-s268 pleft border_right border_bottom">1</td>
            <td class="tg-s268 pleft border_right border_bottom">220610</td>
            <td class="tg-s268 pleft border_right border_bottom">891616565432</td>
            <td class="tg-s268 pleft border_right border_bottom">ABDUL HALIM BIN MOHAMED AYOOB</td>
            <td class="tg-s268 border_right border_bottom text_right pright">2631.31</td>
            <td class="tg-s268 border_right border_bottom text_center ">344</td>
            <td class="tg-0lax border_bottom text_center ">291</td>
        </tr>
        <tr>
            <th class="tg-s268 text_right pright border_right border_bottom" colspan="5">Jumlah yang dibawa dari mukasurat terdahulu (jika ada)</th>
            <th class="tg-s268 border_bottom border_right text_center">6723</th>
            <th class="tg-0lax border_bottom text_center">5690</th>
        </tr>
    </table>

    <table class="padded" style="margin-top: 30pt;">
        <tr style="height: 20pt;">
            <td class="tg-s268" width="20%">Tandatangan</td>
            <td class="tg-s268" width="1%">:</td>
            <td class="tg-s268 border_bottom"></td>
            <td class="tg-s268" width="5%"></td>
            <td class="tg-s268" width="20%"></td>
            <td class="tg-s268" width="5%"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr style="height: 20pt;">
            <td class="tg-s268">Nama </td>
            <td class="tg-s268">:</td>
            <td class="tg-s268 border_bottom" style="font-size: 10pt;">CHONG HWEE MIN</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268" rowspan="6" style="font-size: 7pt;" width="25%">
                <b>CATATAN</b>
                <br>1. No Majikan mesti ditulis di belakang cek
                <br>2. Jumlah bayaran mesti sama dengan jumlah bayaran A
                <br>3. Potong maklumat ahli yang telah berhenti kerja
                <br>4. Jika ada butir-butir pekerja yang tidak disenaraikan,sila catatkan semua butirnya dan masukkan
                pekerja baru dalam ruangan kosong (jika ada)
                <br>5. Ruang ketiga (NK) hanya diisi oleh KWSP sahaja.
                <br>6. Bulan caruman bersamaan Bulan Upah +1
                <br>7. Upah termasuklah gaji pokok,komisyen,bonus,elaun dan bayaran yang dikenakan caruman KWSP
                <br>8. Sila rujuk panduan mengisi Borang A di buku Panduan Majikan.
            </td>
        </tr>
        <tr style="height: 20pt;">
            <td class="tg-s268">No Kad Pengenalan :</td>
            <td class="tg-s268">:</td>
            <td class="tg-s268 border_bottom" style="font-size: 10pt;">897865765645</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr style="height: 20pt;">
            <td class="tg-0lax">Jawatan</td>
            <td class="tg-0lax">:</td>
            <td class="tg-0lax border_bottom" style="font-size: 10pt;">HUMAN RESOURCES OFFICER</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr style="height: 20pt;">
            <td class="tg-0lax">No Tel/Bimbit</td>
            <td class="tg-0lax">:</td>
            <td class="tg-0lax border_bottom" style="font-size: 10pt;">03-7931 3550</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr style="height: 20pt;">
            <td class="tg-0lax">E-Mel </td>
            <td class="tg-0lax">:</td>
            <td class="tg-0lax border_bottom" style="font-size: 10pt;">oppo.amandachong@gmail.com</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr style="height: 20pt;">
            <td class="tg-0lax">Tarikh</td>
            <td class="tg-0lax">:</td>
            <td class="tg-0lax border_bottom" style="font-size: 10pt;">05/10/2018</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">Cop Rasmi Majikan</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td colspan="7">PERINGATAN: Berdasarkan Akta KWSP 1991,kesilapan membekalkan maklumat ahli boleh menyebabkan tuan dikenakan caj atau tindakan undang-undang</td>
        </tr>
    </table>

</div>
</body>
</html>
