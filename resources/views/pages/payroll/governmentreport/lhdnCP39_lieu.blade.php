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

    @foreach($dataArr as $data )
    <!-- next page -->
    <div style="page-break-before:always">&nbsp;</div>

    <table class="padded">
        <tr>
            <th class="tg-s268" width="20%"></th>
            <th class="text_center" width="60%">LEMBAGA HASIL DALAM NEGERI</th>
            <th class="tg-s268" width="20%"></th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="text_center">BORANG PENDAFTARAN FAIL CUKAI PENDAPATAN</td>
            <td class="tg-s268"></td>
        </tr>
    </table>
    <table class="padded">
        <tr>
            <td class="tg-s268" colspan="2">(Sila sertakan SALINAN KAD PENGENALAN dan BORANG EA)</td>
            <td class="text_right">In lieu of CP 39 (Pin 1/2002)</td>
        </tr>
    </table>
    <table class="table-border padded">
        <tr>
            <th class="text_center">MAKLUMAT PEKERJA</th>
        </tr>
        <tr>
            <td class="text_center">(BORANG INI HENDAKLAH DIISI OLEH PEKERJA)</td>
        </tr>
    </table>
    <table class="padded">
        <tr class="empty_row border_left border_right">
            <th class="pleft10" colspan="6"></th>
        </tr>
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="pleft10" colspan="2">NAMA MAJIKAN</th>
            <th class="text_center" width="10%"></th>
            <th class="" width="27%">NO. RUJUKAN MAJIKAN</th>
            <th class="text_center" width="7%"></th>
        </tr>
        <tr class="border_left border_right">
            <td class=""></td>
            <td class="pleft table-border" colspan="2">{{$data->getEmployerName()}}</td>
            <td class="text_center" width="10%"></td>
            <td class="table-border pleft"> {{$data->getEmployerNoE()}}</td>
            <td class="text_center" width="10%"></td>
        </tr>
        <tr class="empty_row border_left border_right">
            <th class="pleft10" colspan="6"></th>
        </tr>
        <tr class="border_right border_left">
            <th class=""></th>
            <th class="pleft10" colspan="2">NAMA PEKERJA</th>
            <th class="text_center"></th>
            <th class="" width="27%">NO. GAJI/STAF</th>
            <th class="text_center"></th>
        </tr>
        <tr class="border_left border_right">
            <td class=""></td>
            <td class="pleft table-border" colspan="2">{{$data->getName()}}</td>
            <td class="text_center"></td>
            <td class="table-border pleft">{{$data->getSalaryNo()}}</td>
            <td class="text_center"></td>
        </tr>
        <tr class="empty_row border_left border_right">
            <th class="pleft10" colspan="6"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="pleft10" width="20%">NO. KP: (LAMA) </th>
            <td class="table-border pleft" width="30%">{{$data->getIcOldNo()}}</td>
            <th class="" width="5%"></th>
            <th class="" width="10%">(BARU) </th>
            <td class="table-border pleft" width="30%">{{$data->getIcNewNo()}}</td>
            <th class="text_center" width="2%"></th>
        </tr>
        <tr class="empty_row border_left border_right">
            <th class="pleft10" colspan="7"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="" width="40%" colspan="2">NO. RUJUKAN CUKAI PENDAPATAN </th>
            <th class="" width=""></th>
            <th class="" width="30%">TARAF PERKAHWINAN</th>
            <td class="" width="2%"></td>
            <th class="" width="23%">TARIKH KAHWIN</th>
            <th class="" width="2%"></th>
        </tr>
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="" width="15%">SG/OG* </td>
            <td class="table-border pleft" width="25%">{{$data->getReferenceTaxRevenueNo()}}</td>
            <th class=""></th>
            <td class="table-border pleft">{{$data->getMarriageStatus()}}</td>
            <td class=""></td>
            <td class="table-border pleft">{{$data->getMarriageDate()}}</td>
            <th class=""></th>
        </tr>
        <tr class="empty_row border_left border_right">
            <th class="pleft10" colspan="8"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="" width="20%">JANTINA </th>
            <th class="" width="7%"></th>
            <th class="" width="">TAHUN BILA PCB MULA DIBUAT</th>
            <td class="" width="7%"></td>
            <th class="" width="25%">TARIKH MULA KERJA</th>
            <td class="" width="2%"></td>
        </tr>
        <tr class="border_right border_left">
            <th class=""></th>
            <td class="table-border pleft">{{$data->getGender()}} </td>
            <th class=""></th>
            <td class="table-border pleft">{{$data->getPcbMadeYears()}}</td>
            <td class=""></td>
            <td class="table-border pleft">{{$data->getWorkStartedDate()}}</td>
            <td class=""></td>
        </tr>
        <tr class="empty_row border_left border_right">
            <th class="pleft10" colspan="7"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="" width="20%">GAJI BULANAN</th>
            <td class="table-border pleft" width="20%">{{$data->getMonthlySalary()}}</td>
            <td class=""></td>
        </tr>
        <tr class="empty_row border_left border_right">
            <th class="pleft10" colspan="4"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="">ALAMAT KEDIAMAN / POS* </th>
            <td class="" width="2%"></td>
        </tr>
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="table-border pleft">{{$data->getAddress1()}} </td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="table-border pleft">{{$data->getAddress2()}}</td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="table-border pleft">{{$data->getAddress3()}} &nbsp;&nbsp; Poskod : {{$data->getPostcode()}}</td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row30 border_left border_right">
            <th class="pleft10" colspan="3"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft15" style="font-size: 10pt;">Jika warganegara asing, sila penuhkan butiran dibawah dan sertakan salinan muka surat pertama pasport :</td>
            <td class="" width="2%"></td>
        </tr>
    </table>
    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft15">TARIKH LAHIR  </td>
            <td class="table-border pleft">{{$data->getForeignerBirthDate()}}</td>
            <td class=""></td>
            <td class="pleft15">NO. PASPORT</td>
            <td class="table-border pleft">{{$data->getForeignerPassportNo()}}</td>
            <td class="" width="40%"></td>
        </tr>
        <tr class="empty_row30 border_left border_right">
            <th class="pleft10" colspan="7"></th>
        </tr>
    </table>
    <table class="padded">
        <tr class="border_right border_left border_top border_bottom">
            <th class="text_center">JIKA BERKAHWIN, SILA ISI BAHAGIAN INI</th>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="text_center"></th>
        </tr>
        <tr class="border_right border_left">
            <th class="text_center">MAKLUMAT ISTERI/SUAMI*</th>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="text_center"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="" width="30%">NAMA ISTERI/SUAMI*</th>
            <td class="table-border pleft">{{$data->getSpouseName()}}</td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="text_center" colspan="4"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="pleft10" width="20%">NO. KP: (LAMA) </th>
            <td class="table-border pleft" width="30%">{{$data->getSpouseIcOldNo()}}</td>
            <th class="" width="5%"></th>
            <th class="" width="10%">(BARU) </th>
            <td class="table-border pleft" width="30%">{{$data->getSpouseIcNewNo()}}</td>
            <th class="text_center" width="2%"></th>
        </tr>
        <tr class="empty_row border_left border_right">
            <th class="pleft10" colspan="7"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <th class="" width="60%">NO. RUJUKAN CUKAI PENDAPATAN SUAMI SG/OG* </th>
            <td class="table-border pleft">{{$data->getSpouseReferenceTaxRevenueNo()}}</td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row30 border_right border_left">
            <th class="text_center" colspan="4"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft15" style="font-size: 10pt;">Jika isteri/suami* warganegara asing, sila penuhkan butiran dibawah dan sertakan salinan muka surat pertama pasport :</td>
            <td class="" width="2%"></td>
        </tr>
    </table>
    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft15">TARIKH LAHIR  </td>
            <td class="table-border pleft">{{$data->getForeignerSpouseBirthDate()}}</td>
            <td class=""></td>
            <td class="pleft15">NO. PASPORT</td>
            <td class="table-border pleft">{{$data->getForeignerSpousePassportNo()}}</td>
            <td class="" width="40%"></td>
        </tr>
        <tr class="empty_row30 border_left border_right border_bottom">
            <th class="pleft10" colspan="7"></th>
        </tr>
    </table>

    <table class="padded">
        <tr class="border_right border_left">
            <th class="" width="2%"></th>
            <td class="" colspan="2">Saya mengaku bahawa maklumat yang tersebut diatas adalah benar.</td>
            <td class=""></td>
            <td class="pleft15"></td>
            <td class="pleft"></td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class="pleft15"></td>
            <td class="pleft"></td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class="" width="40%">Sila kembalikan borang ini ke alamat berikut : </td>
            <td class="" width="20%"></td>
            <td class=""width="2%"></td>
            <td class="pleft15"></td>
            <td class="pleft"></td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class="pleft15"></td>
            <td class="pleft"></td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft">LEMBAGA HASIL DALAM NEGERI</td>
            <td class=""></td>
            <td class=""></td>
            <td class="pleft15"></td>
            <td class="pleft"></td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft">Cawangan Pungutan,KL</td>
            <td class=""></td>
            <td class=""></td>
            <td class="pleft15"></td>
            <td class="pleft"></td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft">Unit 22-2.2 Cawangan Pungutan</td>
            <td class=""></td>
            <td class=""></td>
            <td class="pleft15"></td>
            <td class="pleft"></td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft" colspan="2">Tingkat 15,Blok 8A Kompleks Kerajaan Jalan Duta</td>
            <td class=""></td>
            <td class="pleft15"></td>
            <td class="pleft"></td>
            <td class="" width="2%"></td>
        </tr>
    </table>
    <table class="padded">
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft">Jalan Duta</td>
            <td class=""></td>
            <td class="border_bottom" width="30%"></td>
            <td class="pleft15" width="2%"></td>
            <td class="border_bottom"></td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row border_right border_left">
            <th class="" width="2%"></th>
            <td class="pleft">50600 KUALA LUMPUR</td>
            <td class=""></td>
            <td class="text_center" width="30%">TANDATANGAN PEKERJA</td>
            <td class="pleft15" width="2%"></td>
            <td class="text_center">TARIKH</td>
            <td class="" width="2%"></td>
        </tr>
        <tr class="empty_row30 border_left border_right border_bottom">
            <th class="pleft10" colspan="7"></th>
        </tr>
    </table>
    @endforeach

</div>
</body>
</html>
