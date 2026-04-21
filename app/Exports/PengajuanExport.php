<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengajuanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pengajuan::with('nasabah','user')
            ->get()
            ->map(function($p){
                return [
                    'Nama Nasabah' => $p->nasabah->nama,
                    'Marketing' => $p->user->name,
                    'Jumlah' => $p->jumlah,
                    'Status' => $p->status,
                    'Tanggal' => $p->created_at->format('Y-m-d')
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Nasabah',
            'Marketing',
            'Jumlah',
            'Status',
            'Tanggal'
        ];
    }
}
