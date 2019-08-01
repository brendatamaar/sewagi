<?php

use Illuminate\Database\Seeder;
use App\Models\BedroomVariant;
use App\Models\Bedroom;

class BedroomVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('bedroom_variants')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $faker = Faker\Factory::create();
        $bedroomList = Bedroom::all();
        foreach ($bedroomList as $key => $value){
            for($i = 0 ; $i < $value->quantity; $i++){
                if ($i > 1){
                    BedroomVariant::insert([
                        'bedroom_id' => $value->id,
                        'name' => ucwords($value->type) . ' ' . ($i + 1),
                        'is_active' => $faker->numberBetween($min = 0, $max = 1)
                    ]);
                }
                else{
                    BedroomVariant::insert([
                        'bedroom_id' => $value->id,
                        'name' => ucwords($value->type) . ' ' . ($i + 1),
                        'is_active' => 1
                    ]);
                }
            }
        }
    }
}
