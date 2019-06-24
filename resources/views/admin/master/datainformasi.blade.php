@extends('admin.master')

@section('judul')
Data Informasi
@endsection

@section('content')


<!-- Button to Open the Modal -->
<div class="pt-4">
    <button id="tambahModal" type="button" class="btn btn-primary box-tools pull-left" data-toggle="modal" data-target="#modaltambahInformasi">
        <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
    </button>

</div>

<div class="table-responsive-lg">
    <table id="example2" class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tanggal</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!--Srart Modal -->
<div class="modal fade" id="modaltambahInformasi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informasi Baru</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="#" method="POST" id="formSimpanInformasi" class="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>

                    <input type="hidden" name="txtId" id="txtId">
                    <div class="form-group">
                        <label>Judul Informasi </label>
                        <input type="text" class="form-control" placeholder="Judul Informasi" id="txtJudulInfo" name="txtJudulInfo">
                    </div>


                    <div class="form-group">
                        <label>Isi Pesan </label>
                        <textarea class="form-control" rows="5" id="txtIsiInfo" name="txtIsiInfo"></textarea>
                    </div>


                    <div class="text-right">
                        <button id="btnSimpan" class="btn btn-primary"></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- EndModal -->

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap4.min.css')}}">
@endsection


@section('script')
<script src="{{ asset('/js/tampilan/fileinput.js') }}"></script>
<script src="{{ asset('/js/tampilan/changemodal.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
<script src="{{ asset('/js/Master/informasi.js') }}"></script>
@endsection
