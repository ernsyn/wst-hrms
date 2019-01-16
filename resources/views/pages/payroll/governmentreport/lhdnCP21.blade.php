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

        .text_padding{
            padding-top: 3pt;
            padding-bottom: 3pt;
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
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </th>
            <th class="blank_row" width="70%"></th>
            <th class="tg-s268" width="15%"></th>
        </tr>
        <tr>
            <td class="tg-s268" rowspan="6">
                <div class="text_center" style="font-size: 13pt;font-weight: bold">LEMBAGA HASIL DALAM NEGERI MALAYSIA
                    <br>PEMBERITAHUAN OLEH MAJIKAN BAGI PEKERJA YANG HENDAK
                    <br>MENINGGALKAN MALAYSIA
                    </div>
                    <br>
                <div class="text_center">
                    NOTIFICATION BY EMPLOYER OF EMPLOYEE'S DEPARTURE FORM MALAYSIA
                    <br>
                    <b>[SUBSEKSYEN 83(3) AKTA CUKAI PENDAPATAN 1967]</b>
                    <br>
                    [SUBSECTION 83(4) INCOME TAX ACT 1967]
                </div>

            </td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td class="text_center" style="font-size: 18pt;" rowspan="2">
                <div class="text_left" style="font-size: 10pt;">CP21 [Pin.1/2015]</div>
                <div class="border_top border_left border_right border_bottom">
                    <b>LEAVER</b>
                </div>

            </td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td class="tg-s268"></td>
        </tr>
    </table>
    <table class="pf padded">
        <tr>
            <td class="table-header-black" colspan="19">
                Satu salinan borang pemberitahuan ini hendaklah dikemukakan kepada Lembaga Hasil Dalam Negeri Malaysia
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;- sekurang-kurangnya satu (1) bulan sebelum tarikh dijangka meninggalkan Malaysia.
                <br>
                <b>A copy of this notification should be submitted to Inland Revenue Board:</b>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;<b>- not less than one (1) month before the expected date of departure.</b>
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
        <tr class="border_right">
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
                A. BUTIR-BUTIR PEKERJA YANG BERHENTI KERJA / BERSARA / MENINGGAL DUNIA
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;PARTICULARS OF THE EMPLOYEE WHO WILL BE LEAVING MALAYSIA
                <br>
            </td>
        </tr>
    </table>

    <table class="pf padded table-border" style="margin-top: 20pt; font-size: 10pt;">
        <tr>
            <th class="blank_row border_right" colspan="4" width="53%"></th>
            <th class="blank_row" colspan="3" width="47%"></th>
        </tr>
        <tr>
            <td class="pleft5" width="2%">1. </td>
            <td class="pleft5">Nama Penuh/ Name of Employee</td>
            <td class="tg-s268"></td>
            <td class="border_right" width="2%"></td>
            <td class="pleft10" width="2%">11.</td>
            <td class="pleft5">Alamat surat-menyurat pekerja yang terkini /</td>
            <td class="tg-0lax" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="table-border text_padding pleft" colspan="2">{{$data->getNameA()}}</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft5">Current address of employee</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="table-border text_padding pleft" colspan="2"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getAddress1A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getAddress2A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">2.</td>
            <td class="pleft5" width="30%">Tarikh Mula Bekerja / </td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt;">
                    <?php echo (array_key_exists(0,$data->getDateOfCommencementArr())) ? $data->getDateOfCommencementArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getDateOfCommencementArr())) ? $data->getDateOfCommencementArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(2,$data->getDateOfCommencementArr())) ? $data->getDateOfCommencementArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getDateOfCommencementArr())) ? $data->getDateOfCommencementArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(4,$data->getDateOfCommencementArr())) ? $data->getDateOfCommencementArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getDateOfCommencementArr())) ? $data->getDateOfCommencementArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getAddress3A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5">Date of Commencement </td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">Poskod : {{$data->getEmployerPostcode()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">3.</td>
            <td class="pleft5">Tarikh Dijangka Meninggalkan Malaysia</td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt;">
                    <?php echo (array_key_exists(0,$data->getExpectedDatetoLeaveMalaysiaArr())) ? $data->getExpectedDatetoLeaveMalaysiaArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getExpectedDatetoLeaveMalaysiaArr())) ? $data->getExpectedDatetoLeaveMalaysiaArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(2,$data->getExpectedDatetoLeaveMalaysiaArr())) ? $data->getExpectedDatetoLeaveMalaysiaArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getExpectedDatetoLeaveMalaysiaArr())) ? $data->getExpectedDatetoLeaveMalaysiaArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(4,$data->getExpectedDatetoLeaveMalaysiaArr())) ? $data->getExpectedDatetoLeaveMalaysiaArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getExpectedDatetoLeaveMalaysiaArr())) ? $data->getExpectedDatetoLeaveMalaysiaArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5">Expected Date to Leave Malaysia</td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 10pt; padding-right: 10pt;">
                    &nbsp;{{$data->getXAddressBelongsToTaxAgentA()}}
                </div>
                <div class="" style="height: 12pt;float: left; margin-left: 10pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; font-size: 10pt;">
                    Tandakan 'X' jika alamat surat-menyurat di atas
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">4.</td>
            <td class="pleft5" colspan="2">No. Pengenalan(No. Kad Pengenalan/Polis/Tentera/Pasport) </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">
                <div class="" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 10pt; padding-right: 10pt;color: #FFFFFF">
                    A
                </div>
                <div class="" style="height: 12pt;float: left; margin-left: 10pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; font-size: 10pt;">
                    adalah alamat ejen cukai /
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5" colspan="2">Identification No.(Identity Card / Police / Army / Passport No.) </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">
                <div class="" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 10pt; padding-right: 10pt;color: #FFFFFF">
                    A
                </div>
                <div class="" style="height: 12pt;float: left; margin-left: 10pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; font-size: 9pt;">
                    Enter 'X' if the above correspondence address
                </div>
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5" colspan="2">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    0
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(0,$data->getIcArr())) ? $data->getIcArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getIcArr())) ? $data->getIcArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(2,$data->getIcArr())) ? $data->getIcArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getIcArr())) ? $data->getIcArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(4,$data->getIcArr())) ? $data->getIcArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getIcArr())) ? $data->getIcArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(6,$data->getIcArr())) ? $data->getIcArr()[6] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(7,$data->getIcArr())) ? $data->getIcArr()[7] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(8,$data->getIcArr())) ? $data->getIcArr()[8] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(9,$data->getIcArr())) ? $data->getIcArr()[9] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(10,$data->getIcArr())) ? $data->getIcArr()[10] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">
                <div class="" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 10pt; padding-right: 10pt;color: #FFFFFF">
                    A
                </div>
                <div class="" style="height: 12pt;float: left; margin-left: 10pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; font-size: 10pt;">
                    belongs to a tax agent
                </div>
            </td>
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
            <td class="pleft5">No. Cukai Pendapatan / Income Tax No. </td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="pleft10">12.</td>
            <td class="pleft5">Alasan meninggalkan negara ini /</td>
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
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getReasonLeaveMalaysiaA()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">6.</td>
            <td class="pleft5"> Warganegara / Citizen</td>
            <td class="table-border text_padding pleft">{{$data->getCitizenshipA()}}</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getReasonLeaveMalaysiaA()}}</td>
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
            <td class="pleft5">7.</td>
            <td class="pleft5">Tarikh Lahir / Date of Birth </td>
            <td class="tg-0lax">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt;">
                    <?php echo (array_key_exists(0,$data->getDateOfBirthArr())) ? $data->getDateOfBirthArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getDateOfBirthArr())) ? $data->getDateOfBirthArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(2,$data->getDateOfBirthArr())) ? $data->getDateOfBirthArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getDateOfBirthArr())) ? $data->getDateOfBirthArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; margin-left: 6pt">
                    <?php echo (array_key_exists(4,$data->getDateOfBirthArr())) ? $data->getDateOfBirthArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getDateOfBirthArr())) ? $data->getDateOfBirthArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="pleft10">13.</td>
            <td class="pleft5">Alamat surat-menyurat di luar Malaysia</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft5">Correspondence address outside Malaysia</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">8.</td>
            <td class="pleft5">Tempat Lahir /</td>
            <td class="table-border text_padding pleft">{{$data->getPlaceOfBirthA()}}</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getAddressOutMalaysia1A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5">Place of Birth</td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getAddressOutMalaysia2A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getAddressOutMalaysia3A()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft5">9.</td>
            <td class="pleft5">Jenis Pekerjaan /</td>
            <td class="table-border" rowspan="2">{{$data->getNatureOfEmploymentA()}}</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="pleft5">Nature of Employment</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding"></td>
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
            <td class="pleft5">10.</td>
            <td class="pleft5" colspan="2">No. Telefon Pekerja / Employee's Telephone No</td>
            <td class="border_right"></td>
            <td class="pleft10">14.</td>
            <td class="pleft5">Jika akan kembali ke Malaysia, nyatakan tarikh dijangka kembali</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="table-border pleft5 text_padding" colspan="2">{{$data->getTelnoA()}}</td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="pleft5">if returning to Malaysia, state the probable date of return</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="table-border pleft10 text_padding">{{$data->getStateProbableDateofReturnA()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax border_right" colspan="4"></td>
            <td class="tg-0lax" colspan="3"></td>
        </tr>
    </table>

    <!-- page 2 -->
    <div style="page-break-before:always">&nbsp;</div>
    <table class="pf padded" style="margin-top: 10pt; border: 1px solid grey;">
        <tr>
            <th class="table-header-black" colspan="5">B. BUTIR-BUTIR SARAAN /</th>
        </tr>
        <tr>
            <td class="pleft" colspan="2" rowspan="3" width="55%">
                Jika pekerja tidak kembali, nyatakan di bawah ini emolumen dan
                <br>
                caruman kepada mana-mana Kumpulan Wang yang diluluskan bagi /
                <br>
                tahun beliau meninggalkan negara ini :
                <br>
                If not returning, state the emoluments and any approved Provident Fund
                <br>
                contributions for the year of departure below :
            </td>
            <td class="text_center border_bottom border_left" colspan="3">Tahun Semasa / Current year</td>
        </tr>
        <tr>
            <td class="text_center border_bottom border_right" colspan="2">Tempoh / Period</td>
            <td class="text_center border_bottom" rowspan="2">RM</td>
        </tr>
        <tr class="border_bottom">
            <td class="text_center border_right" height="20%">Dari / From</td>
            <td class="text_center">Hingga / Until</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft border_top" style="width: 18pt;border-right-style: none;">1)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">
                Gaji, bayaran, upah-upah dan kerja lebih masa
                <br>
                Salary, fees, wages, and overtime pay
            </td>
            <td class="text_center border_right" valign="top">{{$data->getSalaryFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getSalaryUntilB()}}</td>
            <td class="text_center" valign="top">{{number_format($data->getSalaryAmountB(),2)}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">2)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Gaji cuti <br> Leave pay</td>
            <td class="text_center border_right" valign="top">{{$data->getLeavePayFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getLeavePayUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getLeavePayAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">3)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Komisen dan Bonus <br> Commission and bonus</td>
            <td class="text_center border_right" valign="top">{{$data->getCommissionFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCommissionUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getCommissionAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">4)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Ganjaran <br> Gratuity</td>
            <td class="text_center border_right" valign="top">{{$data->getGratuityFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getGratuityUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getGratuityAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">5)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Pampasan kerana kehilangan pekerjaan <br> Compensation for loss of employment</td>
            <td class="text_center border_right" valign="top">{{$data->getCompensationFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCompensationUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getCompensationAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">6)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Elaun tunai termasuk cukai ditanggung oleh majikan <br> (sebutkan jenis-jenis elaun) .....................</td>
            <td class="text_center border_right" valign="top">{{$data->getCashAllowanceFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getCashAllowanceUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getCashAllowanceAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">7)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Pencen daripada majikan <br> Pension from employer</td>
            <td class="text_center border_right" valign="top">{{$data->getPensionFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getPensionUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getPensionAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">8)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Manfaat berupa barangan yang layak dikenakan cukai <br> Benefit in Kind subject to tax</td>
            <td class="text_center border_right" valign="top">{{$data->getBenefitSubjectToTaxFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getBenefitSubjectToTaxUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getBenefitSubjectToTaxAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">9)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Nilai tahunan tempat kediaman yang disediakan oleh majikan <br> Value of living accommodation provided by the employer</td>
            <td class="text_center border_right" valign="top">{{$data->getLivingAccommodationFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getLivingAccommodationUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getLivingAccommodationAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">10)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Elaun-elaun selain dari wang seperti makanan, pakaian, lojing atau <br> pembantu rumah yang diperuntukkan atau dibayar oleh majikan</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherAllowanceFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherAllowanceUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getOtherAllowanceAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="pleft" style="border-right-style: none;">11)</td>
            <td class="tg-s268 border_right" style="border-left-style: none;">Bayaran-bayaran lain (jika ada,nyatakan) <br> Other payments (if any, please specify ..........................</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherPaymentsFromB()}}</td>
            <td class="text_center border_right" valign="top">{{$data->getOtherPaymentsUntilB()}}</td>
            <td class="text_center" valign="top">{{$data->getOtherPaymentsAmountB()}}</td>
        </tr>
        <tr class="border_bottom">
            <td class="tg-0lax border_right" colspan="4"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax border_right" colspan="4"><span style="padding-left: 5pt;">JUMLAH / TOTAL</span> <span style="float: right;padding-right: 5pt;">RM</span></td>
            <td class="text_center">{{$data->getTotalB()}}</td>
        </tr>
    </table>


    <table class="pf padded" style="margin-top: 10pt;">
        <tr class="border_right border_left">
            <th class="table-header-black" colspan="5">C. BUTIR-BUTIR PENDAPATAN YANG BELUM DILAPORKAN / INCOME OF PRECEDING YEARS NOT DECLARED</th>
        </tr>
        <tr class="border_right border_left">
            <td class="pleft3 border_right" width="4%" style="border-bottom-style: none;">Bil.</td>
            <td class="pleft3 border_right" width="23%" style="border-bottom-style: none;">Jenis Pendapatan</td>
            <td class="pleft3 border_right" width="23%" style="border-bottom-style: none;">Tempoh Diperolehi</td>
            <td class="pleft3 border_right" width="23%" style="border-bottom-style: none;">Jumlah Pendapatan (RM)</td>
            <td class="pleft3" width="27%" style="border-bottom-style: none;">Caruman KWSP Pekerja (RM)</td>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="pleft3 border_right" style="border-top-style: none;"></td>
            <td class="pleft3 border_right" style="font-style: italic;font-size: 9pt; border-top-style: none;">Type of Income</td>
            <td class="pleft3 border_right" style="font-style: italic;font-size: 9pt; border-top-style: none;">Year for Which Paid</td>
            <td class="pleft3 border_right" style="font-style: italic;font-size: 9pt; border-top-style: none;">Total Income(RM)</td>
            <td class="pleft3" style="font-style: italic;font-size: 9pt; border-top-style: none;">Provident & Pension Fund Contribution(RM)</td>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="pleft3 border_right" style="font-size: 10pt;">(i)</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getTypeOfIncome1C()}}</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getYearForWhichPaid1C()}}</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getTotalIncome1C()}}</td>
            <td class="tg-s268 pleft" style="font-size: 10pt;">{{$data->getPensionFund1C()}}</td>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="pleft3 border_right" style="font-size: 10pt;">(ii)</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getTypeOfIncome2C()}}</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getYearForWhichPaid2C()}}</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getTotalIncome2C()}}</td>
            <td class="tg-s268 pleft" style="font-size: 10pt;">{{$data->getPensionFund2C()}}</td>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="pleft3 border_right" style="font-size: 10pt;">(iii)</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getTypeOfIncome3C()}}</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getYearForWhichPaid3C()}}</td>
            <td class="tg-s268 border_right pleft" style="font-size: 10pt;">{{$data->getTotalIncome3C()}}</td>
            <td class="tg-s268 pleft" style="font-size: 10pt;">{{$data->getPensionFund3C()}}</td>
        </tr>
    </table>

    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <th class="table-header-black" colspan="4">D. BUTIR-BUTIR LAIN / OTHER PARTICULARS</th>
        </tr>
        <tr class="border_left border_right border_bottom">
            <td class="pleft3" width="2%" style="border-right-style: none;">
                1)
                <br>
                <br>
                <span style="color: #FFFFFF">A</span>
            </td>
            <td class="tg-s268" width="76%" style="border-left-style: none; border-right-style: none;">
                Jumlah wang yang ditahan oleh majikan dan akan dibayar kepada pekerja
                <br>
                Amount of money withheld by employer and due to employee
                <br>
                <br>
            </td>
            <td class="tg-s268" style="border-left-style: none; border-right-style: none;" width="20%">
                <div>
                    RM {{$data->getMoneyWithheldByEmployerD()}}
                </div>
                <div class="border_bottom" style="color: #FFFFFF">
                    &nbsp;
                </div>
            </td>
            <td class="tg-s268" width="2%" style="border-left-style: none;">

            </td>
        </tr>
        <tr class="border_left border_right border_bottom">
            <td class="pleft3" width="2%" style="border-right-style: none;">
                2)
                <br>
                <br>
                <span style="color: #FFFFFF">A</span>
            </td>
            <td class="tg-s268" width="76%" style="border-left-style: none; border-right-style: none;">
                Jumlah Potongan Cukai Bulanan yang dibayar ke LHDNM dalam tahun ini
                <br>
                Amount of Monthly Tax Deductions paid for the current year
                <br><br>
            </td>
            <td class="tg-s268" style="border-left-style: none; border-right-style: none;" width="20%">
                <div>
                    RM {{$data->getMonthlyTaxDeductionsD()}}
                </div>
                <div class="border_bottom" style="color: #FFFFFF">
                    &nbsp;
                </div>
            </td>
            <td class="tg-s268" width="2%" style="border-left-style: none;">

            </td>
        </tr>
        <tr class="border_left border_right border_bottom">
            <td class="pleft3" width="2%" style="border-right-style: none;">
                3)
                <br>
                <br>
                <span style="color: #FFFFFF">A</span>
            </td>
            <td class="tg-s268" width="76%" style="border-left-style: none; border-right-style: none;">
                Jumlah potongan zakat dalam tahun ini
                <br>
                Amount of zakat paid for the current year
                <br><br>
            </td>
            <td class="tg-s268" style="border-left-style: none; border-right-style: none;" width="20%">
                <div>
                    RM {{$data->getAmountOfZakatPaidD()}}
                </div>
                <div class="border_bottom" style="color: #FFFFFF">
                    &nbsp;
                </div>
            </td>
            <td class="tg-s268" width="2%" style="border-left-style: none;">

            </td>
        </tr>
        <tr class="border_left border_right border_bottom">
            <td class="pleft3" width="2%" style="border-right-style: none;">
                4)
                <br>
                <br>
                <span style="color: #FFFFFF">A</span>
            </td>
            <td class="tg-s268" width="76%" style="border-left-style: none; border-right-style: none;">
                Caruman pekerja kepada KWSP atau kumpulan wang yang diluluskan
                <br>
                Employee contributions to Employee Provident Fund or any approved fund
                <br><br>
            </td>
            <td class="tg-s268" style="border-left-style: none; border-right-style: none;" width="20%">
                <div>
                    RM  {{$data->getContributionsToEmployeeProvidentFundD()}}
                </div>
                <div class="border_bottom" style="color: #FFFFFF">
                    &nbsp;
                </div>
            </td>
            <td class="tg-s268" width="2%" style="border-left-style: none;">

            </td>
        </tr>
    </table>

    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <th class="table-header-black" colspan="3">E. AKUAN PEGAWAI YANG DIBERI KUASA / DECLARATION BY AUTHORISE OFFICER</th>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="tg-s268" style="padding-top: 15pt;padding-bottom: 15pt;padding-left: 13pt;border-right-style: none;" width="25%">Nama / Name :</td>
            <td class="tg-s268" width="70%" style="border-left-style: none;border-right-style: none;">
                <div class="table-border" style="height: 25pt;padding-left: 10pt;">
                    {{$data->getOfficerNameE()}}
                </div>
            </td>
            <td class="tg-s268" width="5%" style="border-left-style: none;"></td>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="tg-s268" style="padding-top: 15pt;padding-bottom: 15pt;padding-left: 13pt;border-right-style: none;">Jawatan / Designation:</td>
            <td class="tg-s268" style="border-left-style: none;border-right-style: none;">
                <div class="table-border" style="height: 25pt;padding-left: 10pt;">
                    {{$data->getOfficerDesignationE()}}
                </div>
            </td>
            <td class="tg-s268" style="border-left-style: none;"></td>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="tg-s268" style="padding-top: 15pt;padding-bottom: 50pt;padding-left: 13pt;border-right-style: none;">Tandatangan / Signature :</td>
            <td class="tg-s268" style="border-left-style: none;border-right-style: none;">
                <div class="table-border" style="height: 60pt;padding-left: 10pt;">
                    {{$data->getOfficerSignatureE()}}
                </div>
            </td>
            <td class="tg-s268" style="border-left-style: none;"></td>
        </tr>
        <tr class="border_bottom border_right border_left">
            <td class="tg-s268" style="padding-top: 15pt;padding-bottom: 15pt;padding-left: 13pt;border-right-style: none;">Tarikh / Date :</td>
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
