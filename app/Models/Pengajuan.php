<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $fillable = [
        'user_id',
        'nasabah_id',
        'jenis_kredit',
        'jumlah',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function survey()
    {
        return $this->hasOne(Survey::class);
    }

    public function analisis()
    {
        return $this->hasOne(Analisis::class);
    }

    public function realisasi()
    {
        return $this->hasOne(Realisasi::class);
    }
}
