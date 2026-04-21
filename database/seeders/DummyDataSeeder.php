<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengajuan;
use App\Models\Realisasi;
use App\Models\User;
use App\Models\Nasabah;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $marketings = User::where('role','marketing')->get();
        $analyst = User::where('role','analyst')->first();
        $nasabahs = Nasabah::all();

        $statuses = [
            'pending',
            'analisis',
            'survey',
            'diterima',
            'ditolak',
            'realisasi'
        ];

        for ($i = 1; $i <= 50; $i++) {

            $marketing = $marketings->random();
            $statusRandom = $statuses[array_rand($statuses)];

            // Nominal kelipatan 1 juta (000 semua)
            $jumlah = rand(10, 200) * 1000000;

            $pengajuan = Pengajuan::create([
                'user_id' => $marketing->id,
                'nasabah_id' => $nasabahs->random()->id,
                'jumlah' => $jumlah,
                'jenis_kredit' => ['KUR','KUM'][rand(0,1)],
                'status' => $statusRandom
            ]);

            // Jika status realisasi atau diterima → buat realisasi
            if (in_array($statusRandom, ['diterima','realisasi'])) {

                Realisasi::create([
                    'pengajuan_id'      => $pengajuan->id,
                    'analis_id'         => $analyst->id,
                    'tanggal_realisasi' => now()->subMonths(rand(0,11)),
                    'nominal_disetujui' => $jumlah
                ]);
            }
        }
    }
}
