<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Nasabah;
use App\Models\ActivityLog;

class PengajuanController extends Controller
{
    public function create()
    {
        $nasabah = Nasabah::all();
        return view('marketing.pengajuan_create', compact('nasabah'));
    }

   public function store(Request $request)
{
    $request->validate([
        'jenis_kredit' => 'required|in:KUR,KUM',
        'jumlah' => 'required|numeric',
        'nasabah_id' => 'nullable|exists:nasabah,id',
        'nama_nasabah_baru' => 'nullable|string|max:255'
    ]);

    // ===== Cek apakah input nasabah baru =====
    if ($request->nama_nasabah_baru) {

        // Generate NIK otomatis (16 digit)
        $nik_baru = '320000' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);

        $nasabah = \App\Models\Nasabah::create([
            'nama' => $request->nama_nasabah_baru,
            'nik' => $nik_baru,
            'alamat' => 'Jl. Unknown',    // default, bisa diubah
            'jenis_usaha' => 'Umum',      // default, bisa diubah
            'lama_usaha' => 1             // default 1 tahun
        ]);

        $nasabah_id = $nasabah->id;

    } else {
        $nasabah_id = $request->nasabah_id;
    }

    // ===== Buat pengajuan =====
    $pengajuan = \App\Models\Pengajuan::create([
        'user_id' => auth()->id(),
        'nasabah_id' => $nasabah_id,
        'jenis_kredit' => $request->jenis_kredit,
        'jumlah' => $request->jumlah,
        'status' => 'pending'
    ]);

    // ===== Catat activity log =====
    \App\Models\ActivityLog::create([
        'user_id'=>auth()->id(),
        'aktivitas'=>'Menambahkan pengajuan ID '.$pengajuan->id
    ]);

    return redirect()->route('pengajuan.index')
        ->with('success', 'Pengajuan berhasil dibuat!');
}



    public function destroy($id)
    {
        Pengajuan::destroy($id);

        ActivityLog::create([
            'user_id'=>auth()->id(),
            'aktivitas'=>'Menghapus pengajuan ID '.$id
        ]);

        return back();
    }
    public function edit($id)
{
    $pengajuan = Pengajuan::findOrFail($id);
    return view('marketing.pengajuan_edit', compact('pengajuan'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'jumlah' => 'required|numeric',
    ]);

    $pengajuan = Pengajuan::findOrFail($id);
    $pengajuan->update([
        'jumlah' => $request->jumlah
    ]);

    ActivityLog::create([
        'user_id' => auth()->id(),
        'aktivitas' => 'Mengupdate pengajuan ID '.$pengajuan->id
    ]);

    return redirect()->route('pengajuan.index')->with('success','Pengajuan berhasil diupdate');
}
public function index()
{
    $user = auth()->user();

    // Ambil semua pengajuan marketing yang login
    $pengajuans = Pengajuan::where('user_id', $user->id)
        ->with('nasabah')
        ->get();

    return view('marketing.pengajuan_index', compact('pengajuans'));
}

}
