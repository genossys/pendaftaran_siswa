<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\pendaftarModel;
use App\Master\userModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;
use Dompdf\Dompdf;

class pendaftarControl extends Controller
{
    //
    public function index()
    {
        return view('admin/master/datasiswa');
    }

    public function laporan()
    {
        return view('admin/laporan/datasiswa');
    }

    public function getDataLaporanPendaftar(Request $req)
    {
        $pendaftar = pendaftarModel::all();

        return DataTables::of($pendaftar)
            ->addIndexColumn()
            ->addColumn('action', function ($pendaftar) {
                return '<a class="btn-sm btn-info details-control" id="btn-detail" href="#"><i class="fa fa-folder-open"></i></a>';
            })
            ->addColumn('jenisKelamin', function ($pendaftar) {
                if ($pendaftar->jenisKelamin == 'L') {
                    # code...
                    return 'Laki-Laki';
                } else {
                    # code...
                    return 'Perempuan';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataPendaftar()
    {
        $pendaftar = pendaftarModel::query()
            ->select('id', 'username', 'email', 'nama', 'alamat', 'tglLahir', 'jenisKelamin', 'namaOrtu', 'noHp', 'status', 'urlFoto')
            ->get();

        return DataTables::of($pendaftar)
            ->addIndexColumn()
            ->addColumn('action', function ($pendaftar) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showStatus(\'' . $pendaftar->username . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $pendaftar->username . '\',event)" ><i class="fa fa-trash"></i></a>
                            <a class="btn-sm btn-info details-control" id="btn-detail" href="#"><i class="fa fa-folder-open"></i></a>';
            })
            ->addColumn('jenisKelamin', function ($pendaftar) {
                if ($pendaftar->jenisKelamin == 'L') {
                    # code...
                    return 'Laki-Laki';
                } else {
                    # code...
                    return 'Perempuan';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Field :attribute Maksimal :max',
            'image'       => 'Field :attribute Harus File Gambar',
        ];

        $rules = [
            'txtUsername' => 'required|max:25',
            'txtEmail' => 'required|max:191',
            'txtNama' => 'required|max:255',
            'txtAlamat' => 'required',
            'dateTanggalLahir' => 'required',
            'txtNoTelp' => 'required|max:25',
            'txtPasswordUser' => 'required',
        ];
        $rulesEdit = [
            'txtUsername' => 'required|max:25',
            'txtEmail' => 'required|max:191',
            'txtNama' => 'required|max:255',
            'txtAlamat' => 'required',
            'dateTanggalLahir' => 'required',
            'txtNoTelp' => 'required|max:25',
        ];

        if ($r->input('idForm') == 'simpan') {
            # code...
            return Validator::make($r->all(), $rules, $messages);
        } else {
            # code...
            return Validator::make($r->all(), $rulesEdit, $messages);
        }
    }

    public function insert(Request $r)
    {

        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all(),
            ]);
        } else {
            if ($r->hasFile('fileFoto')) {
                $upFoto = $r->file('fileFoto');
                $namaFoto = $r->txtUsername . '.' . $upFoto->getClientOriginalExtension();
                $r->fileFoto->move(public_path('foto'), $namaFoto);
            } else {
                $namaFoto = '';
            }

            try {
                $pendaftar = new pendaftarModel;
                $pendaftar->email = $r->txtEmail;
                $pendaftar->username = $r->txtUsername;
                $pendaftar->password = Hash::make($r->txtPasswordUser);
                $pendaftar->nama = $r->txtNama;
                $pendaftar->alamat = $r->txtAlamat;
                $pendaftar->tglLahir = $r->dateTanggalLahir;
                $pendaftar->jenisKelamin = $r->cmbJenis;
                $pendaftar->namaOrtu = $r->txtNamaOrtu;
                $pendaftar->noHp = $r->txtNoTelp;
                $pendaftar->status = 'menunggu';
                $pendaftar->urlFoto = $namaFoto;
                $pendaftar->save();
                return response()->json([
                    'value' => 'success',
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $pendaftar,
                ]);
            } catch (\Exception  $e) {
                //throw $th;
                $exData = explode('(', $e->getMessage());
                return response()->json([
                    'value' => 'failed',
                    'valid' => true,
                    'sqlResponse' => false,
                    'data' => $exData[0],
                ]);
            }
        }
    }

    public function update(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all(),
            ]);
        } else {

            $oldusername = $r->txtOldUsername;
            $data = [
                'email' => $r->txtEmail,
                'username' => $r->txtUsername,
                'nama' => $r->txtNama,
                'alamat' => $r->txtAlamat,
                'tglLahir' => $r->dateTanggalLahir,
                'jenisKelamin' => $r->cmbJenis,
                'namaOrtu' => $r->txtNamaOrtu,
                'noHp' => $r->txtNoTelp,
            ];

            if ($r->txtPasswordUser != '') {
                $data = array_add($data, 'password', Hash::make($r->txtPasswordUser));
            }

            if ($r->hasFile('fileFoto')) {
                $upFoto = $r->file('fileFoto');
                $namaFoto = $r->txtUsername . '.' . $upFoto->getClientOriginalExtension();
                $r->fileFoto->move(public_path('foto'), $namaFoto);
                $data = array_add($data, 'urlFoto', $namaFoto);
            }

            try {
                pendaftarModel::query()
                    ->where('username', '=', $oldusername)
                    ->update($data);
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $data
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => false,
                    'data' => $e
                ]);
            }
        }
    }

    public function updateStatus(Request $r)
    {
        try {
            //code...
            $username = $r->txtUser;
            pendaftarModel::query()
                ->where('username', '=', $username)
                ->update(['status' => $r->cmbStatus]);
            return response()->json([
                'sqlResponse' => true,
            ]);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'sqlResponse' => false,
                'data' => $e
            ]);
        }
    }

    public function delete(Request $r)
    {
        try {
            $username = $r->input('username');
            pendaftarModel::query()
                ->where('username', '=', $username)
                ->delete();
            return response()->json([
                'sqlResponse' => true,
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'sqlResponse' => false,
                'data' => $th
            ]);
        }
    }


    public  function apiDataPendaftar()
    {
        $data = \App\Master\pendaftarModel::all();

        if (count($data) > 0) {
            $res['message'] = "success";
            $res['value'] = $data;
            return response($res);
        } else {
            $res['message'] = "empty";
            return response($res);
        }
    }

    public  function apiPencarianPendaftar($email)
    {

        $data = pendaftarModel::where('email', $email)->first();

        if ($data != null) {
            $res['value'] = "success";
            $res['id'] = $data->id;
            $res['email'] = $data->email;
            $res['nama'] = $data->nama;
            $res['alamat'] = $data->alamat;
            $res['username'] = $data->username;
            $res['tglLahir'] = $data->tglLahir;
            $res['jenisKelamin'] = $data->jenisKelamin;
            $res['namaOrtu'] = $data->namaOrtu;
            $res['noHp'] = $data->noHp;
            $res['urlFoto'] = $data->urlFoto;
            return response($res);
        } else {
            $res['value'] = "empty";
            return response($res);
        }
    }

    public function apiSimpanPendaftaran(Request $request)
    {

        $data = pendaftarModel::where('username', $request->txtUsername)->first();
        $data2 = pendaftarModel::where('email', $request->txtEmail)->first();

        if ($data != null) {
            return response()->json(['value' => "username sudah di pakai"]);
        } else if ($data2 != null) {
            return response()->json(['value' => "email sudah di pakai"]);
        } else {
            try {
                $pendaftar = new pendaftarModel;
                $pendaftar->email = $request->txtEmail;
                $pendaftar->username = $request->txtUsername;
                $pendaftar->nama = $request->txtNama;
                $pendaftar->alamat = $request->txtAlamat;
                $pendaftar->tglLahir = $request->dateTanggalLahir;
                $pendaftar->jenisKelamin = $request->cmbJenis;
                $pendaftar->namaOrtu = $request->txtNamaOrtu;
                $pendaftar->urlFoto = $request->urlFoto;
                $pendaftar->noHp = $request->txtNoTelp;
                $pendaftar->status = "menunggu";
                $pendaftar->save();

                $user = userModel::find($request->id);
                $user->isiFormulir = "sudah";
                $user->save();

                return response()->json(['value' => "success"]);
            } catch (\Exception $th) {
                return response()->json([
                    'value' => 'ada kesalahan input data, coba cek kembali data anda'

                ]);
            }
        }
    }

    public function apiSimpanPendaftaranAkun(Request $request)
    {

        $data = userModel::where('username', $request->txtUsername)->first();
        $data2 = userModel::where('email', $request->txtEmail)->first();

        if ($data != null) {
            return response()->json(['value' => "username sudah di pakai"]);
        } else if ($data2 != null) {
            return response()->json(['value' => "email sudah di pakai"]);
        } else {
            try {
                $pendaftar = new userModel;
                $pendaftar->email = $request->txtEmail;
                $pendaftar->username = $request->txtUsername;
                $pendaftar->password = Hash::make($request->txtPasswordUser);
                $pendaftar->save();


                return response()->json(['value' => "success"]);
            } catch (\Exception $th) {
                return response()->json([
                    'value' => $th

                ]);
            }
        }
    }

    public function apiUploadFoto()
    {
        $target_dir = "foto/";
        $target_file_name = $target_dir . basename($_FILES["file"]["name"]);
        $response = array();

        // Check if image file is an actual image or fake image
        if (isset($_FILES["file"])) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_name)) {
                $value = "success";
                $message = "Successfully Uploaded";
            } else {
                $value = "failed";
                $message = "Error while uploading";
            }
        } else {
            $value = "failed";
            $message = "Required Field Missing";
        }
        $response["value"] = $value;
        $response["message"] = $message;
        echo json_encode($response);
    }

    public function apiLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $getPendaftar = userModel::where('email', $email)->first();
        if ($getPendaftar != null) {
            $getPassword = $getPendaftar->password;
            $getNama = $getPendaftar->username;
            $getemail = $getPendaftar->email;
            $getId = $getPendaftar->id;
            $getIsiFormulir = $getPendaftar->isiFormulir;
            if (Hash::check($password, $getPassword)) {
                return response()->json(['password' => $getPassword, 'value' => 'sukses', 'id' => $getId, 'username' => $getNama, 'email' => $getemail, 'isiFormulir' => $getIsiFormulir]);
            } else {
                return response()->json(['password' => $getPassword, 'value' => 'gagal']);
            }
        } else {
            return response()->json(['value' => "user tidak terdaftar"]);
        }
    }

    public function cetakDataSiswa()
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml('');
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
