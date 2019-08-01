<?php

use Illuminate\Database\Seeder;
use App\Models\PropertyAmenity;
use App\Models\Property;

class PropertyAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('property_amenities')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $faker = Faker\Factory::create();
        $propertyList = Property::all(); 
        foreach ($propertyList as $key => $value){
            for($i = 1 ; $i <= $faker->numberBetween($min = 1, $max = 12); $i++){
                PropertyAmenity::create([
                    'property_id' => $value->id,
                    'amenity_id' => ($i + 5)
                ]);
            }
        }
    }
}
