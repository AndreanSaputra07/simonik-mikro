<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Pengajuan;

class SurveyController extends Controller
{
    // =============================
    // LIST DATA UNTUK SURVEY
    // =============================
    public function index()
    {
        $pengajuans = Pengajuan::where('status','survey')
            ->with('nasabah','user')
            ->get();

        return view('analyst.survey_list', compact('pengajuans'));
    }

    // =============================
    // FORM SURVEY (INI YANG KURANG)
    // =============================
    public function create($id)
    {
        $pengajuan = Pengajuan::with('nasabah','user')
            ->findOrFail($id);

        return view('analyst.survey_form', compact('pengajuan'));
    }

    // =============================
    // SIMPAN SURVEY
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'pengajuan_id' => 'required',
            'hasil_survey' => 'required',
            'keputusan'    => 'required'
        ]);

        Survey::create([
    'pengajuan_id'   => $request->pengajuan_id,
    'hasil_survey'   => $request->hasil_survey,
    'tanggal_survey' => now(), // 🔥 ini penting
]);


        if($request->keputusan == 'lolos'){
            Pengajuan::where('id',$request->pengajuan_id)
                ->update(['status'=>'realisasi']);
        } else {
            Pengajuan::where('id',$request->pengajuan_id)
                ->update(['status'=>'ditolak']);
        }

        return redirect()
            ->route('analyst.survey')
            ->with('success','Survey berhasil diproses');
    }
}
