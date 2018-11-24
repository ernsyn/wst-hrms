<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" href="{{public_path('css/report/soscoLampiranA/base.min.css')}}"/>
    <link rel="stylesheet" href="{{public_path('css/report/soscoLampiranA/main.css')}}"/>
    <style type="text/css">
        .border_bottom_span {
            border-bottom: 4px solid black;
        }
    </style>
    <title></title>
</head>
<body>
<div id="page-container">
    <div id="pf1" class="pf w0 h0">
        <div class="pc pc1 w0 h0">
            <img class="bi x0 y0 w1 h1" alt="" src="{{public_path('img/report/soscoLampiranA.gif')}}"/>
            <div class="t m0 x1 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0">LAMPIRAN A</div>
            <div class="t m0 x2 h3 y2 ff2 fs0 fc0 sc0 ls0 ws0"><b>PERTUBUHAN KESELAMATAN SOSIAL</b></div>
            <div class="t m0 x3 h4 y3 ff1 fs1 fc0 sc0 ls1 ws0">BORANG BAYARAN CARUMAN BULANAN/TUNGGAKAN  CARUMAN/KEKURANGAN</div>
            <div class="t m0 x3 h4 y4 ff1 fs1 fc0 sc0 ls2 ws0">CARUMAN MENGGUNAKAN PITA/DISKET UNTUK  BULAN <span class="_ _0"></span><span class="ls3"> <span class="border_bottom_span">{{$data->getFromMonth()}}  {{$data->getYear()}}</span><span class="_ _0"></span><span class="ls4">  HINGGA  <span class="_ _0"></span></span><span class="border_bottom_span">{{$data->getToMonth()}}  {{$data->getYear()}}</span></span></div>
            <div class="t m0 x3 h2 y5 ff1 fs0 fc0 sc0 ls0 ws0">Tarikh Butiran Caruman Dihantar : {{$data->getDate()}}</div>
            <div class="t m0 x3 h2 y6 ff1 fs0 fc0 sc0 ls0 ws0">(Melalui Sistem Penghantaran Pita/Disket)</div>
            <div class="t m0 x3 h2 y7 ff1 fs0 fc0 sc0 ls0 ws0">Bilangan Pekerja : {{$data->getEmployeeTotalNumber()}}</div>
            <div class="t m0 x4 h2 y8 ff1 fs0 fc0 sc0 ls0 ws0"> Cek/Kiriman Wang/Wang Pos/Draf Bank<span class="_ _1"> </span> Amaun</div>
            <div class="t m0 x4 h3 y9 ff1 fs0 fc0 sc0 ls0 ws0"> No : <span class="ff2">{{$data->getNoCheck()}}</span> <span>disertakan</span> <span class="_ _2"> </span><span class="ff2"><b> RM  {{number_format($data->getAmount(),2)}}</b></span></div>
            <div class="t m0 x5 h2 ya ff1 fs0 fc0 sc0 ls0 ws0"> Kod Majikan<span class="_ _3"> </span>:<span class="_ _4"></span>{{$data->getEmployerCode()}}</div>
            <div class="t m0 x5 h2 yb ff1 fs0 fc0 sc0 ls0 ws0"> Nama Majikan<span class="_ _5"> </span>:<span class="_ _4"></span>{{$data->getCompanyName()}}  {{$data->getCompanyRegistrationNo()}}</div>
            <div class="t m0 x5 h2 yc ff1 fs0 fc0 sc0 ls0 ws0"> Alamat<span class="_ _6"> </span>:<span class="_ _4"></span>{{$data->getAddress1()}}</div>
            <div class="t m0 x6 h2 yd ff1 fs0 fc0 sc0 ls0 ws0">:<span class="_ _4"></span>{{$data->getAddress2()}}</div>
            <div class="t m0 x6 h2 ye ff1 fs0 fc0 sc0 ls0 ws0">:<span class="_ _4"></span>{{$data->getAddress3()}} Poskod: {{$data->getPostcode()}}</div>
            <div class="t m0 x4 h2 yf ff1 fs0 fc0 sc0 ls0 ws0"> Tandatangan <span class="_ _5"> </span>: </div>
            <div class="t m0 x4 h2 y10 ff1 fs0 fc0 sc0 ls0 ws0"> Nama Penuh <span class="_ _3"> </span>: <span class="_ _7"></span>{{$data->getOfficerName()}}</div>
            <div class="t m0 x4 h2 y11 ff1 fs0 fc0 sc0 ls0 ws0"> Telefon <span class="_ _8"> </span>: <span class="_ _7"></span>{{$data->getOfficerTelNo()}}</div>
            <div class="t m0 x4 h2 y12 ff1 fs0 fc0 sc0 ls0 ws0">AKUAN PENERIMAAN<span class="_ _9"> </span>(DIISI OLEH PERKESO)</div>
            <div class="t m0 x4 h2 y13 ff1 fs0 fc0 sc0 ls0 ws0">Adalah diakui bahawa caruman yang dibayar menggunakan pita/disket berkenaan </div>
            <div class="t m0 x4 h2 y14 ff1 fs0 fc0 sc0 ls0 ws0">telah diterima.</div><div class="t m0 x3 h2 y15 ff1 fs0 fc0 sc0 ls0 ws0">Nama Majikan<span class="_ _3"> </span>:</div>
            <div class="t m0 x3 h2 y16 ff1 fs0 fc0 sc0 ls0 ws0">Kod Majikan<span class="_ _a"> </span>:</div>
            <div class="t m0 x3 h2 y17 ff1 fs0 fc0 sc0 ls0 ws0">No Cek/Kiriman</div>
            <div class="t m0 x3 h2 y18 ff1 fs0 fc0 sc0 ls0 ws0">Wang/Wang</div>
            <div class="t m0 x3 h2 y19 ff1 fs0 fc0 sc0 ls0 ws0">Pos/Draf Bank<span class="_ _5"> </span>:<span class="_ _b"> </span>Bulan Caruman<span class="_ _5"> </span>:</div>
            <div class="t m0 x3 h2 y1a ff1 fs0 fc0 sc0 ls0 ws0">Amaun<span class="_ _c"> </span>:<span class="_ _4"></span>RM<span class="_ _d"> </span>Tarikh Terima<span class="_ _5"> </span>:</div>
            <div class="t m0 x7 h2 y1b ff1 fs0 fc0 sc0 ls0 ws0">Tandatangan Pegawai<span class="_ _5"> </span>:<span class="_ _b"> </span>Cop Pejabat<span class="_ _a"> </span>:</div>
            <div class="t m0 x8 h2 y1c ff1 fs0 fc0 sc0 ls0 ws0">Tempatan<span class="_ _e"> </span>:</div>
            <div class="t m0 x7 h2 y1d ff1 fs0 fc0 sc0 ls0 ws0">Nama Pengawai<span class="_ _6"> </span>:</div>
        </div>
        <div class="pi"></div>
    </div>
</div>
</div>
</body>
</html>
