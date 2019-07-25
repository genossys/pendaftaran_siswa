<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Siswa</title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">


</head>

<body>

    <style>
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 0cm;
        }
    </style>

    <img src="assets/gambar/kopsurat.png" class="w-100">

    <h2 class="mb-0 pb-0 ">Data Siswa</h2>
    <h5 class="mb-5 pt-0 mt-0">Laporan Data Siswa</h5>

    <table class="table table-sm table-striped">

        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Nama Siswa</th>
                <th class="text-center" scope="col">Tanggal Lahir</th>
                <th class="text-center" scope="col">Jenis Kelamin</th>
                <th class="text-center" scope="col">Nama Ortu</th>
                <th class="text-center" scope="col">Status</th>
            </tr>
        </thead>
        <tbody style="font-size: 12px">
            @php $i=1 @endphp
            @foreach($siswa as $sn)
            <tr>
                <th class="text-center" scope="row">{{$i++}}</th>
                <td>{{$sn->username}}</td>
                <td>{{$sn->tglLahir}}</td>
                @if($sn->jenisKelamin == 'L')
                <td>Laki-laki</td>
                @else
                <td>Laki-laki</td>
                @endif

                <td>{{$sn->namaOrtu}}</td>

                @if($sn->status == 'menunggu')
                <td class="text-warning">{{$sn->status}}</td>
                @elseif($sn->status == 'terima')
                <td class="text-success">{{$sn->status}}</td>
                @else
                <td class="text-danger">{{$sn->status}}</td>
                @endif


            </tr>
            @endforeach
        </tbody>
    </table>

    <footer class="footer">
        @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> di cetak oleh : {{auth()->user()->username}}</p>
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
    </footer>

    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>

</html>
