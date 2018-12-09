<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title></title>
    <style>
/*               table, td, th {
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
        .padded td.pleft15 { padding-left:15pt; }

       .padded th.pleft { padding-left:3pt; }
       .padded th.pleft3 { padding-left:3pt; }
       .padded th.pleft5 { padding-left:5pt; }
       .padded th.pleft10 { padding-left:10pt; }
       .padded th.pleft15 { padding-left:15pt; }

        .blank_row
        {
            height: 10pt !important; /* overwrites any other rules */
            background-color: #FFFFFF;
        }

        body {
            font-size: 10pt;
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

        .small_font{
            font-size: 10pt;
        }

        .pheight td {
            height: 15pt;
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
            <td class="tg-s268 small_font" colspan="2" width="25%">(C.P. 8A - Pin. 2017)</td>
            <td class="tg-s268 text_center small_font" width="50%">MALAYSIA</td>
            <td class="tg-s268 small_font" style="background: black; color: white;" colspan="2" width="22%">Penyata Gaji Pekerja SWASTA</td>
            <th class="tg-s268 text_right" rowspan="2" style="font-size: 20pt;" width="3%" valign="top" >EA</th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <th class="tg-s268 text_center" rowspan="2" style="font-size: 16pt;">CUKAI PENDAPATAN </th>
            <td class="tg-s268 small_font" colspan="2">No. Cukai Pendapatan Pekerja</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268" colspan="3"></td>
        </tr>
        <tr>
            <td class="tg-s268">No. Siri </td>
            <td class="tg-s268 border_bottom">{{$data->getSerialNo()}}</td>
            <td class="tg-s268 text_center">PENYATA SARAAN DARIPADA PENGGAJIAN</td>
            <td class="tg-s268 border_bottom" colspan="3">{{$data->getIncomeTaxNo()}}</td>
        </tr>
        <tr>
            <td class="tg-s268">No. Majikan E</td>
            <td class="tg-s268 border_bottom">{{$data->getEmployerNoE()}}</td>
            <td class="tg-s268 text_center">BAGI TAHUN BERAKHIR 31 DISEMBER <u>{{$data->getYear()}}</u></td>
            <td class="tg-s268">Cawangan LHDNM</td>
            <td class="tg-s268 border_bottom" width="10%" colspan="2"></td>
        </tr>
    </table>

    <table class="padded pheight" style="margin-top: 5pt;">
        <tr>
            <th class="table-header-black text_center">
                BORANG EA INI PERLU DISEDIAKAN UNTUK DISERAHKAN KEPADA PEKERJA BAGI TUJUAN CUKAI PENDAPATAN
            </th>
        </tr>
    </table>

    <table class="padded pheight" style="margin-top: 2pt;">
        <tr>
            <td class="tg-s268 text_center" style="background: black;color: white" width="2%">A</td>
            <th class="tg-s268 pleft" colspan="8">BUTIRAN PEKERJA</th>
        </tr>
        <tr>
            <td class="tg-s268" width="2%"></td>
            <td class="tg-s268" width="1%">1.</td>
            <td class="tg-s268 pleft" colspan="2" width="32%">Nama Penuh Pekerja/Pesara (En./Cik/Puan)</td>
            <td class="tg-s268 border_bottom" colspan="6">{{$data->getName()}}</td>
        </tr>
    </table>

    <table class="padded pheight">
        <tr>
            <td class="tg-s268" width="2%"></td>
            <td class="tg-s268" width="1%">2.</td>
            <td class="tg-s268 pleft" width="13%">Jawatan</td>
            <td class="tg-s268 border_bottom" colspan="2" width="35%" style="font-size: 10pt;">{{$data->getJobPosition()}}</td>
            <td class="tg-0lax" width="3%"></td>
            <td class="tg-0lax" width="1%">3.</td>
            <td class="tg-0lax pleft" width="20%">No. Kakitangan/No. Gaji</td>
            <td class="tg-0lax border_bottom">{{$data->getSalaryNo()}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268">4.</td>
            <td class="tg-s268 pleft">No. K.P. Baru</td>
            <td class="tg-s268 border_bottom" colspan="2">{{$data->getIcNo()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">5.</td>
            <td class="tg-0lax pleft">No. Pasport</td>
            <td class="tg-0lax border_bottom">{{$data->getPassportNo()}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268">6.</td>
            <td class="tg-s268 pleft">No. KWSP</td>
            <td class="tg-s268 border_bottom" colspan="2">{{$data->getKwspNo()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">7.</td>
            <td class="tg-0lax pleft">No. PERKESO</td>
            <td class="tg-0lax border_bottom">{{$data->getPerkesoNo()}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">8.</td>
            <td class="tg-0lax pleft" colspan="3">Bilangan Anak Yang Layak</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">9.</td>
            <td class="tg-0lax pleft" colspan="2">Jika bekerja tidak genap setahun, nyatakan:</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft15" colspan="2" width="20%">Untuk Pelepasan Cukai</td>
            <td class="tg-0lax border_bottom" width="28%">{{$data->getChildNoforTax()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft10">(a) Tarikh mula bekerja</td>
            <td class="tg-0lax border_bottom">{{$data->getStartDateLessOneYear()}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft10">(b) Tarikh berhenti kerja</td>
            <td class="tg-0lax border_bottom">{{$data->getEndDateLessOneYear()}}</td>
        </tr>
    </table>

    <table class="padded pheight" style="margin-top: 10pt;">
        <tr>
            <td class="tg-s268 text_center" style="background: black;color: white" width="2%">B</td>
            <th class="tg-s268 pleft" colspan="8">PENDAPATAN PENGGAJIAN, MANFAAT DAN TEMPAT KEDIAMAN</th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft" colspan="2" style="font-size: 10pt;">(Tidak Termasuk Elaun/Perkuisit/Pemberian/Manfaat Yang Dikecualikan Cukai) </td>

            <th class="tg-s268 text_center" width="10%">RM</th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268" width="1%">1.</td>
            <td class="tg-s268 pleft5">(a) Gaji kasar, upah atau gaji cuti (termasuk gaji lebih masa)</td>
            <td class="tg-0lax text_right border_bottom">{{number_format($data->getNetSalary(),2)}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft5">(b) Fi (termasuk fi pengarah), komisen atau bonus</td>
            <td class="tg-0lax text_right border_bottom">{{number_format($data->getCommission(),2)}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft5">(c) Tip kasar, perkuisit, penerimaan sagu hati atau elaun-elaun lain (Perihal pembayaran: ...........................)</td>
            <td class="tg-0lax text_right border_bottom">{{number_format($data->getTip(),2)}}</td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft5">(d) Cukai Pendapatan yang dibayar oleh Majikan bagi pihak Pekerja</td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft5">(e) Manfaat Skim Opsyen Saham Pekerja (ESOS)</td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft5">(f) Ganjaran bagi tempoh dari ....................................... hingga .......................................</td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">2.</td>
            <td class="tg-0lax pleft5">Butiran bayaran tunggakan dan lain-lain bagi tahun-tahun terdahulu dalam tahun semasa</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft5">
                Jenis pendapatan
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                (a) .....................................................................</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft5">
                <span style="color: white;">Jenis pendapatan</span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                (b) .....................................................................
            </td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">3.</td>
            <td class="tg-0lax pleft5">Manfaat berupa barangan (Nyatakan: .......................................................................................................)</td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">4.</td>
            <td class="tg-0lax pleft5">Nilai tempat kediaman (Alamat: ................................................................................................................)</td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">5.</td>
            <td class="tg-0lax pleft5">Bayaran balik daripada Kumpulan Wang Simpanan/Pencen yang tidak diluluskan</td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">6.</td>
            <td class="tg-0lax pleft5">Pampasan kerana kehilangan pekerjaan</td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
    </table>

    <table class="padded pheight" style="margin-top: 10pt;">
        <tr>
            <td class="tg-s268 text_center" style="background: black;color: white" width="2%">C</td>
            <th class="tg-s268 pleft" colspan="8">PENCEN DAN LAIN-LAIN</th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268" width="1%">1.</td>
            <td class="tg-s268 pleft5">Pencen</td>
            <td class="tg-0lax text_right border_bottom" width="10%"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">2.</td>
            <td class="tg-0lax pleft5">Anuiti atau Bayaran Berkala yang lain</td>
            <td class="tg-0lax text_right border_bottom"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <th class="tg-0lax" colspan="2">JUMLAH</th>
            <td class="tg-0lax text_right border_bottom" style="border-top-style: double;">{{number_format($data->getTotal(),2)}}</td>
        </tr>
    </table>

    <table class="padded pheight" style="margin-top: 10pt;">
        <tr>
            <td class="tg-s268 text_center" style="background: black;color: white" width="2%">D</td>
            <th class="tg-s268 pleft" colspan="8">JUMLAH POTONGAN</th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268" width="1%">1.</td>
            <td class="tg-s268 pleft5">Potongan Cukai Bulanan (PCB) yang dibayar kepada LHDNM</td>
            <td class="tg-0lax text_right border_bottom" width="10%">{{number_format($data->getPcb(),2)}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">2.</td>
            <td class="tg-0lax pleft5">Arahan Potongan CP 38</td>
            <td class="tg-0lax text_right border_bottom">{{number_format($data->getDeductionsInstructionsCP38(),2)}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">3.</td>
            <td class="tg-0lax pleft5">Zakat yang dibayar melalui potongan gaji</td>
            <td class="tg-0lax text_right border_bottom">{{number_format($data->getZakatPaidThroughSalaryDeductions(),2)}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">4.</td>
            <td class="tg-0lax pleft5">Jumlah tuntutan potongan oleh pekerja melalui Borang TP1 berkaitan:</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft5">
                (a) Pelepasan
                <span style="color: white;">Jumlah tuntutan potongan oleh pekerja melalui Borang</span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                RM ...................................
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft5">
                (b) Zakat selain yang dibayar melalui potongan gaji bulanan
                <span style="color: white;">berkaitan:</span>
                &nbsp;&nbsp;&nbsp;&nbsp;
                RM ...................................
            </td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">5.</td>
            <td class="tg-0lax pleft5">Jumlah pelepasan bagi anak yang layak</td>
            <td class="tg-0lax text_right border_bottom">{{number_format($data->getTotalDisbursementForEligibleChildren(),2)}}</td>
        </tr>
    </table>

    <table class="padded pheight" style="margin-top: 10pt;">
        <tr>
            <td class="tg-s268 text_center" style="background: black;color: white" width="2%">E</td>
            <th class="tg-s268 pleft" colspan="8">CARUMAN YANG DIBAYAR OLEH PEKERJA KEPADA KUMPULAN WANG SIMPANAN/PENCEN YANG DILULUSKAN DAN PERKESO</th>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268" width="1%">1.</td>
            <td class="tg-s268 pleft5">Nama Kumpulan Wang</td>
            <td class="tg-s268 border_bottom" colspan="3" width="70%">{{$data->getNameOfFund()}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax pleft5" colspan="2">Amaun caruman yang wajib dibayar (nyatakan bahagian pekerja sahaja)</td>
            <td class="tg-0lax" width="2%">RM</td>
            <td class="tg-0lax text_right border_bottom" width="10%">{{number_format($data->getAmountOfContribution(),2)}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">2.</td>
            <td class="tg-0lax pleft5" colspan="2">PERKESO : Amaun caruman yang wajib dibayar (nyatakan bahagian pekerja sahaja)</td>
            <td class="tg-0lax" width="2%">RM</td>
            <td class="tg-0lax text_right border_bottom" width="10%">{{number_format($data->getAmountOfContributionPerkeso(),2)}}</td>
        </tr>
    </table>

    <table class="padded pheight" style="margin-top: 10pt;">
        <tr>
            <td class="tg-s268 text_center" style="background: black;color: white" width="2%">F</td>
            <th class="tg-s268 pleft" colspan="6">JUMLAH ELAUN / PERKUISIT / PEMBERIAN / MANFAAT YANG DIKECUALIKAN CUKAI</th>
            <td class="tg-0lax" width="2%">RM</td>
            <td class="tg-0lax text_right border_bottom" width="10%">{{number_format($data->getTotalAllowance(),2)}}</td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 10pt;">
        <tr style="height: 5pt;">
            <td class="tg-s268 "></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 border_left border_top border_right" colspan="4"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft15 border_left" width="20%">Nama Pegawai</td>
            <td class="tg-s268" width="5%"></td>
            <td class="tg-s268 border_bottom" width="40%">{{$data->getOfficerName()}}</td>
            <td class="tg-s268 border_right" width="1%"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft15 border_left">Jawatan</td>
            <td class="tg-s268"></td>
            <td class="tg-s268 border_bottom">{{$data->getOfficerPosition()}}</td>
            <td class="tg-s268 border_right" width="1%"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft15 border_left">Nama dan Alamat Majikan</td>
            <td class="tg-s268"></td>
            <td class="tg-s268 border_bottom">
                {{$data->getCompanyName()}}
                <br>
                {{$data->getCompanyAddress1()}}
            </td>
            <td class="tg-s268 border_right" width="1%"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 border_left"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 border_bottom">
                {{$data->getCompanyAddress2()}}
                <br>
                {{$data->getCompanyAddress3()}} Poskod {{$data->getCompanyPostcode()}}
            </td>
            <td class="tg-s268 border_right" width="1%"></td>
        </tr>
        <tr>
            <td class="tg-s268">Tarikh </td>
            <td class="tg-s268 border_bottom">{{$data->getDate()}}</td>
            <td class="tg-s268"></td>
            <td class="tg-s268 pleft15 border_left">No. Telefon Majikan</td>
            <td class="tg-s268"></td>
            <td class="tg-s268 border_bottom">{{$data->getCompanyNoTel()}}</td>
            <td class="tg-s268 border_right" width="1%"></td>
        </tr>
        <tr style="height: 5pt;">
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268 border_left border_bottom border_right" colspan="4"></td>
        </tr>
    </table>
    @endforeach
</div>
</body>
</html>
