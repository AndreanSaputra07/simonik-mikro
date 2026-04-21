<?php

namespace App\Services;

use App\Models\Pengajuan;

class StatistikService
{
    public function totalPengajuan()
    {
        return Pengajuan::count();
    }

    public function totalDisetujui()
    {
        return Pengajuan::where('status','diterima')->count();
    }

    public function totalDitolak()
    {
        return Pengajuan::where('status','ditolak')->count();
    }
}
