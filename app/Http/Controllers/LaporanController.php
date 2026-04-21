<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // 🔹 HALAMAN LAPORAN MANAGER
    public function index()
    {
        $data = Pengajuan::with('nasabah','user')->get();

        return view('manager.laporan', compact('data'));
    }

    // 🔹 EXPORT PDF
    public function exportPDF()
{
    $data = Pengajuan::with('nasabah','user')->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('manager.laporan', compact('data'));

    return $pdf->download('laporan_kredit.pdf');
}

}
