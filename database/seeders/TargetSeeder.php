<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TargetSeeder extends Seeder
{
    public function run(): void
    {
        $marketings = User::where('role','marketing')->get();

        foreach ($marketings as $marketing) {

            // Kelipatan 50 juta biar rapi
            $target = rand(10,20) * 50000000; 
            // 10 x 50jt = 500jt
            // 20 x 50jt = 1M

            DB::table('target_marketings')->insert([
                'user_id' => $marketing->id,
                'target_nominal' => $target,
                'tahun' => 2026,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
