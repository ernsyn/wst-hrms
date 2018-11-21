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

    @foreach($dataArr as $data )
    <!-- next page -->
    <div style="page-break-before:always">&nbsp;</div>

    <table class="pf padded" style="margin-top: 0pt;">
        <tr>
            <th class="tg-s268" rowspan="7" width="15%">
                <div class="text_center" style="padding-left: 3pt;">
                    <img style="width: 65pt;height: 65pt;" alt="" src="{{asset('img/report/lhdn_grey.png')}}"/>
                </div>
            </th>
            <th class="blank_row" width="70%"></th>
            <th class="tg-s268" width="15%"></th>
        </tr>
        <tr>
            <td class="tg-s268" rowspan="6">
                <div class="text_center" style="font-size: 13pt;font-weight: bold">LEMBAGA HASIL DALAM NEGERI MALAYSIA
                    <br>PEMBERITAHUAN PEKERJA BARU
                    </div>
                <div class="text_center" style="margin-top: 5pt;">
                    [SUBSEKSYEN 83(2) AKTA CUKAI PENDAPATAN 1967]
                </div>

            </td>
            <td class="tg-s268">
                <div class="text_left" style="font-size: 10pt;">CP22 [Pin 1/2011]</div>
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

    <table class="pf padded" style="margin-top: 15pt;">
        <tr>
            <td class="tg-s268" width="49%">Kepada :-</td>
            <td class="tg-s268" rowspan="8" width="2%"></td>
            <td class="tg-s268">No. Majikan E :</td>
            <td class="border_bottom">{{$data->getCompanyNoE()}}</td>
        </tr>
        <tr>
            <td class="tg-s268">Lembaga Hasil Dalam Negeri Malaysia </td>
            <td class="tg-s268">No.Telefon Majikan :</td>
            <td class="border_bottom">{{$data->getCompanyNoTel()}}</td>
        </tr>
        <tr>
            <td class="border_bottom">{{$data->getCompanyName()}}</td>
            <td class="tg-s268">Daripada :-</td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="border_bottom">{{$data->getAddressTo1()}}</td>
            <td class="border_bottom" colspan="2">{{$data->getCompanyName()}}</td>
        </tr>
        <tr>
            <td class="border_bottom">{{$data->getAddressTo2()}}</td>
            <td class="border_bottom" colspan="2">{{$data->getAddressFrom1()}}</td>
        </tr>
        <tr>
            <td class="border_bottom">{{$data->getPostcodeTo()}} ,{{$data->getAddressTo3()}}</td>
            <td class="border_bottom" colspan="2">{{$data->getAddressFrom2()}}</td>
        </tr>
        <tr>
            <td class="border_bottom"></td>
            <td class="border_bottom" colspan="2">{{$data->getAddressFrom3()}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"> Poskod :</td>
            <td class="border_bottom">{{$data->getPostcodeFrom()}}</td>
        </tr>
    </table>

    <table class="pf padded " style="margin-top: 15pt;">
        <tr>
            <td class="table-header-grey pleft border_bottom border_top" colspan="19">
                BUTIR-BUTIR PEKERJA BARU
            </td>
        </tr>
    </table>
    <table class="padded">
        <tr>
            <td class="blank_row" colspan="5"></td>
        </tr>
        <tr>
            <td class="tg-s268" colspan="2" width="50%">Nama Penuh </td>
            <td class="tg-s268" rowspan="21" width="2%"></td>
            <td class="tg-s268" colspan="2">No. Cukai Pendapatan</td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2">{{$data->getNameA()}}</td>
            <td class="border_bottom pleft" colspan="2">{{$data->getIncomeTaxNoA()}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class=""></td>
            <td class="tg-s268" colspan="2"></td>
        </tr>
        <tr>
            <td class="tg-s268" colspan="2">
                <div class="d-table">
                    <div class="d-row">
                        <div class="d-cell-1">Jenis Pekerjaan :</div>
                        <div class="d-cell-1 border_bottom" style="font-size: 10pt;">{{$data->getJobRoleA()}}</div>
                    </div>
                </div>
            </td>
            <td class="tg-s268" colspan="2">No. Kad Pengenalan/Polis/Tentera/Pasport</td>
        </tr>
        <tr>
            <td class="tg-s268">Tarikh Permulaan Pekerjaan Sekarang</td>
            <td class="border_bottom pleft5">{{$data->getEmploymentStartDateA()}}</td>
            <td class="border_bottom pleft" colspan="2">{{$data->getNoIcA()}}</td>
        </tr>
        <tr>
            <td class="tg-s268">Tempoh Pekerjaan Yang Dijangkakan</td>
            <td class="border_bottom pleft5">{{$data->getEmploymentExpectedDateA()}}</td>
            <td class="tg-s268" colspan="2">No. Imigresen</td>
        </tr>
        <tr>
            <td class="tg-s268" colspan="2">Alamat Kediaman Sekarang</td>
            <td class="border_bottom pleft" colspan="2">{{$data->getImmigrationNoA()}}</td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2">{{$data->getAddress1A()}}</td>
            <td class="tg-0lax">Tarikh Lahir</td>
            <td class="tg-0lax">Taraf Perkahwinan</td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2">{{$data->getAddress2A()}}&nbsp;{{$data->getAddress3A()}}</td>
            <td class="pleft" colspan="2">
                <div class="d-table">
                    <div class="d-row">
                        <div class="d-cell border_bottom" style="width: 30%;">{{$data->getBirthDateA()}}</div>
                        <div class="d-cell" style="width: 4%"></div>
                        <div class="d-cell border_bottom">{{$data->getMaritalStatusA()}}</div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2"></td>
            <td class="tg-0lax" colspan="2">
                <div class="d-table">
                    <div class="d-row">
                        <div class="d-cell-1">Bilangan anak-anak di bawah 18 tahun</div>
                        <div class="d-cell-1 border_bottom" style="width: 25%;">{{$data->getChildrenUnder18NoA()}}</div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2">Poskod : {{$data->getPostcodeA()}}</td>
            <td class="tg-0lax" colspan="2"></td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="2"></td>
            <td class="tg-0lax" colspan="2">Jika berkahwin, nyatakan</td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="2"></td>
            <td class="tg-0lax" colspan="2">(a) Nama Penuh Suami/Isteri:</td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="2">Alamat Surat-Menyurat Sekarang</td>
            <td class="border_bottom pleft15" colspan="2">{{$data->getSpouseNameA()}}</td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2">{{$data->getAddressNow1A()}}</td>
            <td class="tg-0lax" colspan="2">(b) No. Kad Pengenalan/Polis/Tentera/Pasport Suami/Isteri*</td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2">{{$data->getAddressNow2A()}}</td>
            <td class="border_bottom pleft15" colspan="2">{{$data->getSpouseICA()}}</td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2">{{$data->getAddressNow3A()}}</td>
            <td class="tg-0lax" colspan="2">(c) No. Cukai Pendapatan Suami/Isteri*</td>
        </tr>
        <tr>
            <td class="border_bottom pleft" colspan="2"></td>
            <td class="border_bottom pleft15" colspan="2">{{$data->getSpouseIncomeTaxA()}}</td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="2"></td>
            <td class="tg-0lax" colspan="2"></td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="2">
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 10pt; padding-right: 10pt; color: #FFFFFF">
                    &nbsp;{{$data->getSignXA()}}
                </div>
                <div class="" style="height: 12pt;float: left; margin-left: 10pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; font-size: 10pt;">
                    Tandakan "X" jika alamat surat-menyurat
                </div>
            </td>
            <td class="tg-0lax" colspan="2">Note* Bagi warganegara Malaysia yang mempunyai Mykad</td>
        </tr>
        <tr>
            <td class="tg-0lax" colspan="2">
                <div class="" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 10pt; padding-right: 10pt;color: #FFFFFF">
                    X
                </div>
                <div class="" style="height: 12pt;float: left; margin-left: 10pt; padding-top: 1pt;padding-bottom: 1pt; padding-left: 3pt; padding-right: 3pt; font-size: 10pt;">
                    di atas adalah alamat ejen cukai
                </div>
            </td>
            <td class="tg-0lax pleft15" colspan="2">hanya No. Mykad sahaja perlu diisi</td>
        </tr>
    </table>

    <table class="pf padded " style="margin-top: 15pt;">
        <tr>
            <td class="table-header-grey pleft border_bottom border_top" colspan="19">
                TERMA-TERMA PENGGAJIAN
            </td>
        </tr>
    </table>

    <table class="padded">
        <tr class="blank_row">
            <th class="tg-s268"></th>
            <th class="tg-s268"></th>
            <th class="tg-s268"></th>
        </tr>
        <tr>
            <td class="pleft" width="2%">(a) </td>
            <td class="tg-s268" width="40%">Kadar Saraan Tetap Sebulan</td>
            <td class="tg-s268">
                 <div class=" border_bottom" style="width: 20%;">RM {{$data->getFixedMontlyRemunerationRateB()}}</div>
            </td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft">(b)</td>
            <td class="tg-s268" colspan="2">Kadar elaun tunai seperti cukai ditanggung oleh majikan, elaun sara hidup atau elaun tetap yang lain dan kadar elaun</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268" colspan="2">berupa barangan seperti rumah kediaman, pakaian, dsb</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2">{{$data->getRateCashAllowanceB()}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="pleft" width="3%">(c)</td>
            <td class="tg-s268" colspan="2">Emolumen tidak tetap yang beliau berhak (nyatakan perihalnya) dan tarikh jumlah bayaran akan diketahui</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2">{{$data->getEmolumentNotFixedB()}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2"></td>
        </tr>
        <tr>
            <td class="tg-s268" colspan="3"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268" colspan="2">Nama dan Alamat majikan yang dahulu di Malaysia</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2">{{$data->getEmployerNameB()}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2">{{$data->getEmployerAddress1B()}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2">{{$data->getEmployerAddress2B()}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="border_bottom pleft" colspan="2">{{$data->getEmployerAddress3B()}}</td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 40pt;">
        <tr>
            <td class="tg-s268" width="30%">Tandatangan Majikan<span style="float: right">:</span></td>
            <td class="border_bottom pleft" width="40%"></td>
            <td class="tg-s268" width="30%"></td>
        </tr>
        <tr>
            <td class="tg-s268">Nama<span style="float: right">:</span></td>
            <td class="border_bottom pleft">{{$data->getOfficerNameC()}}</td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268">Jawatan<span style="float: right">:</span></td>
            <td class="border_bottom pleft">{{$data->getOfficerRoleC()}}</td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268">Tarikh<span style="float: right">:</span></td>
            <td class="border_bottom pleft">{{$data->getDateC()}}</td>
            <td class="tg-s268"></td>
        </tr>
    </table>
    @endforeach
</div>
</body>
</html>
