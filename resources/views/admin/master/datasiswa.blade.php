@extends('admin.master')

@section('judul')
Data Siswa
@endsection

@section('content')


<!-- Button to Open the Modal -->
<div>
    
    <button id="tambahModal" style="margin-bottom: 10px; margin-top: 20px" type="button" class="btn btn-primary box-tools pull-right" data-toggle="modal" data-target="#modaltambahSiswa">
        Tambah Data Siswa
    </button>

</div>

<div class="table-responsive-lg">
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

<!--Srart Modal -->
<div class="modal fade" id="modaltambahSiswa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Siswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="#" method="POST" id="formData" class="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <input type="hidden" name="txtOldUsername" id="txtOldUsername">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Username </label>
                                <input type="text" class="form-control" placeholder="Username" id="txtUsername" name="txtUsername">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email </label>
                                <input type="email" class="form-control" placeholder="Email" id="txtEmail" name="txtEmail">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa </label>
                        <input type="text" class="form-control" placeholder="Nama Siswa" id="txtNama" name="txtNama">
                    </div>

                    <div class="form-group">
                        <label>Alamat </label>
                        <input type="text" class="form-control" placeholder="Alamat" id="txtAlamat" name="txtAlamat">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right datepicker" name="dateTanggalLahir" id="dateTanggalLahir">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <select class="form-control" name="cmbJenis" id="cmbJenis">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                              </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group">
                                <label>Nama Ortu </label>
                                <input type="text" class="form-control" placeholder="Nama Orang Tua" id="txtNamaOrtu" name="txtNamaOrtu">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>No.Telp </label>
                                <input type="text" class="form-control" placeholder="No. Telp" id="txtNoTelp" name="txtNoTelp">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="labelpassword">Password</label>
                                <input type="password" class="form-control" placeholder="Password" id="txtPasswordUser" name="txtPasswordUser">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label id="labelpassword">Konfirmasi Password</label>
                                <input type="password" class="form-control" placeholder="Masukan Ulang Password" id="txtConPasswordUser" name="txtConPasswordUser">
                                <small id="passwordHelp" class="text-danger" hidden>
                                    Password Tidak Cocok
                                </small>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>File Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileFoto" name="fileFoto" accept="image/*">
                            <label class="custom-file-label" for="customFile">Pilih file</label>
                        </div>
                    </div>
                </form>
                    <div class="text-right">
                        <button id="btnSimpan" class="btn btn-primary"></button>
                    </div>
                </div>

            
        </div>
    </div>
</div>
<!-- EndModal -->

<div id="modalStatus" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h6 class="modal-title">Ganti Status</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-body">
                <form action="{{ route('gantiStatus') }}" method="POST" id="FormStatus">
                    {{ csrf_field() }}
                <input type="hidden" name="txtUser" id="txtUser">
               <div class="form-group">
                 <label>Status</label>
                 <select class="form-control" name="cmbStatus" id="cmbStatus">
                   <option value="menunggu">Menunggu</option>
                   <option value="terima">Terima</option>
                   <option value="tolak">Tolak</option>
                 </select>
               </div>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button id="btnStatus" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker.min.css')}}">
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
                    <img src="foto/{{ 'urlFoto' }}" height="100" width="100">
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
                    <button id="btnCetak" class="btn btn-primary">Cetak</button>
                    <button id="btnEdit" class="btn btn-primary" onclick="showEditModal('{{'username'}}', '{{'email'}}',
                    '{{'nama'}}', '{{'alamat'}}','{{'tglLahir'}}', '{{'jenisKelamin'}}', '{{'namaOrtu'}}', '{{ 'noHp' }}', event)">Edit</button>
                </div>
                </div>
            </div>
             @endverbatim    
        </script>
        <script src="{{ asset('/js/tampilan/changemodal.js') }}"></script>
<script src="{{ asset('/js/Master/pendaftar.js') }}"></script>

@endsection
