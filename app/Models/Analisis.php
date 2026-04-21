<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    protected $table = 'analisis'; // 🔥 TAMBAHKAN INI

    protected $fillable = [
    'pengajuan_id',
    'analis_id',
    'rekomendasi',
    'hasil_analisis'
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
