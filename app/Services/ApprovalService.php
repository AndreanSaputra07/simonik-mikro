<?php

namespace App\Services;

use App\Models\Pengajuan;

class ApprovalService
{
    public function approve($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update(['status'=>'diterima']);
    }

    public function reject($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update(['status'=>'ditolak']);
    }
}
