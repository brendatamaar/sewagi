<?php

use Illuminate\Database\Seeder;
use App\Models\BedroomAmenity;
use App\Models\Bedroom;

class BedroomAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // DB::table('bedroom_amenities')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // $faker = Faker\Factory::create();
        // $bedroomList = Bedroom::all(); 
        // foreach ($bedroomList as $key => $value){
        //     for($i = 1 ; $i <= $faker->numberBetween($min = 1, $max = 4); $i++){
        //         BedroomAmenity::create([
        //             'bedroom_id' => $value->id,
        //             'amenity_id' => $i
        //         ]);
        //     }
        // }
    }
}
