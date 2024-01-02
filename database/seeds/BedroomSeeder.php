<?php

use Illuminate\Database\Seeder;
use App\Models\Bedroom;
use App\Models\Property;

class BedroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('bedrooms')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // $faker = Faker\Factory::create();
        // $propertyList = Property::all();
        // foreach ($propertyList as $key => $value){
        //     if ($value->bedrooms == 3){
        //         Bedroom::create([
        //             'property_id'        => $value->id,
        //             'name'               => 'Bedroom 1',
        //             'type'               => $faker->randomElement(['master']),
        //             'size'               => $faker->numberBetween($min = 10, $max = 50),
        //             'quantity'           => 2,
        //             'quantity_available' => 2,
        //             'furniture'          => $faker->randomElement(['furnished', 'semi-furnished', 'unfurnished']),
        //             'is_loft'            => $faker->numberBetween($min = 0, $max = 1),
        //             'bed_arrangement'    => $faker->randomElement(['queen', 'king']),
        //         ]);
        //         Bedroom::create([
        //             'property_id'        => $value->id,
        //             'name'               => 'Bedroom 2',
        //             'type'               => $faker->randomElement(['master','standard', 'pocket']),
        //             'size'               => $faker->numberBetween($min = 10, $max = 30),
        //             'quantity'           => 2,
        //             'quantity_available' => 2,
        //             'furniture'          => $faker->randomElement(['furnished', 'semi-furnished', 'unfurnished']),
        //             'is_loft'            => $faker->numberBetween($min = 0, $max = 1),
        //             'bed_arrangement'    => $faker->randomElement(['twin','single', 'queen', 'king']),
        //         ]);
        //     }
        //     else{
        //         for($i = 0 ; $i < $value->bedrooms; $i++){
        //             Bedroom::create([
        //                 'property_id'        => $value->id,
        //                 'name'               => 'Bedroom 1',
        //                 'type'               => $faker->randomElement(['master','standard', 'pocket']),
        //                 'size'               => 48,
        //                 'quantity'           => 1,
        //                 'quantity_available' => 1,
        //                 'furniture'          => $faker->randomElement(['furnished', 'semi-furnished', 'unfurnished']),
        //                 'is_loft'            => $faker->numberBetween(0, 1),
        //                 'bed_arrangement'    => $faker->randomElement(['twin','single', 'queen', 'king']),
        //             ]);
        //         }
        //     }
        // }
    }
}
