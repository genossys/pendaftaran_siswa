<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Master\informasiModel;
use Illuminate\Support\Facades\Validator;

class informasiControl extends Controller
{
    //
    public function index()
    {
        return view('admin/master/datainformasi');
    }

    public function getDataInformasi()
    {
        $informasi = informasiModel::query()
            ->select('id','judul', 'isi', 'tanggal')
            ->get();

        return DataTables::of($informasi)
            ->addIndexColumn()
            ->addColumn('action', function ($informasi) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditModal(\'' . $informasi->id . '\', event)" ><i class="fa fa-edit"></i></a>
                                    <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="deleteData(\'' . $informasi->id . '\')" ><i class="fa fa-trash"></i></a>
                                    <a class="btn-sm btn-info details-control" id="btn-detail" href="#"><i class="fa fa-folder-open"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Field :attribute Maksimal :max',
        ];

        $rules = [
            'txtJudulInfo' => 'required|max:25',
            'txtIsiInfo' => 'required|max:191',

        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function insert(Request $r)
    {

        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all(),
            ]);
        } else {
            try {
                $informasi = new informasiModel;
                $informasi->judul = $r->txtJudulInfo;
                $informasi->isi = $r->txtIsiInfo;
                $informasi->tanggal = date('Y-m-d');
                $informasi->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $informasi,
                ]);
            } catch (\Exception $th) {
                //throw $th;
                $exData = explode('(', $th->getMessage());
                return response()->json([
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
            $id = $r->txtId;
            $data = [
                'judul' => $r->txtJudul,
                'isi' => $r->txtIsi,
            ];
            try {
                informasiModel::query()
                    ->where('id', '=', $id)
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

    public function deleteData(Request $r)
    {
        $id = $r->id;
        $hapusInfo = informasiModel::find($id);
        $hapusInfo->delete();
    }

    public function showInformasi()
    {
        $info = informasiModel::orderby('created_at', 'desc')
            ->get();

        return view('umum.informasi')->with('info', $info);
    }
}
