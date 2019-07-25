<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Master\pendaftarModel;

class pdfmaker extends Controller
{
    //
    public function cetakDataSiswa($id)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataSiswa($id));
        return $pdf->stream();
    }

    public function dataSiswa($id)
    {

        $siswa = pendaftarModel::where('id', $id)->first();
        return view('admin.laporan.pdfsiswa')->with('siswa', $siswa);
    }

    public function cetakLapSiswa()
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataLapSiswa());
        return $pdf->stream();
    }

    public function dataLapSiswa()
    {

        $siswa = pendaftarModel::all();
        return view('admin.laporan.pdflapsiswa')->with('siswa', $siswa);
    }
}
