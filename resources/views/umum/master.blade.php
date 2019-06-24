<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SMK N 1 SAWIT</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/genosstyle.css') }}" rel="stylesheet" />
</head>

<body>

    <div class="content">
        @yield('content')
    </div>

    <footer class="kaki mt-auto">
        <div class="bg-dark kakicontent">
            <p style="font-size: 16px;font-weight: 700px">Hubungi Kami:</p>
            <hr class="text-white bg-white w-25">
            <p><span>
                    <i class="fa fa-address-card" aria-hidden="true"></i>&nbsp; Jl. Prof WZ Johanes 58, Jl. RE Martadinata 143
                </span> </p>

            <p><span>
                    <i class="fa fa-phone" aria-hidden="true"></i>&nbsp; 0892 1747 1233
                </span></p>

            <p><span>
                    <i class="fa fa-inbox"></i>&nbsp; tk-----@gmail.com
                </span></p>
        </div>
        <script>
            var d = new Date();
            var year = d.getFullYear();
            document.getElementById("copy-year").innerHTML = year;
        </script>
    </footer>

</body>

<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('/js/jquery.min.js') }}"></script>

</html>
