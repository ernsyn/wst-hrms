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

        .text_center
        {
            text-align: center;
        }
        .text_right{
            text-align: right;
            padding-right: 3pt;
        }
        td:empty:after{
            content: "\00a0";
        }

        .table-small{
            width: 200pt;
        }
    </style>
</head>
<body>
<div id="page-container">

    <table class="pf padded" style="margin-top: 10pt;">
        <tr>
            <td class="tg-s268" width="25%"></td>
            <td rowspan="2">
                <div style="padding-left: 3pt;">
                    <br>
                    <br>
                    <img style="display:block;width: 70pt;height: 65pt;" alt="" src="{{asset('img/report/lhdn_grey.png')}}"/>
                </div>
            </td>
            <td class="text_center" rowspan="2" width="50%" style="font-size: 11pt;">
                <b>CUKAI PENDAPATAN MALAYSIA</b>
                <br>PENYATA POTONGAN CUKAI OLEH MAJIKAN
                <br>[SEKSYEN 107 AKTA CUKAI PENDAPATAN 1967
                <br>KAEDAH CUKAI PENDAPATAN (POTONGAN DARIPADA SARAAN),1994]
                <br>
                <br>
                <br>
                <b>POTONGAN BAGI BULAN <u>{{$data->getMonth()}}</u> TAHUN <u>{{$data->getYear()}}</u></b>
            </td>
            <td class="text_right pright" width="25%">CP 39 Pin. 2015</td>
        </tr>
        <tr>
            <td class="border_bottom border_right border_left border_top pleft">KETUA PENGARAH HASIL DALAM NEGERI<br>LEMBAGA HASIL DALAM NEGERI
                <br>{{$data->getCompanyName()}} ({{$data->getCompanyRegistrationNo()}})
                <br>{{$data->getCompanyAddress1()}}
                <br>{{$data->getCompanyAddress2()}}
                <br>{{$data->getCompanyPostcode()}} {{$data->getCompanyAddress3()}}
            </td>
            <td class="border_bottom border_right border_left border_top pleft">
                <div style="text-align: center;">
                    <span>UNTUK KEGUNAAN PEJABAT</span>
                </div>
                <p>
                    No. Kelompok :
                </p>
                <p>
                    No. Resit :
                </p>
            </td>
        </tr>
    </table>


    <table class="pf table-border padded" style="margin-top: 20pt;">
        <tr>
            <th class="text_center border_bottom border_right" colspan="3" style="background: #E5E5E5;" width="35%">BUTIR-BUTIR MAJIKAN</th>
            <th class="text_center border_bottom border_right" colspan="3" style="background: #E5E5E5;" width="30%">BUTIR-BUTIR PEMBAYARAN </th>
            <th class="text_center border_bottom border_right" colspan="3" style="background: #E5E5E5;" width="35%">PEGAWAI YANG MENYEDIAKAN MAKLUMAT</th>
        </tr>
        <tr class="first">
            <td class="border_right" colspan="3"></td>
            <td class="border_bottom border_right pleft" rowspan="3" valign="bottom">Jumlah <br>Potongan</td>
            <td class="border_bottom border_right"><center>PCB</center></td>
            <td class="border_bottom border_right"><center>CP38</center></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft" style="border-top-style: none;">No. Majikan E</td>
            <td class="">:</td>
            <td class="border_right pleft">
                <div class="table-border " style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(0,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[0] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(1,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[1] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(2,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[2] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(3,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[3] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(4,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[4] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(5,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[5] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(6,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[6] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(7,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[7] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                   -
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt;">
                    <?php echo (array_key_exists(8,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[8] : "&nbsp;&nbsp;"; ?>
                </div>
                <div class="table-border" style="height: 12pt;float: left; padding-top: 1pt;padding-bottom: 1pt; padding-left: 5pt; padding-right: 5pt; border-left-style: none;">
                    <?php echo (array_key_exists(9,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[9] : "&nbsp;&nbsp;"; ?>
                </div>
            </td>
            <td class="border_right"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="border_right pleft" colspan="3">No. Pendaftaran </td>
            <td class="border_bottom border_right pleft">RM {{number_format($totalPcb,2)}}</td>
            <td class="border_bottom border_right pleft">RM {{number_format($totalcp38,2)}}</td>
            <td class="pleft">Tandatangan</td>
            <td class="tg-0lax">:</td>
            <td class="border_bottom">{{$data->getOfficerSignature()}}</td>
        </tr>
        <tr>
            <td class="pleft">Perniagaan</td>
            <td class="tg-0lax">:</td>
            <td class="border_bottom border_right pleft">{{$data->getCompanyRegistrationNo()}}</td>
            <td class="border_bottom border_right pleft" rowspan="2">Bilangan <br>Pekerja</td>
            <td class="border_right"></td>
            <td class="border_right"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="border_bottom border_right pleft">{{$data->getPcbTotalWorker()}}</td>
            <td class="border_bottom border_right pleft">{{$data->getCp38TotalWorker()}}</td>
            <td class="tg-0lax pleft">Nama Penuh</td>
            <td class="tg-0lax">:</td>
            <td class="border_bottom">{{$data->getOfficerName()}}</td>
        </tr>
        <tr>
            <td class="tg-0lax pleft">Nama Syarikat/</td>
            <td class="tg-0lax"></td>
            <td class="border_right"></td>
            <td class="border_bottom border_right pleft" rowspan="7">Butir-butir/
                <br>Cek/Bank/
                <br>Deraf/
                <br>Kiriman
                <br>Wang/
                <br>Wang Pos
            </td>
            <td class="border_bottom border_right pleft" rowspan="2">Amaun :</td>
            <td class="border_bottom border_right pleft" rowspan="2">RM {{number_format($totalAmountofPCBAndCP8,2)}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="pleft">Perniagaan</td>
            <td class="tg-0lax">:</td>
            <td class="border_bottom border_right">{{$data->getCompanyName()}}</td>
            <td class="pleft">No. Pengenalan</td>
            <td class="tg-0lax">:</td>
            <td class="border_bottom">{{$data->getOfficerIcNo()}}</td>
        </tr>
        <tr>
            <td class="pleft">Alamat</td>
            <td class="tg-0lax">:</td>
            <td class="border_bottom border_right">{{$data->getCompanyAddress1()}}</td>
            <td class="border_bottom border_right pleft" rowspan="2">Nombor :
                <br>Cawangan :
            </td>
            <td class="border_bottom border_right" rowspan="2"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_bottom border_right">{{$data->getCompanyAddress2()}}</td>
            <td class="tg-0lax pleft">Jawatan</td>
            <td class="tg-0lax">:</td>
            <td class="border_bottom">{{$data->getOfficerPosition()}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_bottom border_right">{{$data->getCompanyAddress3()}}</td>
            <td class="border_right pleft" rowspan="3" valign="top">Tarikh :</td>
            <td class="border_right pleft" rowspan="3" valign="top">{{$data->getPcbDate()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_bottom border_right">Poskod: {{$data->getCompanyPostcode()}}</td>
            <td class="pleft">No Telefon </td>
            <td class="tg-0lax">:</td>
            <td class="border_bottom">{{$data->getOfficerNoTel()}}</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="border_right" style="color: #FFFFFF">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax" style="color: #FFFFFF">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>
        </tr>
    </table>

    <!-- page 2 -->
    @php
        $total_items = count($empData);
        $num_per_page = 15;
        $num_pages = ceil($total_items / $num_per_page);
        $count=0;
        $start=0;
        $end=$num_per_page;
        $cur_page=1;

        //total amount
        $totalAmountPCB=0;
        $totalAmountCP8=0;
    @endphp

    @for($i=0; $i<$num_pages; $i++)
    @php
        if($i != 0){
            $start += $num_per_page;
        }

        //amount
        $amountPCB=0;
        $amountCP8=0;
    @endphp

    @if($cur_page > 1)
    <div style="page-break-before:always">&nbsp;</div>
    @endif

    <div style="margin-top: 15pt;">
        <div class="table-small" style="float: left">
            <table class="pf  padded">
                <tr>
                    <td class="tg-s268" width="90pt"> No. Majikan E :</td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(0,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[0] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(1,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[1] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(2,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[2] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(3,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[3] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(4,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[4] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(5,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[5] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(6,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[6] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(7,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[7] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="text_center">-</td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(8,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[8] : "&nbsp;&nbsp;"; ?>
                    </td>
                    <td class="border_top border_left border_right border_bottom text_center">
                        <?php echo (array_key_exists(9,$data->getEmployerNoEArr())) ? $data->getEmployerNoEArr()[9] : "&nbsp;&nbsp;"; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="text_right" style="flex-grow: 1;">
            Muka Surat : {{$cur_page}}
        </div>
    </div>

    <table class="pf padded" style="margin-top: 15pt;">
        <tr>
            <th class="border_right border_left border_top" style="background: #E5E5E5;"></th>
            <th class="text_center border_right border_top" style="background: #E5E5E5;">NO. CUKAI </th>
            <th class="text_center border_right border_top" style="background: #E5E5E5;">NAMA PENUH PEKERJA</th>
            <th class="border_right border_top" style="background: #E5E5E5;"></th>
            <th class="border_right border_top" style="background: #E5E5E5;"></th>
            <th class="text_center border_right border_top" style="background: #E5E5E5;">NO.</th>
            <th class="text_center border_right border_bottom border_top" colspan="2" style="background: #E5E5E5;">BAGI PEKERJA ASING</th>
            <th class="text_center border_right border_bottom border_top" colspan="2" style="background: #E5E5E5;">JUMLAH POTONGAN CUKAI</th>
        </tr>
        <tr>
            <th class="text_center border_bottom border_right border_left" style="background: #E5E5E5;">BIL</th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">PENDAPATAN</th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">(SEPERTI DI KAD PENGENALAN ATAU PASPORT)</th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">NO. K/P LAMA</th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">NO. K/P BARU </th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">PEKERJA </th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">NO. PASPORT</th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">NEGARA</th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">PCB(RM) </th>
            <th class="text_center border_bottom border_right" style="background: #E5E5E5;">CP38(RM)</th>
        </tr>
        @foreach(array_slice($empData,$start,$end) as $emp )
            <tr>
                <td class="text_right border_bottom border_right border_left">{{$count+1}}</td>
                <td class="pleft border_bottom border_right">{{$emp->getIncomeTaxNo()}}</td>
                <td class="pleft border_bottom border_right">{{$emp->getName()}}</td>
                <td class="pleft border_bottom border_right">{{$emp->getOldIcNo()}}</td>
                <td class="pleft border_bottom border_right">{{$emp->getNewIcNo()}}</td>
                <td class="pleft border_bottom border_right">{{$emp->getStaffNo()}}</td>
                <td class="pleft border_bottom border_right">{{$emp->getForeignerPassportNo()}}</td>
                <td class="pleft border_bottom border_right">{{$emp->getForeignerCountry()}}</td>
                <td class="text_right border_bottom border_right">{{number_format($emp->getPcbAmount(),2)}}</td>
                <td class="text_right border_bottom border_right">{{number_format($emp->getCp38Amount(),2)}}</td>
            </tr>
        @php
            //sum of amount
            $amountPCB += $emp->getPcbAmount();
            $amountCP8 += $emp->getCp38Amount();

            $count++
        @endphp
        @endforeach

        @php
            //total amount of end page
            $totalAmountPCB += $amountPCB;
            $totalAmountCP8 += $amountCP8;
        @endphp

        @if($cur_page == $num_pages)
            <tr>
                <td class="text_right" colspan="8">JUMLAH </td>
                <td class="text_right border_left border_bottom border_right">{{number_format($amountPCB,2)}}</td>
                <td class="text_right border_left border_bottom border_right">{{number_format($amountCP8,2)}}</td>
            </tr>
            <tr>
                <td class="text_right" colspan="8">JUMLAH BESAR</td>
                <td class="text_right border_left border_bottom border_right">{{number_format($totalAmountPCB,2)}}</td>
                <td class="text_right border_left border_bottom border_right">{{number_format($totalAmountCP8,2)}}</td>
            </tr>
        @else
            <tr>
                <td class="text_right" colspan="8">JUMLAH </td>
                <td class="text_right border_left border_bottom border_right">{{number_format($amountPCB,2)}}</td>
                <td class="text_right border_left border_bottom border_right">{{number_format($amountCP8,2)}}</td>
            </tr>
            <tr>
                <td class="text_right" colspan="8">JUMLAH YANG DIBAWA KE LEMBARAN HADAPAN</td>
                <td class="text_right border_left border_bottom border_right">{{number_format($totalAmountPCB,2)}}</td>
                <td class="text_right border_left border_bottom border_right">{{number_format($totalAmountCP8,2)}}</td>
            </tr>
        @endif
    </table>
    @php($cur_page++)
    @endfor

</div>
</body>
</html>
