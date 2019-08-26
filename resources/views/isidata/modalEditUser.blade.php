<div class="alert alert-danger" style="display:none"></div>
<div class="alert alert-success" style="display:none"></div>
<input id="id" name="id" hidden value="{{$user->id}}" <div class="form-group">
<label>User Name </label>
<input type="text" class="form-control" placeholder="Username" id="username" name="username" value="{{$user->username}}">
</div>
<div class="form-group">
    <label>email</label>
    <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{$user->email}}">
</div>

<div class="form-group">
    <label>Hak Akses</label>
    <select class="form-control" id="hakAkses" name="hakAkses">
        <option value="{{$user->hakAkses}}">{{$user->hakAkses}}</option>
        <option disabled>_______________</option>
        <option value="admin">Admin</option>
        <option value="pimpinan">Pimpinan</option>
        <option value="pegawai">Pegawai</option>
    </select>
</div>

<div class="text-right">
    <!-- <input id="btnSimpan" class="btn btn-primary" type="submit">Simpan <i id="iconbtn" class="fa fa-floppy-o" aria-hidden="true"></i></inp> -->
    <button name="btnSimpan" id="btnSimpan" class="btn btn-primary">Simpan</button>
</div>
