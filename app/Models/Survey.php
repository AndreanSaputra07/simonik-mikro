<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
    'pengajuan_id',
    'hasil_survey',
    'tanggal_survey'
];


    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
