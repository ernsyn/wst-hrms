<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" href="{{asset('css/report/eaForm/base.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/report/eaForm/main.css')}}"/>
    <title></title>
</head>
<body>
<div id="page-container">
    @foreach($dataArr as $data )
    <!-- next page -->
    <div style="page-break-before:always">&nbsp;</div>

    <div id="pf1" class="pf w0 h0">
        <div class="pc pc1 w0 h0">
            <img class="bi x0 y0 w1 h1" alt="" src="{{asset('img/report/eaForm.png')}}"/>
            <div class="t m0 x1 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0">(C.P. 8A - Pin. 2017)</div>
            <div class="t m0 x2 h2 y2 ff1 fs0 fc0 sc0 ls1 ws0">MALAYSIA</div>
            <div class="t m0 x3 h2 y3 ff1 fs0 fc1 sc0 ls2 ws0 fontW">Penyata Gaji Pekerja SWASTA</div>
            <div class="t m0 x4 h3 y4 ff2 fs1 fc0 sc0 ls3 ws0"><b>EA</b></div>
            <div class="t m0 x5 h4 y5 ff2 fs2 fc0 sc0 ls4 ws0"><b>CUKAI PENDAPATAN</b></div>
            <div class="t m0 x6 h2 y6 ff1 fs0 fc0 sc0 ls5 ws0">No. Cukai Pendapatan  Pekerja <br>&nbsp;{{$data->getIncomeTaxNo()}}</div>
            <div class="t m0 x1 h2 y7 ff1 fs0 fc0 sc0 ls6 ws0">No. Siri</div>
            <div class="t m0 x7 h2 y8 ff1 fs0 fc0 sc0 ls7 ws0">PENYATA SARAAN  DARIPADA  PENGGAJIAN</div>
            <div class="t m0 x1 h2 y9 ff1 fs0 fc0 sc0 ls8 ws0">No. Majikan  E<span class="_ _0"> </span><span class="ls9">BAGI  TAHUN  BERAKHIR  31  DISEMBER<span class="_ _1"> </span><span class="lsa">Cawangan LHDNM &nbsp;&nbsp;&nbsp;{{$data->getLhdnmBranch()}}</spa></span></div>
            <div class="t m0 x8 h2 ya ff1 fs0 fc1 sc0 lsb ws0 fontW">BORANG EA  INI  PERLU  DISEDIAKAN  UNTUK  DISERAHKAN  KEPADA  PEKERJA  BAGI  TUJUAN  CUKAI  PENDAPATAN</div>
            <div class="t m0 x9 h2 yb ff1 fs0 fc0 sc0 lsc ws0">{{$data->getSerialNo()}}</div>
            <div class="t m0 x9 h2 yc ff1 fs0 fc0 sc0 lsd ws0">{{$data->getEmployerNoE()}}</div>
            <div class="t m0 xa h2 yd ff1 fs0 fc0 sc0 lse ws0">{{$data->getYear()}}</div>
            <div class="t m0 xb h5 ye ff1 fs0 fc1 sc0 lsf ws0 "><span class="fontW">A</span><span class="_ _2"> </span><span class="ff2 fc0 ls10"><b>BUTIRAN  PEKERJA</b></span></div>
            <div class="t m0 xc h2 yf ff1 fs0 fc0 sc0 ls11 ws0">1. Nama Penuh  Pekerja/Pesara  (En./Cik/Puan)</div>
            <div class="t m0 xc h2 y10 ff1 fs0 fc0 sc0 ls12 ws0">2. Jawatan</div>
            <div class="t m0 xc h2 y11 ff1 fs0 fc0 sc0 ls13 ws0">4. No. K.P. Baru</div>
            <div class="t m0 xc h2 y12 ff1 fs0 fc0 sc0 ls14 ws0">6. No. KWSP</div>
            <div class="t m0 xc h2 y13 ff1 fs0 fc0 sc0 ls15 ws0">8. Bilangan Anak Yang Layak</div>
            <div class="t m0 xd h2 y14 ff1 fs0 fc0 sc0 ls16 ws0">Untuk Pelepasan Cukai</div>
            <div class="t m0 xe h2 y15 ff1 fs0 fc0 sc0 ls17 ws0">3. No. Kakitangan/No.  Gaji<span class="lse" style="padding-left: 110pt;">{{$data->getSalaryNo()}}</span></div>
            <div class="t m0 xe h2 y11 ff1 fs0 fc0 sc0 ls18 ws0">5. No. Pasport <span class="lse" style="padding-left: 335pt;">{{$data->getPassportNo()}}</span></div>
            <div class="t m0 xe h2 y12 ff1 fs0 fc0 sc0 ls19 ws0">7. No.  PERKESO<span class="lse" style="padding-left: 299pt;">{{$data->getPerkesoNo()}}</span></div>
            <div class="t m0 xe h2 y13 ff1 fs0 fc0 sc0 ls1a ws0">9. Jika bekerja tidak genap setahun, nyatakan:</div>
            <div class="t m0 xf h2 y16 ff1 fs0 fc0 sc0 ls1b ws0">(a) Tarikh mula bekerja <span class="lse" style="padding-left: 100pt;">{{$data->getStartDateLessOneYear()}}</span></div>
            <div class="t m0 xf h2 y17 ff1 fs0 fc0 sc0 ls1c ws0">(b) Tarikh berhenti kerja <span class="lse" style="padding-left: 80pt;">{{$data->getEndDateLessOneYear()}}</span></div>
            <div class="t m0 x10 h2 y18 ff1 fs0 fc0 sc0 ls1d ws0">{{$data->getName()}}</div>
            <div class="t m0 x11 h2 y19 ff1 fs0 fc0 sc0 ls1e ws0">{{$data->getJobPosition()}}</div>
            <div class="t m0 x11 h2 y1a ff1 fs0 fc0 sc0 ls1f ws0">{{$data->getIcNo()}}</div>
            <div class="t m0 x11 h2 y1b ff1 fs0 fc0 sc0 ls20 ws0">{{$data->getKwspNo()}}</div>
            <div class="t m0 x12 h2 y1c ff1 fs0 fc0 sc0 lsf ws0">{{$data->getChildNoforTax()}}</div>
            <div class="t m0 xb h2 y1d ff1 fs0 fc1 sc0 lsf ws0 fontW">B</div>
            <div class="t m0 xc h5 y1e ff2 fs0 fc0 sc0 ls21 ws0"><b>PENDAPATAN PENGGAJIAN, MANFAAT DAN TEMPAT KEDIAMAN</b></div>
            <div class="t m0 xc h2 y1f ff1 fs0 fc0 sc0 ls22 ws0">(Tidak Termasuk Elaun/Perkuisit/Pemberian/Manfaat Yang  Dikecualikan  Cukai)</div>
            <div class="t m0 x13 h5 y20 ff2 fs0 fc0 sc0 ls23 ws0">RM</div>
            <div class="t m0 xc h2 y21 ff1 fs0 fc0 sc0 ls24 ws0">1.<span class="_ _5"> </span><span class="ls25">(a) Gaji kasar, upah atau gaji cuti (termasuk gaji lebih masa)</span></div>
            <div class="t m0 x14 h2 y22 ff1 fs0 fc0 sc0 ls26 ws0">(b) Fi (termasuk fi pengarah), komisen atau bonus</div>
            <div class="t m0 x14 h2 y23 ff1 fs0 fc0 sc0 ls27 ws0">(c) Tip kasar, perkuisit, penerimaan sagu hati atau elaun-elaun lain (Perihal pembayaran: ...........................)</div>
            <div class="t m0 x14 h2 y24 ff1 fs0 fc0 sc0 ls28 ws0">(d) Cukai Pendapatan yang dibayar oleh Majikan bagi pihak  Pekerja</div>
            <div class="t m0 x14 h2 y25 ff1 fs0 fc0 sc0 ls29 ws0">(e) Manfaat Skim Opsyen Saham Pekerja  (ESOS)</div>
            <div class="t m0 x14 h2 y26 ff1 fs0 fc0 sc0 ls2a ws0">(f) Ganjaran bagi tempoh dari ....................................... hingga .......................................</div>
            <div class="t m0 xc h2 y27 ff1 fs0 fc0 sc0 ls24 ws0">2.<span class="_ _5"> </span><span class="ls2b">Butiran bayaran tunggakan dan lain-lain bagi tahun-tahun terdahulu dalam tahun semasa</span></div>
            <div class="t m0 x14 h2 y28 ff1 fs0 fc0 sc0 ls2c ws0">Jenis pendapatan<span class="_ _6"> </span><span class="ls2d">(a) .....................................................................</span></div>
            <div class="t m0 x15 h2 y29 ff1 fs0 fc0 sc0 ls2d ws0">(b) .....................................................................</div>
            <div class="t m0 xc h2 y2a ff1 fs0 fc0 sc0 ls24 ws0">3.<span class="_ _5"> </span><span class="ls2e">Manfaat berupa barangan (Nyatakan: .......................................................................................................)</span></div>
            <div class="t m0 xc h2 y2b ff1 fs0 fc0 sc0 ls24 ws0">4.<span class="_ _5"> </span><span class="ls2f">Nilai tempat kediaman  (Alamat:  ................................................................................................................)</span></div>
            <div class="t m0 xc h2 y2c ff1 fs0 fc0 sc0 ls24 ws0">5.<span class="_ _5"> </span><span class="ls30">Bayaran balik daripada Kumpulan Wang Simpanan/Pencen yang tidak  diluluskan</span></div>
            <div class="t m0 xc h2 y2d ff1 fs0 fc0 sc0 ls24 ws0">6.<span class="_ _5"> </span><span class="ls31">Pampasan kerana kehilangan pekerjaan</span></div>
            <div class="t m0 xb h5 y2e ff1 fs0 fc1 sc0 lsf ws0"><span class="fontW">C</span><span class="_ _7"> </span><span class="ff2 fc0 ls32"><b>PENCEN DAN LAIN-LAIN</b></span></div>
            <div class="t m0 xc h2 y2f ff1 fs0 fc0 sc0 ls24 ws0">1.<span class="_ _5"> </span><span class="ls33">Pencen</span></div>
            <div class="t m0 xc h2 y30 ff1 fs0 fc0 sc0 ls24 ws0">2.<span class="_ _5"> </span><span class="ls34">Anuiti atau Bayaran Berkala yang lain</span></div>
            <div class="t m0 xc h5 y31 ff2 fs0 fc0 sc0 ls35 ws0"><b>JUMLAH</b></div>
            <div class="t m0 x16 h2 y32 ff1 fs0 fc0 sc0 ls36 ws0"><span style="padding-right: 800pt;">{{$data->getNetSalary()}}</span></div>
            <div class="t m0 x16 h2 y33 ff1 fs0 fc0 sc0 ls36 ws0">{{$data->getCommission()}}</div>
            <div class="t m0 x17 h2 y34 ff1 fs0 fc0 sc0 ls36 ws0">{{$data->getTip()}}</div>
            <div class="t m0 x18 h2 y35 ff1 fs0 fc0 sc0 ls37 ws0">..........<span class="_ _8"> </span>..........</div>
            <div class="t m0 x16 h2 y36 ff1 fs0 fc0 sc0 ls36 ws0">{{$data->getTotal()}}</div>
            <div class="t m0 xb h5 y37 ff1 fs0 fc1 sc0 lsf ws0"><span class="fontW">D</span><span class="_ _7"> </span><span class="ff2 fc0 ls38"><b>JUMLAH POTONGAN</b></span></div>
            <div class="t m0 xc h2 y38 ff1 fs0 fc0 sc0 ls24 ws0">1.<span class="_ _5"> </span><span class="ls39">Potongan Cukai Bulanan (PCB) yang dibayar kepada  LHDNM</span></div>
            <div class="t m0 xc h2 y39 ff1 fs0 fc0 sc0 ls24 ws0">2.<span class="_ _5"> </span><span class="ls3a">Arahan Potongan CP 38</span></div>
            <div class="t m0 xc h2 y3a ff1 fs0 fc0 sc0 ls24 ws0">3.<span class="_ _5"> </span><span class="ls3b">Zakat yang dibayar melalui potongan gaji</span></div>
            <div class="t m0 xc h2 y3b ff1 fs0 fc0 sc0 ls24 ws0">4.<span class="_ _5"> </span><span class="ls3c">Jumlah tuntutan potongan oleh pekerja melalui Borang TP1  berkaitan:</span></div>
            <div class="t m0 x14 h2 y3c ff1 fs0 fc0 sc0 ls3d ws0">(a) Pelepasan<span class="_ _9"> </span><span class="ls3e">RM ...................................</span></div>
            <div class="t m0 x14 h2 y3d ff1 fs0 fc0 sc0 ls3f ws0">(b) Zakat selain yang dibayar melalui potongan gaji bulanan<span class="_ _a"> </span><span class="ls3e">RM ...................................</span></div>
            <div class="t m0 xc h2 y3e ff1 fs0 fc0 sc0 ls24 ws0">5.<span class="_ _5"> </span><span class="ls40">Jumlah pelepasan bagi anak yang layak</span></div>
            <div class="t m0 x4 h2 y3f ff1 fs0 fc0 sc0 ls41 ws0">{{$data->getPcb()}}</div>
            <div class="t m0 x19 h2 y40 ff1 fs0 fc0 sc0 ls42 ws0">{{$data->getDeductionsInstructionsCP38()}}</div>
            <div class="t m0 x19 h2 y41 ff1 fs0 fc0 sc0 ls42 ws0">{{$data->getZakatPaidThroughSalaryDeductions()}}</div>
            <div class="t m0 x1a h2 y42 ff1 fs0 fc0 sc0 ls42 ws0">{{$data->getTp1Release()}}</div>
            <div class="t m0 x1a h2 y43 ff1 fs0 fc0 sc0 ls42 ws0">{{$data->getTp1Zakat()}}</div>
            <div class="t m0 x19 h2 y44 ff1 fs0 fc0 sc0 ls42 ws0">{{$data->getTotalDisbursementForEligibleChildren()}}</div>
            <div class="t m0 xb h5 y45 ff1 fs0 fc1 sc0 lsf ws0"><span class="fontW">E</span><span class="_ _2"> </span><span class="ff2 fc0 ls43"><b>CARUMAN YANG DIBAYAR OLEH PEKERJA KEPADA KUMPULAN  WANG  SIMPANAN/PENCEN  YANG  DILULUSKAN  DAN  PERKESO</b></span></div>
            <div class="t m0 xc h2 y46 ff1 fs0 fc0 sc0 ls24 ws0">1.<span class="_ _5"> </span><span class="ls44">Nama Kumpulan  Wang</span></div>
            <div class="t m0 x14 h2 y47 ff1 fs0 fc0 sc0 ls45 ws0">Amaun caruman yang wajib dibayar (nyatakan bahagian pekerja sahaja)<span class="_ _b"> </span><span class="ls46">RM</span></div>
            <div class="t m0 xc h2 y48 ff1 fs0 fc0 sc0 ls24 ws0">2.<span class="_ _5"> </span><span class="ls47">PERKESO : Amaun caruman yang wajib dibayar (nyatakan bahagian pekerja sahaja)<span class="_ _c"> </span><span class="ls46">RM</span></span></div>
            <div class="t m0 x12 h2 y49 ff1 fs0 fc0 sc0 ls48 ws0">{{$data->getNameOfFund()}}</div>
            <div class="t m0 x17 h2 y4a ff1 fs0 fc0 sc0 ls36 ws0">{{$data->getAmountOfContribution()}}</div>
            <div class="t m0 x4 h2 y4b ff1 fs0 fc0 sc0 ls41 ws0">{{$data->getAmountOfContributionPerkeso()}}</div>
            <div class="t m0 xb h5 y4c ff1 fs0 fc1 sc0 lsf ws0"><span class="fontW">F</span><span class="_ _d"> </span><span class="ff2 fc0 ls49"><b>JUMLAH ELAUN / PERKUISIT / PEMBERIAN / MANFAAT YANG  DIKECUALIKAN  CUKAI</b><span class="_ _e"> </span><span class="ff1 ls46">RM</span></span></div>
            <div class="t m0 x19 h2 y4d ff1 fs0 fc0 sc0 ls42 ws0">{{$data->getTotalAllowance()}}</div>
            <div class="t m0 x1b h2 y4e ff1 fs0 fc0 sc0 ls4a ws0">Nama Pegawai</div>
            <div class="t m0 x1b h2 y4f ff1 fs0 fc0 sc0 ls4b ws0">Jawatan</div>
            <div class="t m0 x1b h2 y50 ff1 fs0 fc0 sc0 ls4c ws0">Nama dan Alamat  Majikan</div>
            <div class="t m0 x1b h2 y51 ff1 fs0 fc0 sc0 ls4d ws0">No. Telefon Majikan</div>
            <div class="t m0 x1 h2 y52 ff1 fs0 fc0 sc0 ls4e ws0">Tarikh</div>
            <div class="t m0 x1c h2 y53 ff1 fs0 fc0 sc0 ls4f ws0">{{$data->getOfficerName()}}</div>
            <div class="t m0 x1c h2 y54 ff1 fs0 fc0 sc0 ls50 ws0">{{$data->getOfficerPosition()}}</div>
            <div class="t m0 x1c h2 y55 ff1 fs0 fc0 sc0 ls51 ws0">{{$data->getCompanyName()}}</div>
            <div class="t m0 x1c h2 y56 ff1 fs0 fc0 sc0 ls52 ws0">{{$data->getCompanyAddress1()}}</div>
            <div class="t m0 x1c h2 y57 ff1 fs0 fc0 sc0 ls4d ws0">{{$data->getCompanyAddress2()}}</div>
            <div class="t m0 x1c h2 y58 ff1 fs0 fc0 sc0 ls53 ws0">{{$data->getCompanyAddress3()}} Poskod  {{$data->getCompanyPostcode()}}</div>
            <div class="t m0 x1c h2 y59 ff1 fs0 fc0 sc0 ls54 ws0">{{$data->getCompanyNoTel()}}<span class="_ _f"></span><span class="ls36">{{$data->getDate()}}</span></div>
        </div>
        <div class="pi"></div>
    </div>
    @endforeach
</div>
</body>
</html>
