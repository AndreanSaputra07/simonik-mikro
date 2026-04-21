<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $table = 'realisasi';

    protected $fillable = [
        'pengajuan_id',
        'analis_id',
        'tanggal_realisasi',
        'nominal_disetujui'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function analis()
    {
        return $this->belongsTo(User::class, 'analis_id');
    }
}
