<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laporan Transaksi</title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" type="text/css">


</head>

<body>

<style>
    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 0;
    }
</style>

<br>
<div style="width:100%">
    <h4 class="text-center">LAPORAN TRANSAKSI</h4>
    <p class="text-center text-black-50">{{$awal}} - {{$akhir}}</p>
    <p class="text-center text-black-50">status: {{$statusstring}}</p>

</div>
<br>
<br>

<table class="table table-striped">
    <tr>
        <th> #</th>
        <th> No Transaksis</th>
        <th> Tanggal</th>
        <th> Pembayaran</th>
        <th> Status</th>
        <th> Total Harga</th>
    </tr>
    @php $i=1; @endphp
    @foreach($transaksi as $p)
        <tr>
            <td class="budget">{{$loop->index+1}}</td>
            <td class="budget">{{$p->no_transaksi}}</td>
            <td class="budget">{{$p->created_at}}</td>
            <td class="budget">{{$p->last_payment == null ? 'Belum ada' : ($p->last_payment == '0' ? 'Menunggu' : ($p->last_payment == '1' ? 'Diterima' : 'Ditolak')) }}</td>
            <td class="budget">{{$p->status == '0' ? 'Menunggu' : ($p->status == '1' ? 'Proses' : ($p->status == '2' ? 'Selesai' : 'Tolak'))}}</td>
            <td class="budget">Rp. {{number_format($p->nominal,0,',','.')}}</td>
        </tr>
    @endforeach
</table>
<div style="right:10px;width: 300px;display: inline-block;margin-top:70px">
    <p class="text-center mb-5">Pimpinan</p>
    <p class="text-center">( ........................... )</p>
</div>

<div style="left:10px;width: 300px; margin-left : 100px;display: inline-block">
    <p class="text-center mb-5">Admin</p>
    <p class="text-center">(
        {{auth()->user()->username}}
        )</p>
</div>


<footer class="footer">
    @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
    <p class="text-right small mb-0 mt-0 pt-0 pb-0"> di cetak oleh :
        {{auth()->user()->username}}
    </p>
    <p class="text-right small mb-0 mt-0 pt-0 pb-0"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
</footer>

<!-- JS -->
<script src="js/app.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>
