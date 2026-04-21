<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nasabah;

class NasabahSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $jenisUsaha = [
            'Warung Sembako',
            'Konveksi',
            'Kuliner',
            'Laundry',
            'Bengkel Motor',
            'Toko Elektronik',
            'Percetakan',
            'Peternakan Ayam',
            'Usaha Furniture',
            'Kedai Kopi'
        ];

        for ($i = 1; $i <= 50; $i++) {
            Nasabah::create([
                'nama' => $faker->name,
                'nik' => $faker->unique()->numerify('320#############'),
                'alamat' => $faker->address,
                'jenis_usaha' => $jenisUsaha[array_rand($jenisUsaha)],
                'lama_usaha' => rand(1, 10)
            ]);
        }
    }
}
