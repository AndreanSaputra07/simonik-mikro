<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TargetMarketing extends Model
{
    protected $table = 'target_marketings';

    protected $fillable = [
        'user_id',
        'target_nominal',
        'tahun'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}