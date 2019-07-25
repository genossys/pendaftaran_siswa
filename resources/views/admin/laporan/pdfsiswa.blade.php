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
    <br>
    <br>
    <br>
    <div class="mt-5">
        <img src="foto/{{ $siswa->urlFoto }}" class="rounded" style="object-fit: cover;width: 200px;height: 300px" />

        <div style="margin-left: 20px" class="d-inline-block">
            <table>
                <tr>
                    <td>
                        <p>Nama </p>
                    </td>
                    <td>
                        <p>: {{$siswa->nama}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p>Tgl. Lahir</p>
                    </td>
                    <td>
                        <p>: {{$siswa->tglLahir}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p>Jenis. Kel</p>
                    </td>
                    <td>
                        <p>: {{$siswa->jenisKelamin}}</p>
                    </td>
                </tr>

                <tr>

                    <td>
                        <p>Alamat</p>
                    </td>
                    <td>
                        <p>: {{$siswa->alamat}}</p>

                    </td>
                </tr>

                <tr>
                    <td>
                        <p>Nama Ortu</p>
                    </td>
                    <td>
                        <p>: {{$siswa->namaOrtu}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p>No. Hp</p>
                    </td>
                    <td>
                        <p>: {{$siswa->noHp}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p>Email</p>
                    </td>
                    <td>
                        <p>: {{$siswa->email}}</p>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <div style="position: absolute;top: 650px;left:10px;width: 300px">
        <p class="text-center mb-5">Kepala Sekolah</p>
        <p class="text-center">(...........................)</p>
    </div>

    <div style="position: absolute;top: 650px;right:10px;width: 300px">
        <p class="text-center mb-5">Admin</p>
        <p class="text-center">(...........................)</p>
    </div>


    <footer class="footer">
        @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> di cetak oleh : {{auth()->user()->username}}</p>
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
    </footer>

    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
