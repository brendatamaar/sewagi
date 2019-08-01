<?php

use Illuminate\Database\Seeder;
use App\Models\PhotoType;

class PhotoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        PhotoType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $data = [
            ['name' => 'Building exterior', 'id_name' => 'Eksterior bangunan'],
            ['name' => 'Living room', 'id_name' => 'Ruang keluarga'],
            ['name' => 'Kitchen', 'id_name' => 'Dapur'],
            ['name' => 'Bathroom', 'id_name' => 'Kamar mandi'],
        ];
        PhotoType::insert($data);
    }
}
