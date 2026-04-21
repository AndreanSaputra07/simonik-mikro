<?php

namespace App\Services;

use App\Models\Pengajuan;
use App\Models\Realisasi;

class ReportingService
{
    public function summary()
    {
        return [
            'total_pengajuan' => Pengajuan::count(),
            'total_realisasi' => Realisasi::sum('nominal_disetujui'),
            'approved' => Pengajuan::where('status','diterima')->count()
        ];
    }
}
