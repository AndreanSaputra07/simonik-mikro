<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realisasi;
use App\Models\Pengajuan;

class RealisasiController extends Controller
{
   public function index()
{
    $pengajuans = Pengajuan::whereIn('status', ['realisasi','pencairan'])
        ->with('nasabah','user')
        ->get();

    return view('analyst.realisasi_list', compact('pengajuans'));
}



    public function store(Request $request)
    {
        Realisasi::create([
            'pengajuan_id' => $request->pengajuan_id,
            'analis_id' => auth()->id(),
            'tanggal_realisasi' => $request->tanggal_realisasi,
            'nominal_disetujui' => $request->nominal_disetujui
        ]);

        Pengajuan::where('id',$request->pengajuan_id)
            ->update(['status'=>'realisasi']);

        return back()->with('success','Realisasi berhasil dilakukan');
    }

    // 🔥 Tambahkan method ini supaya tombol Proses Realisasi bisa langsung jalan
   public function proses($id)
{
    Pengajuan::where('id', $id)
        ->update(['status' => 'pencairan']);

    return redirect()->route('analyst.realisasi')
        ->with('success', 'Masuk tahap pencairan!');
}


}
