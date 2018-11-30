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

        .table-header-grey{
            background-color: #E5E5E5;
            color: #000000;
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

    <!-- page  -->
    @php
        $total_items = count($empData);
        $num_per_page = 15;
        $num_pages = ceil($total_items / $num_per_page);
        $count=0;
        $start=0;
        $end=$num_per_page;
        $cur_page=1;

        //total amount
        $totalAmount=0;
    @endphp

    @for($i=0; $i<$num_pages; $i++)
    @php
    if($i != 0){
        $start += $num_per_page;
    }

        //per page amount
        $pagePerAmount=0;
    @endphp

    @if($cur_page > 1)
        <div style="page-break-before:always">&nbsp;</div>
    @endif

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
            <th class="text_center">{{$data->getMonth()}} {{$data->getYear()}}</th>
            <td class="tg-s268"></td>
        </tr>
    </table>

    <table class="padded">
        <tr>
            <td class="tg-s268" width="10%">Majikan : </td>
            <td class="tg-s268" width="40%">{{$data->getCompanyName()}}</td>
            <td class="tg-0lax" width="30%"></td>
            <td class="tg-0lax">Lembaran:</td>
            <td class="tg-0lax">{{$cur_page}}</td>
            <td class="tg-0lax" width="2%"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268">{{$data->getAddress1()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">Tarikh :</td>
            <td class="tg-0lax">{{$data->getDate()}}</td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268">{{$data->getAddress2()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">{{$data->getAddress3()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax">Poskod : {{$data->getPostcode()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax">Kod Majikan :</td>
            <td class="tg-0lax">{{$data->getEmployerCode()}}</td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
    </table>

    <table class="padded" style="margin-top: 30pt;">
        <tr>
            <th class="table-border table-header-grey pleft">BIL. </th>
            <th class="table-border table-header-grey pleft">NOMBOR AKAUN</th>
            <th class="table-border table-header-grey pleft">NO. PEKERJA </th>
            <th class="table-border table-header-grey pleft">NO. KAD PENGENALAN </th>
            <th class="table-border table-header-grey pleft">NAMA PEKERJA</th>
            <th class="table-border table-header-grey text_right pright">CARUMAN (RM)</th>
            <th class="tg-0lax"></th>
        </tr>
        @foreach(array_slice($empData,$start,$end) as $emp )
            <tr>
                <td class="table-border pleft">{{$count+1}}</td>
                <td class="table-border pleft">{{$emp->getEmployeeNoAccount()}}</td>
                <td class="table-border pleft">{{$emp->getEmployeeNo()}}</td>
                <td class="table-border pleft">{{$emp->getEmployeeIcNo()}}</td>
                <td class="table-border pleft">{{$emp->getEmployeeName()}}</td>
                <td class="table-border text_right pright">{{$emp->getEmployeeContribution()}}</td>
                <td class="tg-0lax"></td>
            </tr>
        @php
            //sum of amount
            $pagePerAmount += $emp->getEmployeeContribution();

            $count++
        @endphp
        @endforeach

        @php
            //total amount of end page
            $totalAmount += $pagePerAmount;
        @endphp

        @if($cur_page == $num_pages)
            <tr>
                <th class="border_bottom border_left" colspan="4"></th>
                <th class="border_bottom border_right pleft">JUMLAH LEMBARAN INI</th>
                <th class="table-border text_right pright">{{number_format($pagePerAmount,2)}}</th>
                <td class="tg-0lax"></td>
            </tr>
            <tr>
                <th class="border_bottom border_left" colspan="4"></th>
                <th class="border_bottom border_right pleft">JUMLAH BESAR</th>
                <th class="table-border text_right pright">{{number_format($totalAmount,2)}}</th>
                <td class="tg-0lax"></td>
            </tr>
        @else
            <tr>
                <th class="border_bottom border_left" colspan="4"></th>
                <th class="border_bottom border_right pleft">JUMLAH LEMBARAN INI</th>
                <th class="table-border text_right pright">{{number_format($pagePerAmount,2)}}</th>
                <td class="tg-0lax"></td>
            </tr>
        @endif

    </table>

    @if($cur_page == $num_pages)
        <table class="padded" style="margin-top: 30pt;">
            <tr>
                <td class="pleft10">
                    Cek/Kiriman POS bernombor _____________________ sebanyak RM <u>{{number_format($totalAmount,2)}}</u> di lampirkan bersama.
                </td>
            </tr>
        </table>
    @endif
    <table class="padded" style="margin-top: 50pt;">
        <tr>
            <td class="pleft" width="20%">Tandatangan Majikan/Wakil : </td>
            <td class="border_bottom pleft" width="30%"></td>
            <td class="pleft" width="50%"></td>
        </tr>
        <tr>
            <td class="pleft" width="20%">Tarikh : </td>
            <td class="border_bottom pleft" width="30%">{{$data->getDate()}}</td>
            <td class="pleft" width="50%"></td>
        </tr>
    </table>
    @php($cur_page++)
    @endfor
</div>
</body>
</html>
