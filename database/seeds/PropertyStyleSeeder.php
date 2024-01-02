<?php

use Illuminate\Database\Seeder;
use App\Models\PropertyStyle;
use App\Models\Property;

class PropertyStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('property_styles')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // $faker = Faker\Factory::create();
        // $propertyList = Property::all(); 
        // foreach ($propertyList as $key => $value){
        //     for($i = 0 ; $i < $faker->numberBetween($min = 1, $max = 2); $i++){
        //         PropertyStyle::create([
        //             'property_id' => $value->id,
        //             'style_id' => $faker->numberBetween($min = 1, $max = 8)
        //         ]);
        //     }
        // }
    }
}
