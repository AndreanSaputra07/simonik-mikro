<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'target'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }

    public function analisPengajuans()
    {
        return $this->hasMany(Analisis::class, 'analis_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
