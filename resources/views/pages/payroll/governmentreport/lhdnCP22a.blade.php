<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" href="{{public_path('css/report/soscoBorang8A/base.min.css')}}"/>
    <link rel="stylesheet" href="{{public_path('css/report/soscoBorang8A/main.css')}}"/>
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
    </style>
</head>
<body>
<div id="page-container">

    @foreach($dataArr as $data )
    <!-- next page -->
    <div style="page-break-before:always">&nbsp;</div>

    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <th class="tg-s268" rowspan="7" width="15%">
                <div class="text_center" style="padding-left: 3pt;">
                    <img style="width: 65pt;height: 65pt;" alt="" src="{{public_path('img/report/lhdn_grey.png')}}"/>
                </div>
            </th>
            <th class="blank_row" width="70%"></th>
            <th class="tg-s268" width="15%"></th>
        </tr>
        <tr>
            <td class="tg-s268" rowspan="6">
                <div class="text_center" style="font-size: 13pt;font-weight: bold">LEMBAGA HASIL DALAM NEGERI MALAYSIA
                    <br>PEMBERITAHUAN PEMBERHENTIAN KERJA (SWASTA)
                    </div>
                <div class="text_center" style="margin-top: 5pt;">
                    [SUBSEKSYEN 83(3) AKTA CUKAI PENDAPATAN 1967]
                </div>

            </td>
            <td class="tg-s268">
                <div class="text_left" style="font-size: 10pt;">CP22A (Pin. 1/2015)</div>
            </td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="text_center" style="font-size: 18pt;" rowspan="2"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
        </tr>
    </table>

    <table class="pf padded" style="margin-top: 5pt;">
        <tr>
            <td class="table-header-black" colspan="19">
                Borang pemberitahuan ini hendaklah dikemukakan kepada Lembaga Hasil Dalam Negeri Malaysia :
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>- sekurang-kurangnya satu (1) bulan sebelum tarikh pemberhentian seseorang pekerja; atau</b>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>- secepat yang mungkin apabila seseorang pekerja meninggal dunia</b>
            </td>
        </tr>
    </table>

    <table class="pf padded table-border">
        <tr>
            <td class="tg-s268" rowspan="9"></td>
            <td class="tg-s268"></td>
            <td class="border_right" rowspan="9"></td>
            <td class="tg-0lax" rowspan="9"></td>
            <td class="tg-0lax" colspan="15"></td>
        </tr>
        <tr>
            <td class="tg-s268">Nama & Alamat Majikan</td>
            <td class="tg-0lax" colspan="15">No. Majikan</td>
        </tr>
        <tr>
            <td class="border_top border_left border_right border_bottom pleft" rowspan="6">
                <br>
                {{$data->getEmployerName()}}
                <br>
                {{$data->getEmployerAddress1()}}
                <br>
                {{$data->getEmployerAddress2()}}
                <br>
                {{$data->getEmployerAddress3()}}
                <br>
                Poskod: {{$data->getEmployerPostcode()}}
                <br>
                <br>
            </td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(0,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[0] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="tg-0lax"></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(1,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[1] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(2,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[2] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(3,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[3] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(4,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[4] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(5,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[5] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(6,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[6] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(7,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[7] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(8,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[8] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(9,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[9] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="text_center"><div class="table-border"><?php echo (array_key_exists(10,$data->getEmployerNoArr())) ? $data->getEmployerNoArr()[10] : "&nbsp;&nbsp;"; ?></div></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="15"></td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="15"></td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="15">No. Telefon Majikan/ Employer's Telephone No.</td>
        </tr>
        <tr>
            <td colspan="13" rowspan="2">
                <div class="table-border" style="padding-left: 8pt;">
                    {{$data->getEmployerNoTel()}}
                    <br>
                    <br>
                </div>
            </td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax" colspan="15"></td>
        </tr>
    </table>

    <table class="pf padded " style="margin-top: 20pt;">
        <tr>
            <td class="table-header-black pleft" colspan="19">
               <b> A. BUTIR-BUTIR PEKERJA YANG BERHENTI KERJA / BERSARA / MENINGGAL DUNIA </b>
            </td>
        </tr>
    </table>

    <table class="pf padded table-border" style="margin-top: 20pt;">
        <tr>
            <th class="blank_row border_right" colspan="4" width="53%"></th>
            <th class="blank_row" colspan="3" width="47%"></th>
        </tr>
        <tr>
            <td class="pleft5" width="2%">1. </td>
            <td class="pleft5">Nama Penuh</td>
            <td class="tg-s268"></td>
            <td class="border_right" width="2%"></td>
            <td class="pleft10" width="2%">11.</td>
            <td class="pleft5">No. Telefon Pekerja Yang Berhenti Kerja/Bersara</td>
            <td class="tg-0lax" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="table-border pleft" colspan="2">{{$data->getNameA()}}</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">{{$data->getTelNoA()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="table-border" colspan="2"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class=""></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="border_right"></td>
            <td class="pleft10">12.</td>
            <td class="pleft5">Alamat surat-menyurat terkini:</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">2.</td>
            <td class="pleft5" width="30%">Tarikh Mula Bekerja / </td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt;">
                    <?php echo (array_key_exists(0,$data->getCommencementDateArr())) ? $data->getCommencementDateArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getCommencementDateArr())) ? $data->getCommencementDateArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(2,$data->getCommencementDateArr())) ? $data->getCommencementDateArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getCommencementDateArr())) ? $data->getCommencementDateArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(4,$data->getCommencementDateArr())) ? $data->getCommencementDateArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getCommencementDateArr())) ? $data->getCommencementDateArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">{{$data->getAddress1A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">{{$data->getAddress2A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">3.</td>
            <td class="pleft5">Tarikh Berhenti/Persaraan/Kematian</td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt;">
                    <?php echo (array_key_exists(0,$data->getResignDateArr())) ? $data->getResignDateArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getResignDateArr())) ? $data->getResignDateArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(2,$data->getResignDateArr())) ? $data->getResignDateArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getResignDateArr())) ? $data->getResignDateArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(4,$data->getResignDateArr())) ? $data->getResignDateArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getResignDateArr())) ? $data->getResignDateArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">{{$data->getAddress3A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">Poskod : {{$data->getPostcodeA()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">4.</td>
            <td class="pleft5">Tarikh Lahir</td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt;">
                    <?php echo (array_key_exists(0,$data->getBirthDateArr())) ? $data->getBirthDateArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getBirthDateArr())) ? $data->getBirthDateArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(2,$data->getBirthDateArr())) ? $data->getBirthDateArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getBirthDateArr())) ? $data->getBirthDateArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(4,$data->getBirthDateArr())) ? $data->getBirthDateArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getBirthDateArr())) ? $data->getBirthDateArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">5.</td>
            <td class="pleft5">Jenis Persaraan  </td>
            <td class="">
                <div style="float: left;">
                    Wajib
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; margin-left: 5pt;">
                    0
                </div>
                <div style="float: left; margin-left: 10pt">
                    Pilihan
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; margin-left: 5pt">
                    0
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 10pt; padding-right: 10pt; color: #FFFFFF">
                    &nbsp;{{$data->getSignX()}}
                </div>
                <div class="" style="height: 12pt;float: left; margin-left: 10pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; font-size: 10pt;">
                    Tandakan 'X' jika alamat surat-menyurat di atas
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5" colspan="2"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">
                <div class="" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 10pt; padding-right: 10pt;color: #FFFFFF">
                    &nbsp;&nbsp;s
                </div>
                <div class="" style="height: 12pt;float: left; margin-left: 10pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; font-size: 10pt;">
                    adalah alamat ejen cukai
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">6.</td>
            <td class="pleft5" colspan="2">No. Rujukan(No. Kad Pengenalan/Polis/Tentera/Pasport)</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5" colspan="2">
                <div class="table-border " style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(0,$data->getIcNoArr())) ? $data->getIcNoArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getIcNoArr())) ? $data->getIcNoArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(2,$data->getIcNoArr())) ? $data->getIcNoArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getIcNoArr())) ? $data->getIcNoArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(4,$data->getIcNoArr())) ? $data->getIcNoArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getIcNoArr())) ? $data->getIcNoArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(6,$data->getIcNoArr())) ? $data->getIcNoArr()[6] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(7,$data->getIcNoArr())) ? $data->getIcNoArr()[7] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(8,$data->getIcNoArr())) ? $data->getIcNoArr()[8] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(9,$data->getIcNoArr())) ? $data->getIcNoArr()[9] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(10,$data->getIcNoArr())) ? $data->getIcNoArr()[10] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(11,$data->getIcNoArr())) ? $data->getIcNoArr()[11] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="pleft10">13.</td>
            <td class="pleft5">Maklumat Wakil Sah [ Bagi Kes Meninggal Dunia ]:</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="pleft10"></td>
            <td class="pleft5">a) Nama Penuh</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">7.</td>
            <td class="pleft5" colspan="2">No. Cukai Pendapatan</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">{{$data->getLegalRepresentativeNameA()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5" colspan="2">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(0,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; margin-left: 6pt; ">
                    <?php echo (array_key_exists(2,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(4,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(6,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[6] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(7,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[7] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(8,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[8] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(9,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[9] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(10,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[10] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(11,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[11] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(12,$data->getIncomeTaxNoArr())) ? $data->getIncomeTaxNoArr()[12] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5"></td>
            <td class=""></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft5">b) No. Rujukan(No.Kad Pengenalan/Polis/Tentera/Pasport)</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">8.</td>
            <td class="pleft5">Taraf Perkahwinan</td>
            <td class="table-border pleft"> {{$data->getMarriedStatusA()}}</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="">
                <div class="table-border " style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(0,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(2,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(4,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(6,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[6] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(7,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[7] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(8,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[8] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(9,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[9] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(10,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[10] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(11,$data->getLegalRepresentativeIcArr())) ? $data->getLegalRepresentativeIcArr()[11] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="pleft10"></td>
            <td class="pleft5"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">9.</td>
            <td class="pleft5">Tuntutan Potongan Cukai Bagi Anak :</td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft5">c) Alamat surat-menyurat</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5">a) Bilangan anak</td>
            <td class="">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(0,$data->getChildrenNoArr())) ? $data->getChildrenNoArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getChildrenNoArr())) ? $data->getChildrenNoArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div style="float: left;margin-left: 1pt; height: 12pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; ">
                    Orang
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">{{$data->getLegalRepresentativeAddress1A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">{{$data->getLegalRepresentativeAddress2A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5">
                <div style="float: left;">
                    b) Jumlah
                </div>
                <div class="text_right">
                    RM
                </div>
            </td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt; width: 80pt; float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    {{$data->getTotalIncomeTaxChildA()}}
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10">{{$data->getLegalRepresentativeAddress3A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5"></td>
            <td class=""></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">10.</td>
            <td class="pleft5" colspan="2">Jika berkahwin, lengkapkan maklumat suami/isteri :</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5" colspan="2">a) Nama Penuh Suami/isteri :</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="table-border pleft5" colspan="2">{{$data->getSpouseNameA()}}</td>
            <td class="border_right"></td>
            <td class="pleft10"></td>
            <td class="pleft5">
                <div style="float: left;">
                    d) No. Telefon
                </div>
                <div class="table-border" style="float: left; margin-left: 10pt;padding-left: 5pt;display: table-cell;width: 50%;">
                    &nbsp;{{$data->getLegalRepresentativeNoTelA()}}
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="table-border pleft5" colspan="2"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft5"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5" colspan="2"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft5"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5" colspan="2">b) No. Rujukan (No. Kad Pengenalan/Polis/Tentera/Pasport)</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5" colspan="2">
                <div class="table-border " style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(0,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(2,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(4,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(6,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[6] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(7,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[7] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(8,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[8] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(9,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[9] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(10,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[10] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(11,$data->getSpouseIcArr())) ? $data->getSpouseIcArr()[11] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5" colspan="2"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5" colspan="2">c) No. Cukai Pendapatan</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5"></td>
            <td class="pleft5" colspan="2">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(0,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; margin-left: 6pt; ">
                    <?php echo (array_key_exists(2,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(4,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(6,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[6] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(7,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[7] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(8,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[8] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(9,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[9] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(10,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[10] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(11,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[11] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(12,$data->getSpouseIncomeTaxArr())) ? $data->getSpouseIncomeTaxArr()[12] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax border_right" colspan="4"></td>
            <td class="tg-0lax" colspan="3"></td>
        </tr>
    </table>

    <!-- page 2 -->
    <div style="page-break-before:always">&nbsp;</div>
    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <th class="table-header-black border_left border_right" colspan="5">B. BUTIR-BUTIR SARAAN</th>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft border_right" colspan="2" rowspan="3" width="55%">
                Butir-butir saraan yang diterima dalam tahun semasa untuk tempoh dari
                <br>
                hari pertama tahun semasa sehingga tarikh berhenti kerja /
                <br>
                bersara / meninggal dunia
            </td>
            <td class="text_center" colspan="3">Tahun Semasa</td>
        </tr>
        <tr>
            <td class="text_center border_left border_right border_bottom" colspan="2">Tempoh</td>
            <td class="text_center border_right border_bottom"></td>
        </tr>
        <tr>
            <td class="text_center border_bottom border_right" height="20%">Dari</td>
            <td class="text_center border_right border_bottom">Hingga</td>
            <td class="text_center border_right border_bottom" width="8%">RM</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="width: 18pt;border-right-style: none;">1)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">
                Gaji, bayaran, upah-upah dan kerja lebih masa
            </td>
            <td class="text_center border_right" valign="top">{{$data->getSalaryFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getSalaryUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getSalaryAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;">2)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Gaji cuti</td>
            <td class="text_center border_right" valign="top">{{$data->getLeavePayFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getLeavePayUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getLeavePayAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;">3)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Komisen dan Bonus</td>
            <td class="text_center border_right" valign="top">{{$data->getCommissionFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCommissionUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCommissionAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;">4)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Ganjaran</td>
            <td class="text_center border_right" valign="top">{{$data->getGratuityFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getGratuityUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getGratuityAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;">5)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Pampasan kerana kehilangan pekerjaan</td>
            <td class="text_center border_right" valign="top">{{$data->getCompensationFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCompensationUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCompensationAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;" valign="top">6)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Elaun tunai termasuk cukai ditanggung oleh majikan <br> (sebutkan jenis-jenis elaun) .....................</td>
            <td class="text_center border_right" valign="top">{{$data->getCashAllowanceFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCashAllowanceUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCashAllowanceAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;">7)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Pencen daripada majikan</td>
            <td class="text_center border_right" valign="top">{{$data->getPensionFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getPensionUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getPensionAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;">8)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Manfaat berupa barangan yang layak dikenakan cukai</td>
            <td class="text_center border_right" valign="top">{{$data->getBenefitSubjectToTaxFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getBenefitSubjectToTaxUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getBenefitSubjectToTaxAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;">9)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Nilai tahunan tempat kediaman yang disediakan oleh majikan</td>
            <td class="text_center border_right" valign="top">{{$data->getLivingAccommodationFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getLivingAccommodationUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getLivingAccommodationAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;" valign="top">10)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Elaun-elaun selain dari wang seperti makanan, pakaian, lojing atau <br> pembantu rumah yang diperuntukkan atau dibayar oleh majikan</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherAllowanceFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherAllowanceUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherAllowanceAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;">11)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Kereta dan pemandu</td>
            <td class="text_center border_right" valign="top">{{$data->getTransportFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getTransportUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getTransportAmountB()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft" style="border-right-style: none;" valign="top">12)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Lain-lain bayaran (jika ada,nyatakan) <br> ............................................................................</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherPaymentsFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherPaymentsUntilB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherPaymentsAmountB()}}</td>
        </tr>

        <tr class="border_bottom border_left border_right">
            <td class="pleft border_bottom" style="border-right-style: none;" valign="top" rowspan="2">13)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;" rowspan="2">
                Manfaat dari Skim Pemberian Saham dari majikan
                <br>
                kepada pekerja seperti ESOS,ESPP dan lain-lain:
                <br>
                <br>
                Nyatakan:
                <br>
                &nbsp;&nbsp; i. Bilangan saham layak: .......................................................
                <br>
                &nbsp;&nbsp; ii. Baki yang belum dilaksanakan: ........................................
                <br>
                <br>
            </td>
            <td class="tg-s268" rowspan="2" style="border-right-style: none; font-size: 10pt;">
                <div style="display: table-row">
                    &nbsp;Tarikh opsyen diberi
                </div>
                <br>
                <div style="display: table-row">
                    &nbsp;Tarikh opsyen boleh laksana
                </div>
                <br>
                <div style="display: table-row">
                    &nbsp;Tarikh opsyen dilaksana:
                </div>
                <br>
                <div style="display: table-row">
                    &nbsp;Jumlah manfaat:
                </div>
            </td>
            <td class="tg-s268 border_right" rowspan="2" style="border-left-style: none;">
                <div style="display: table-row">
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 20pt;">
                        <?php echo (array_key_exists(0,$data->getDateOptionGrantedArr())) ? $data->getDateOptionGrantedArr()[0] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(1,$data->getDateOptionGrantedArr())) ? $data->getDateOptionGrantedArr()[1] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                        <?php echo (array_key_exists(2,$data->getDateOptionGrantedArr())) ? $data->getDateOptionGrantedArr()[2] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(3,$data->getDateOptionGrantedArr())) ? $data->getDateOptionGrantedArr()[3] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                        <?php echo (array_key_exists(4,$data->getDateOptionGrantedArr())) ? $data->getDateOptionGrantedArr()[4] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(5,$data->getDateOptionGrantedArr())) ? $data->getDateOptionGrantedArr()[5] : "&nbsp;&nbsp;"; ?>
                    </div>
                </div>
                <br>
                <div style="display: table-row">
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 20pt;">
                        <?php echo (array_key_exists(0,$data->getDateExistingOptionCanExecutedArr())) ? $data->getDateExistingOptionCanExecutedArr()[0] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(1,$data->getDateExistingOptionCanExecutedArr())) ? $data->getDateExistingOptionCanExecutedArr()[1] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                        <?php echo (array_key_exists(2,$data->getDateExistingOptionCanExecutedArr())) ? $data->getDateExistingOptionCanExecutedArr()[2] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(3,$data->getDateExistingOptionCanExecutedArr())) ? $data->getDateExistingOptionCanExecutedArr()[3] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                        <?php echo (array_key_exists(4,$data->getDateExistingOptionCanExecutedArr())) ? $data->getDateExistingOptionCanExecutedArr()[4] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(5,$data->getDateExistingOptionCanExecutedArr())) ? $data->getDateExistingOptionCanExecutedArr()[5] : "&nbsp;&nbsp;"; ?>
                    </div>
                </div>
                <br>
                <div style="display: table-row">
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 20pt;">
                        <?php echo (array_key_exists(0,$data->getDateOptionExecutedArr())) ? $data->getDateOptionExecutedArr()[0] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(1,$data->getDateOptionExecutedArr())) ? $data->getDateOptionExecutedArr()[1] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                        <?php echo (array_key_exists(2,$data->getDateOptionExecutedArr())) ? $data->getDateOptionExecutedArr()[2] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(3,$data->getDateOptionExecutedArr())) ? $data->getDateOptionExecutedArr()[3] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                        <?php echo (array_key_exists(4,$data->getDateOptionExecutedArr())) ? $data->getDateOptionExecutedArr()[4] : "&nbsp;&nbsp;"; ?>
                    </div>
                    <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                        <?php echo (array_key_exists(5,$data->getDateOptionExecutedArr())) ? $data->getDateOptionExecutedArr()[5] : "&nbsp;&nbsp;"; ?>
                    </div>
                </div>
                <br>
                <div style="display: table-row;float: right;padding-right: 5pt;">
                    RM
                </div>

            </td>
            <td class="tg-0lax" style="border-bottom-style: none;"></td>
        </tr>
        <tr style="height: 0;">
            <td class="text_right border_right border_bottom" valign="bottom" style="border-top-style: none;" >
                &nbsp;{{$data->getTotalBenefit()}}
            </td>
        </tr>

        <tr class="border_bottom border_left border_right">
            <td class="tg-0lax border_right" colspan="4"><span style="padding-left: 5pt;">JUMLAH</span> <span style="float: right;padding-right: 5pt;">RM</span></td>
            <td class="text_right">{{$data->getTotalB()}}</td>
        </tr>
    </table>


    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <th class="table-header-black border_right border_left" colspan="5">C. BUTIR-BUTIR PENDAPATAN YANG BELUM DILAPORKAN</th>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="pleft3 border_right" width="4%" style="border-bottom-style: none;">Bil.</td>
            <td class="pleft3 border_right" width="23%" style="border-bottom-style: none;">Jenis Pendapatan</td>
            <td class="pleft3 border_right" width="23%" style="border-bottom-style: none;">Tempoh Diperolehi</td>
            <td class="pleft3 border_right" width="23%" style="border-bottom-style: none;">Jumlah Pendapatan (RM)</td>
            <td class="pleft3" width="27%" style="border-bottom-style: none;">Caruman KWSP Pekerja (RM)</td>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="pleft3 border_right" style="font-size: 10pt;">(i)</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getTypeOfIncome1C()}}</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getYearForWhichPaid1C()}}</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getTotalIncome1C()}}</td>
            <td class="tg-s268 pleft3" style="font-size: 10pt;">{{$data->getPensionFund1C()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft3 border_right" style="font-size: 10pt;">(ii)</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getTypeOfIncome2C()}}</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getYearForWhichPaid2C()}}</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getTotalIncome2C()}}</td>
            <td class="tg-s268 pleft3" style="font-size: 10pt;">{{$data->getPensionFund2C()}}</td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft3 border_right" style="font-size: 10pt;">(iii)</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getTypeOfIncome3C()}}</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getYearForWhichPaid3C()}}</td>
            <td class="tg-s268 border_right pleft3" style="font-size: 10pt;">{{$data->getTotalIncome3C()}}</td>
            <td class="tg-s268 pleft3" style="font-size: 10pt;">{{$data->getPensionFund3C()}}</td>
        </tr>
    </table>

    <table class="pf padded" style="margin-top: 10pt;">
        <tr >
            <th class="table-header-black border_right border_left" colspan="4">D. BUTIR-BUTIR LAIN</th>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft3" width="2%" style="border-right-style: none;">
                1)
            </td>
            <td class="tg-s268" width="76%" style="border-left-style: none; border-right-style: none;">
                <br>
                Jumlah wang yang ditahan oleh majikan dan akan dibayar kepada pekerja
                <br>
                <br>
            </td>
            <td class="tg-s268" style="border-left-style: none; border-right-style: none;" width="20%">
                <div>
                    RM {{$data->getMoneyWithheldByEmployerD()}}
                </div>
                <div class="border_bottom" style="color: #FFFFFF">
                </div>
            </td>
            <td class="tg-s268" width="2%" style="border-left-style: none;">

            </td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft3" width="2%" style="border-right-style: none;">
                2)
            </td>
            <td class="tg-s268" width="76%" style="border-left-style: none; border-right-style: none;">
                <br>
                Jumlah Potongan Cukai Bulanan yang dibayar ke LHDNM dalam tahun ini
                <br>
                <br>
            </td>
            <td class="tg-s268" style="border-left-style: none; border-right-style: none;" width="20%">
                <div>
                    RM {{$data->getMonthlyTaxDeductionsD()}}
                </div>
                <div class="border_bottom" style="color: #FFFFFF">
                </div>
            </td>
            <td class="tg-s268" width="2%" style="border-left-style: none;">

            </td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft3" width="2%" style="border-right-style: none;">
                3)
            </td>
            <td class="tg-s268" width="76%" style="border-left-style: none; border-right-style: none;">
                <br>
                Jumlah potongan zakat dalam tahun ini
                <br>
                <br>
            </td>
            <td class="tg-s268" style="border-left-style: none; border-right-style: none;" width="20%">
                <div>
                    RM {{$data->getAmountOfZakatPaidD()}}
                </div>
                <div class="border_bottom" style="color: #FFFFFF">
                </div>
            </td>
            <td class="tg-s268" width="2%" style="border-left-style: none;">

            </td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="pleft3" width="2%" style="border-right-style: none;">
                4)
            </td>
            <td class="tg-s268" width="76%" style="border-left-style: none; border-right-style: none;">
                <br>
                Caruman pekerja kepada KWSP atau kumpulan wang yang diluluskan
                <br>
                <br>
            </td>
            <td class="tg-s268" style="border-left-style: none; border-right-style: none;" width="20%">
                <div>
                    RM  {{$data->getContributionsToEmployeeProvidentFundD()}}
                </div>
                <div class="border_bottom" style="color: #FFFFFF">
                </div>
            </td>
            <td class="tg-s268" width="2%" style="border-left-style: none;">

            </td>
        </tr>
    </table>

    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <th class="table-header-black border_left border_right" colspan="3">E. AKUAN PEGAWAI YANG DIBERI KUASA</th>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="tg-s268" style="padding-top: 15pt;padding-bottom: 15pt;padding-left: 13pt;border-right-style: none;" width="25%">Nama :</td>
            <td class="tg-s268" width="70%" style="border-left-style: none;border-right-style: none;">
                <div class="table-border" style="height: 25pt;padding-left: 10pt;">
                    {{$data->getOfficerNameE()}}
                </div>
            </td>
            <td class="tg-s268" width="5%" style="border-left-style: none;"></td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="tg-s268" style="padding-top: 15pt;padding-bottom: 15pt;padding-left: 13pt;border-right-style: none;">Jawatan :</td>
            <td class="tg-s268" style="border-left-style: none;border-right-style: none;">
                <div class="table-border" style="height: 25pt;padding-left: 10pt;">
                    {{$data->getOfficerDesignationE()}}
                </div>
            </td>
            <td class="tg-s268" style="border-left-style: none;"></td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="tg-s268" style="padding-top: 15pt;padding-bottom: 50pt;padding-left: 13pt;border-right-style: none;">Tandatangan :</td>
            <td class="tg-s268" style="border-left-style: none;border-right-style: none;">
                <div class="table-border" style="height: 60pt;padding-left: 10pt;">
                    {{$data->getOfficerSignatureE()}}
                </div>
            </td>
            <td class="tg-s268" style="border-left-style: none;"></td>
        </tr>
        <tr class="border_bottom border_left border_right">
            <td class="tg-s268" style="padding-top: 15pt;padding-bottom: 15pt;padding-left: 13pt;border-right-style: none;">Tarikh :</td>
            <td class="tg-s268" style="border-left-style: none;border-right-style: none;">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(0,$data->getDateArr())) ? $data->getDateArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getDateArr())) ? $data->getDateArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; margin-left: 6pt">
                    <?php echo (array_key_exists(2,$data->getDateArr())) ? $data->getDateArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getDateArr())) ? $data->getDateArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; margin-left: 6pt">
                    <?php echo (array_key_exists(4,$data->getDateArr())) ? $data->getDateArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getDateArr())) ? $data->getDateArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="tg-s268" style="border-left-style: none;"></td>
        </tr>
    </table>
    @endforeach
</div>
</body>
</html>
