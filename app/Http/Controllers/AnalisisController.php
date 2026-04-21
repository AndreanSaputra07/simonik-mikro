<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Analisis;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    // =========================
    // LIST UNTUK ANALISIS
    // =========================
    public function analisisList()
    {
        $pengajuans = Pengajuan::where('status','pending')
            ->with('nasabah','user')
            ->get();

        return view('analyst.analisis_list', compact('pengajuans'));
    }

    // =========================
    // FORM ANALISIS
    // =========================
    public function create($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        return view('analyst.analisis', compact('pengajuan'));
    }

    // =========================
    // SIMPAN ANALISIS
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'rekomendasi' => 'required',
            'hasil_analisis' => 'required'
        ]);

        Analisis::create([
            'pengajuan_id' => $request->pengajuan_id,
            'analis_id' => auth()->id(),
            'rekomendasi' => $request->rekomendasi,
            'hasil_analisis' => $request->hasil_analisis
        ]);

        // UBAH STATUS KE "analisis"
        Pengajuan::where('id',$request->pengajuan_id)
            ->update(['status'=>'analisis']);

        return redirect()
            ->route('analyst.analisis')
            ->with('success','Pengajuan berhasil dianalisis');
    }

    // =========================
    // LIST SETELAH ANALISIS
    // =========================
    public function approvalList()
    {
        $pengajuans = Pengajuan::where('status','analisis')
            ->with('nasabah','user')
            ->get();

        return view('analyst.approval_list', compact('pengajuans'));
    }

    // =========================
    // APPROVE → MASUK SURVEY
    // =========================
    public function approve($id)
    {
        Pengajuan::findOrFail($id)
            ->update(['status'=>'survey']);

        return back()->with('success','Pengajuan disetujui & masuk tahap survey');
    }
public function proses($id)
{
    // Update status pengajuan menjadi selesai
    Pengajuan::where('id', $id)
        ->update(['status' => 'selesai']);

    // Optional: buat log atau tindakan lain di sini

    return redirect()->route('analyst.realisasi')
        ->with('success', 'Realisasi berhasil diproses!');
}

    // =========================
    // REJECT
    // =========================
    public function reject($id)
    {
        Pengajuan::findOrFail($id)
            ->update(['status'=>'ditolak']);

        return back()->with('success','Pengajuan ditolak');
    }
}
