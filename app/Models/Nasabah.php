<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $table = 'nasabah';

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'jenis_usaha',
        'lama_usaha',
        'status_pernikahan',
        'slik_status'
    ];

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
