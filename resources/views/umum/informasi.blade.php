@extends('umum.master')
@section('content')

<div style="background-color: #dddddd" class="pt-2 pb-3">
    <div class="container">

        @foreach($info as $i)
        <div class="rounded mb-3">
            <div class="bg-info p-2 rounded">
                <p class="text-right text-white mb-0 pb-0">{{$i->tanggal}}</p>
                <p class="text-left text-white text-bold mb-0 pb-0" style="font-size: 20px;font-weight: 700">{{$i->judul}}</p>
            </div>
            <div class="bg-white p-2 rounded">
                <p class="text-justify">{{$i->isi}}</p>
            </div>
        </div>
        @endforeach
    </div>

    @endsection
