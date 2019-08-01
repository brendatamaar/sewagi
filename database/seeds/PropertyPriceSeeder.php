<?php

use Illuminate\Database\Seeder;
use App\Models\PropertyPrice;
use App\Models\Property;

class PropertyPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('property_prices')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $faker = Faker\Factory::create();
        $propertyList = Property::all(); 
        foreach ($propertyList as $key => $value){
            PropertyPrice::create([
                'property_id' => $value->id,
                'living_condition' => $faker->randomElement($array = array ('co-living','entire-space')),
                'is_include_internet' => $faker->numberBetween($min = 0, $max = 1),
                'is_include_park' => $faker->numberBetween($min = 0, $max = 1),
                'is_include_tv_cable' => $faker->numberBetween($min = 0, $max = 1),
                'service_fee' => $faker->numberBetween($min = 1000, $max = 20000) * 1000
            ]);
        }
    }
}
