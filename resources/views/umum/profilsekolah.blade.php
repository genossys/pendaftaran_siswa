@extends('umum.master')
@section('content')
<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img style="width: 100%" src="{{ asset('/assets/gambar/slide1.jpg') }}" alt="Slide 1">

        </div>
        <div class="carousel-item">
            <img style="width: 100%" src="{{ asset('/assets/gambar/slide2.jpg') }}" alt="Slide 2">

        </div>
        <div class="carousel-item">
            <img style="width: 100%" src="{{ asset('/assets/gambar/slide3.jpg') }}" alt="Slide 3">

        </div>

    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>

</div>

<div class="galery pt-3" style="background-color: #dddddd">
    <div class="container">
        <div class="row ">
            <div class="col-sm-5 offset-1 text-right">
                <h3 class="font-weight-bold">Visi</h3>
                <p>Secara umum, pengertian Visi adalah pandangan jauh ke depan dari individu atau suatu organisasi, berkaitan dengan tujuan yang ingin dicapai, dan apa yang perlu dilakukan untuk mewujudkan visi tersebut di masa depan.</p>
            </div>

            <div class="col-sm-5 text-left">
                <h3 class="font-weight-bold text">Misi</h3>
                <p>Secara umum pengertian misi adalah segala sesuatu (strategi, tindakan) yang harus dilakukan untuk mewujudkan visi. Misi organisasi merupakan tujuan dan alasan berdirinya sebuah organisasi dan menjadi pedoman dan arahan dalam mencapai tujuan organisasi.</p>
            </div>
        </div>
    </div>
</div>

<div class="isi pt-3 pb-3" style="background-color: #dddddd">
    <div class="container">
        <h3 class="font-weight-bold text-center">Galeri</h3>
        <div class="row">
            <div class="col-sm-4">
                <img class="img-fluid img-thumbnail" src="{{asset ('/assets/gambar/gambarhome.jpg')}}" alt="">
            </div>

            <div class="col-sm-4">
                <img class="img-fluid img-thumbnail" src="{{asset ('/assets/gambar/gambarhome.jpg')}}" alt="">
            </div>

            <div class="col-sm-4">
                <img class="img-fluid img-thumbnail" src="{{asset ('/assets/gambar/gambarhome.jpg')}}" alt="">
            </div>

        </div>

    </div>
</div>
@endsection
