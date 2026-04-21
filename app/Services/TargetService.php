<?php

namespace App\Services;

use App\Models\User;

class TargetService
{
    public function calculateAchievement($userId)
    {
        $user = User::find($userId);
        $total = $user->pengajuans()->sum('jumlah');

        $percentage = ($user->target > 0)
            ? ($total / $user->target) * 100
            : 0;

        return round($percentage,2);
    }
}
