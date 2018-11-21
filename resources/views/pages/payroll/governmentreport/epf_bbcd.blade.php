<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" href="{{asset('css/report/epf_bbcd/base.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/report/epf_bbcd/main.css')}}"/>
    <title></title>
</head>
<body>
<div id="page-container">
    <div id="pf1" class="pf w0 h0">
        <div class="pc pc1 w0 h0"><img class="bi x0 y0 w1 h1" alt="" src="{{asset('img/report/epf_bbcd.png')}}"/>
            <div class="t m0 x1 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0"><b>BORANG(BBCD)</b></div>
            <div class="t m0 x2 h2 y2 ff1 fs0 fc0 sc0 ls1 ws0"><b>KUMPULAN WANG SIMPANAN  PEKERJA</b></div>
            <div class="t m0 x3 h3 y3 ff2 fs1 fc0 sc0 ls2 ws0">(Peraturan-Peraturan Dan Kaedah-Kaedah KWSP 1991(Kaedah 11(1)))</div>
            <div class="t m0 x4 h3 y4 ff2 fs1 fc0 sc0 ls3 ws0">(BORANG BAYARAN CARUMAN BULANAN - DISKET  (BBCD))</div>
            <div class="t m0 x5 h2 y5 ff1 fs0 fc0 sc0 ls4 ws0"><b>SISTEM PENGHANTARAN DATA  PITA/DISKET</b></div>
            <div class="t m0 x6 h2 y6 ff1 fs0 fc0 sc0 ls5 ws0"><b>JADUAL CARUMAN BULAN  {{$data->getMonth()}}  {{$data->getYear()}}<b></b></div>
            <div class="t m0 x7 h2 y7 ff1 fs0 fc0 sc0 ls6 ws0" style="font-weight: bold">No.Rujukan Majikan<span class="_ _0"> </span><span class="ls7">Bulan Caruman<span class="_ _1"> </span><span class="ls8">Amaun Caruman</span></span></div>
            <div class="t m0 x8 h2 y8 ff1 fs0 fc0 sc0 ls9 ws0" style="font-weight: bold">{{$data->getEmployerReferenceNo()}}<span class="_ _2"> </span><span class="lsa">{{$data->getContributionMonth()}}<span class="_ _3"> </span><span class="lsb">RM    {{number_format($data->getContributionAmount(),2)}}</span></span></div>
            <div class="t m0 x9 h3 y9 ff2 fs1 fc0 sc0 lsc ws0">Jumlah caruman untuk bulan diatas (untuk potongan gaji bulan  Ogos 2018) hendaklah</div>
            <div class="t m0 x9 h3 ya ff2 fs1 fc0 sc0 lsd ws0">dibayar kepada KWSP/Ejen kutipan KWSP tidak lewat daripada 15hb setiap  bulan.</div>
            <div class="t m0 x9 h3 yb ff2 fs1 fc0 sc0 lse ws0">[  {{$data->getPaymentCash()}} ]Wang Tunai   [ {{$data->getPaymentCheck()}} ]Cek/Kiriman Wang/Wang Pos/Draf Bank *  No. </div>
            <div class="t m0 xa h4 yc ff2 fs0 fc0 sc0 lsf ws0">NAMA &amp;<span class="_ _4"> </span><span class="ls10">{{$data->getCompanyName()}}  {{$data->getCompanyRegistrationNo()}}</span></div>
            <div class="t m0 xa h4 yd ff2 fs0 fc0 sc0 ls11 ws0">ALAMAT<span class="_ _5"> </span><span class="ls12">{{$data->getCompanyAddress1()}}</span></div>
            <div class="t m0 x9 h4 ye ff2 fs0 fc0 sc0 ls13 ws0">{{$data->getCompanyAddress2()}}</div>
            <div class="t m0 x9 h4 yf ff2 fs0 fc0 sc0 ls14 ws0">{{$data->getCompanyAddress3()}}  Poskod: {{$data->getCompanyPostcode()}}</div>
            <div class="t m0 xb h2 y10 ff1 fs0 fc0 sc0 ls15 ws0" style="font-weight: bold">Cop Ejen Kutipan</div>
            <div class="t m0 xa h4 y11 ff2 fs0 fc0 sc0 ls16 ws0">SAYA MENGESAHKAN DAN MEMBERI JAMINAN BAHAWA BUTIRAN DAN JUMLAH  CARUMAN  BULAN</div>
            <div class="t m0 xa h4 y12 ff2 fs0 fc0 sc0 ls17 ws0">SEPTEMBER 2018 SEPERTI YANG TERKANDUNG DI DALAM  PITA/DISKET  KOMPUTER  YANG  DISERTAKAN</div>
            <div class="t m0 xa h4 y13 ff2 fs0 fc0 sc0 ls18 ws0">ADALAH SAMA DENGAN AMAUN BAYARAN DALAM BORANG  INI.</div>
            <div class="t m0 xa h4 y14 ff2 fs0 fc0 sc0 ls19 ws0">TANDATANGAN:<span class="_ _6"> </span><span class="ls1a">{{$data->getOfficerSignature()}}</span></div>
            <div class="t m0 xa h4 y15 ff2 fs0 fc0 sc0 ls1b ws0">NAMA PENUH:<span class="_ _7"> </span><span class="ls1c">{{$data->getOfficerName()}}</span></div>
            <div class="t m0 xa h4 y16 ff2 fs0 fc0 sc0 ls1d ws0">NO KPDN:<span class="_ _8"> </span><span class="ls1e">{{$data->getOfficerICNo()}}</span></div>
            <div class="t m0 xa h4 y17 ff2 fs0 fc0 sc0 ls1f ws0">JAWATAN:<span class="_ _9"> </span><span class="ls20">{{$data->getOfficerPosition()}}</span></div>
            <div class="t m0 xa h4 y18 ff2 fs0 fc0 sc0 ls21 ws0">NO. TELEFON:<span class="_ _a"> </span><span class="ls22">{{$data->getOfficerTelNo()}}</span></div>
            <div class="t m0 xc h3 y19 ff2 fs1 fc0 sc0 ls23 ws0">CATATAN:</div>
            <div class="t m0 xc h3 y1a ff2 fs1 fc0 sc0 ls24 ws0">1. Nombor Rujukan Majikan  mesti</div>
            <div class="t m0 xc h3 y1b ff2 fs1 fc0 sc0 ls25 ws0">   ditulis di belakang cek.</div>
            <div class="t m0 xc h3 y1c ff2 fs1 fc0 sc0 ls26 ws0">2. Jumlah cek mesti sama dengan</div>
            <div class="t m0 xc h3 y1d ff2 fs1 fc0 sc0 ls27 ws0">   jumlah Borang  BBCD.</div>
            <div class="t m0 xc h3 y1e ff2 fs1 fc0 sc0 ls28 ws0">3. Sekiranya terdapat lebih dari satu</div>
            <div class="t m0 xc h3 y1f ff2 fs1 fc0 sc0 ls29 ws0">   nombor majikan dalam  disket</div>
            <div class="t m0 xc h3 y20 ff2 fs1 fc0 sc0 ls2a ws0">   majikan hendaklah  menggunakan</div>
            <div class="t m0 xc h3 y21 ff2 fs1 fc0 sc0 ls2b ws0">   Borang BBCD berasingan bagi setiap</div>
            <div class="t m0 xc h3 y22 ff2 fs1 fc0 sc0 ls2c ws0">   nombor yang berkenaan.</div>
        </div>
        <div class="pi"></div>
    </div>
</div>
<div class="loading-indicator">

</div>
</body>
</html>
