<?php

use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('amenities')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $arrayAmenity = [
            [
                'name' => 'Ensuite bathroom',
                'id_name' => 'Kamar mandi dalam',
                'entity' => 'bedroom',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Ensuite living room',
                'id_name' => 'Ruang keluarga dalam',
                'entity' => 'bedroom',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Walk-in closet',
                'id_name' => 'Lemari dinding',
                'entity' => 'bedroom',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Balcony',
                'id_name' => 'Balkon',
                'entity' => 'bedroom',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Ensuite kitchen',
                'id_name' => 'Dapur kecil',
                'entity' => 'bedroom',
                'type' => 'furnished',
                'icon' => ''
            ],
            [
                'name' => 'Deposit box',
                'id_name' => 'Brankas',
                'entity' => 'bedroom',
                'type' => 'furnished',
                'icon' => ''
            ],
            [
                'name' => 'TV',
                'id_name' => 'TV',
                'entity' => 'bedroom',
                'type' => 'furnished',
                'icon' => ''
            ],
            [
                'name' => 'Desk',
                'id_name' => 'Meja',
                'entity' => 'bedroom',
                'type' => 'furnished',
                'icon' => ''
            ],
            [
                'name' => 'Wi-fi enabled',
                'id_name' => 'Wi-fi',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'TV',
                'id_name' => 'TV',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Air conditioner',
                'id_name' => 'AC',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Deposit box',
                'id_name' => 'Brankas',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Fridge',
                'id_name' => 'Kulkas',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Dining Set',
                'id_name' => 'Perlengkapan makan',
                'entity' => 'property',
                'type' => 'furnished',
                'icon' => ''
            ],
            [
                'name' => 'Workspace',
                'id_name' => 'Ruang kerja',
                'entity' => 'property',
                'type' => 'furnished',
                'icon' => ''
            ],
            [
                'name' => 'Washing Machine',
                'id_name' => 'Mesin cuci',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Water heater',
                'id_name' => 'Pemanas air',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Dryer machine',
                'id_name' => 'Mesin pengering',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Cooking appliances',
                'id_name' => 'Alat masak',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Kitchen set',
                'id_name' => 'Perlengkapan dapur',
                'entity' => 'property',
                'type' => 'furnished',
                'icon' => ''
            ],
            [
                'name' => 'Dining set',
                'id_name' => 'Perlengkapan makan',
                'entity' => 'property',
                'type' => 'furnished',
                'icon' => ''
            ],
            [
                'name' => 'Water dispenser',
                'id_name' => 'Dispenser',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Linen set',
                'id_name' => 'Set selimut',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Bathtub',
                'id_name' => 'Bathtub',
                'entity' => 'property',
                'type' => 'unfurnished',
                'icon' => ''
            ],
            [
                'name' => 'Maid quarter',
                'id_name' => 'Kamar pembantu',
                'entity' => 'property',
                'type' => 'furnished',
                'icon' => ''
            ]
        ];

        foreach ($arrayAmenity as $row) {
            Amenity::insert([
                'name'    => $row['name'],
                'id_name' => $row['id_name'],
                'entity'  => $row['entity'],
                'type'    => $row['type'],
                'icon'    => $row['icon']
            ]);
        }
    }
}
