<?php

use Illuminate\Database\Seeder;
use App\Models\AdditionalPhotoType;

class AdditionalPhotoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        AdditionalPhotoType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $data = [
            ['name' => 'Office room', 'id_name' => 'Ruang kerja'],
            ['name' => 'Laundry room', 'id_name' => 'Binatu'],
            ['name' => 'Parking and Garage', 'id_name' => 'Parkir dan garasi'],
            ['name' => 'Indoor facilities', 'id_name' => 'Fasilitas dalam ruangan'],
            ['name' => 'Outdoor facilities', 'id_name' => 'Fasilitas luar ruangan'],
            ['name' => 'Neighborhood', 'id_name' => 'Lingkungan'],
            ['name' => 'Other', 'id_name' => 'Lainnya'],
        ];
        AdditionalPhotoType::insert($data);
    }
}
