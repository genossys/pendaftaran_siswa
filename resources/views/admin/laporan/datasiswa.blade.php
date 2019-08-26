@extends('admin.master')

@section('judul')
Data Siswa
@endsection

@section('content')


<!-- Button to Open the Modal -->
<div class="form-group pt-3 w-25">
    <label>Status</label>
    <select class="form-control" id="status" name="status">
        <option value="">semua</option>
        <option value="menunggu">menunggu</option>
        <option value="terima">terima</option>
        <option value="tolak">tolak</option>
    </select>
</div>

<div class="pt-4 ">
    <a type="button" class="btn btn-primary pull-left" href="/cetakLapSiswa">
        <span><i class="fa fa-print" aria-hidden="true"></i></span>
    </a>
</div>

<div class="table-responsive-lg w-100">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>


@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/autotext.css')}}">
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });


</script>
<script src="{{ asset('js/handlebars.js') }}"></script>
<script id="details-template" type="text/x-handlebars-templatel">
    @verbatim

            <div class="row">
                <div class="col-sm-2">
                    <img src="foto/{{ 'urlFoto' }}"  class="w-100 h-100 rounded" style="object-fit: cover">
                </div>
                <div class="col-sm-10">
                    <table class="table table-light">
                    <tbody>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ 'alamat' }}</td>

                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ 'tglLahir' }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{'jenisKelamin'}}
                                </td>
                        </tr>
                        <tr>
                            <td>Nama Orang Tua</td>
                            <td>:</td>

                            <td>{{ 'namaOrtu' }}</td>
                        </tr>
                        <tr>
                            <td>No. Telp</td>
                            <td>:</td>

                            <td>{{ 'noHp' }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <a id="btnCetak" class="btn btn-primary" href="/cetakDataSiswa/{{ id }}">Cetak</a>
                </div>
                </div>
            </div>
        @endverbatim
        </script>
<script src="{{ asset('/js/tampilan/changemodal.js') }}"></script>
<script src="{{ asset('/js/Laporan/pendaftar.js') }}"></script>

@endsection
