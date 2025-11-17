<?php

namespace Database\Seeders;

use App\Models\Cid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(asset('utils/cid10.json'));
        $data = json_decode($json, true);
        foreach ($data as $item) {
            Cid::create([
                'code' => $item['codigo'],
                'name' => $item['nome'],
            ]);
        }
    }
}
