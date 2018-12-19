<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="page-container">

    <table>
        <tr>
            <td class="tg-s268" colspan="2" rowspan="6">
            </td>
            <td class="tg-s268">PERTUBUHAN KESELAMATAN SOSIAL</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268">LAMPIRAN 1</td>
        </tr>
        <tr>
            <td class="tg-s268">JADUAL CARUMAN BAGI SISTEM INSURANS PEKERJAAN (SIP)</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268">NAMA MAJIKAN</td>
            <td class="tg-s268">{{$data->getCompanyName()}}</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268">KOD MAJIKAN</td>
            <td class="tg-s268">{{$data->getCompanyNoCode()}}</td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="background-color: #9BC2E6;"><b>Bil</b></td>
            <td style="background-color: #9BC2E6;">Kod Majikan</td>
            <td style="background-color: #9BC2E6;">No. Kad Pengenalan</td>
            <td style="background-color: #9BC2E6;">Nama Pekerja</td>
            <td style="background-color: #9BC2E6;">Bulan Carum</td>
            <td style="background-color: #9BC2E6;">Jumlah Caruman</td>
        </tr>
        @php
            $count=0;
        @endphp

        @foreach($dataArr as $obj )
        <tr>
            <td class="tg-s268">{{$count+1}}</td>
            <td class="tg-s268">{{$obj->getCompanyNoCode()}}</td>
            <td class="tg-s268">{{$obj->getEmployeeIcNo()}}</td>
            <td class="tg-s268">{{$obj->getEmployeeName()}}</td>
            <td class="tg-s268">{{$obj->getContributionMonth()}}</td>
            <td class="tg-s268">{{$obj->getContributionAmount()}}</td>
        </tr>
        @endforeach
        <tr>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268"></td>
            <td class="tg-s268">JUMLAH CARUMAN (RM)</td>
            <td class="tg-s268">{{$totalContributionAmount}}</td>
        </tr>
    </table>
</div>
</body>
</html>
