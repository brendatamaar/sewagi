<?php

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('facilities')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $arrayFacility = [
            [
                'name'    => '24 hrs security',
                'id_name' => 'Keamanan 24 jam',
                'icon'    => ''
            ],
            [
                'name'    => 'Pool',
                'id_name' => 'Kolam renang',
                'icon'    => ''
            ],
            [
                'name'    => 'Garden',
                'id_name' => 'Taman',
                'icon'    => ''
            ],
            [
                'name'    => 'Laundry',
                'id_name' => 'Binatu',
                'icon'    => ''
            ],
            [
                'name'    => 'Gym',
                'id_name' => 'Gym',
                'icon'    => ''
            ],
            [
                'name'    => 'Parking space',
                'id_name' => 'Area parkir',
                'icon'    => ''
            ],
            [
                'name'    => 'Shopping mall',
                'id_name' => 'Pusat perbelanjaan',
                'icon'    => ''
            ],
            [
                'name'    => 'Nursery / Kindergarten',
                'id_name' => 'Penitipan anak / TK',
                'icon'    => ''
            ],
            [
                'name'    => 'Business center / Co-working space',
                'id_name' => 'Pusat Bisnis',
                'icon'    => ''
            ],
            [
                'name'    => 'Sport court',
                'id_name' => 'Lapangan olahraga',
                'icon'    => ''
            ],
            [
                'name'    => 'Mini mart',
                'id_name' => 'Minimarket',
                'icon'    => ''
            ],
            [
                'name'    => 'Multi function hall',
                'id_name' => 'Aula',
                'icon'    => ''
            ],
            [
                'name'    => 'Concierge',
                'id_name' => 'Porter',
                'icon'    => ''
            ],
            [
                'name'    => 'Playground',
                'id_name' => 'Taman bermain',
                'icon'    => ''
            ]
        ];

        foreach ($arrayFacility as $row) {
            Facility::insert([
                'name'    => $row['name'],
                'id_name' => $row['id_name'],
                'icon'    => $row['icon']
            ]);
        }
    }
}
