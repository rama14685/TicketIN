<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Konser Musik',
            'Festival',
            'Jazz',
            'Pop',
            'Rock',
        ];

        foreach ($data as $nama) {
            Kategori::create([
                'nama' => $nama,
            ]);
        }
    }
}
