<?php

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // Property::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        // $this->createApartment(25);
        // $this->createHouse(25);
    }

    public function createApartment($count)
    {
        $faker = Faker\Factory::create();
        for($i = 0 ; $i < $count; $i++){
            $latitude = $faker->latitude($min = -6.12, $max = -6.29);
            $longitude = $faker->latitude($min = 106.73, $max = 106.95);
            $response = GooglePlaces::nearbySearch($latitude . ', ' . $longitude, '100');
            $array = json_decode($response, true);
            $address= $response['results'][1]['vicinity'];
            $place_id = $response['results'][1]['place_id'];
            $place_detail = GooglePlaces::placeDetails($place_id);
            $administrative_area_level_1 = '';
            $administrative_area_level_2 = '';
            $administrative_area_level_3 = '';
            $administrative_area_level_4 = '';
            $postal_code = '';
            $total_room = $faker->numberBetween($min = 3, $max = 9);
            $rented_room = $faker->numberBetween($min = 0, $max = $total_room);
            $available_room = $total_room - $rented_room;
            foreach ($place_detail['result']['address_components'] as $key => $value){
                if ($value['types'][0] == 'administrative_area_level_1') {
                    $administrative_area_level_1 = $value['long_name'];
                }
                else if($value['types'][0] == 'administrative_area_level_2') {
                    $administrative_area_level_2 = $value['long_name'];
                }
                else if ($value['types'][0] == 'administrative_area_level_3') {
                    $administrative_area_level_3 = $value['long_name'];
                }
                else if ($value['types'][0] == 'administrative_area_level_4') {
                    $administrative_area_level_4 = $value['long_name'];
                }
                else if ($value['types'][0] == 'postal_code') {
                    $postal_code = $value['long_name'];
                }
            }

            $property = Property::create([
                'title'                  => $faker->company,
                'description'            => $faker->text($maxNbChars = 200),
                'type'                   => 'apartment',
                'unit_size'              => $faker->numberBetween($min = 100, $max = 300),
                'is_co_living'           => $faker->numberBetween($min = 0, $max = 1),
                'bedrooms'               => $faker->numberBetween($min = 1, $max = 3),
                'bathrooms'              => $faker->numberBetween($min = 1, $max = 2),
                'available_room'         => $available_room,
                'rented_room'            => $rented_room,
                'total_room'             => $total_room,
                'arrangement'            => $faker->randomElement($array = array ('townhouse','standalone')),
                'floor_range'            => $faker->randomElement($array = array ('below 5','beetween 5-10','above 10')),
                'is_pet_friendly'        => $faker->numberBetween($min = 0, $max = 1),
                'address'                => $address,
                'property_number'        => $faker->numberBetween($min = 1, $max = 100),
                'province'               => $administrative_area_level_1,
                'property_detail'        => $faker->text($maxNbChars = 200),
                'city'                   => $administrative_area_level_2,
                'district'               => $administrative_area_level_3,
                'village'                => $administrative_area_level_4,
                'postcode'               => $postal_code,
                'latitude'               => $latitude,
                'longitude'              => $longitude,
                'user_id'                => '1',
                'co_living_min_price'    => $faker->numberBetween($min = 1000, $max = 20000) * 1000,
                'entire_space_min_price' => $faker->numberBetween($min = 1000, $max = 20000) * 1000,
                'furniture'              => $faker->randomElement($array = array ('furnished','semi-furnished','unfurnished')),
                'belong_to'              => '1',
                'status'                 => $faker->numberBetween($min = 1, $max = 3),
                'is_insured'             => $faker->numberBetween($min = 0, $max = 1),
                'is_draft'               => 0,
                'approved_at'            => now()->toDateTimeString()
            ]);
        }
    }

    public function createHouse($count)
    {
        $faker = Faker\Factory::create();
        for($i = 0 ; $i < $count; $i++){
            $latitude = $faker->latitude($min = -6.12, $max = -6.29);
            $longitude = $faker->latitude($min = 106.73, $max = 106.95);
            $response = GooglePlaces::nearbySearch($latitude . ', ' . $longitude, '100');
            $array = json_decode($response, true);
            $address= $response['results'][1]['vicinity'];
            $place_id = $response['results'][1]['place_id'];
            $place_detail = GooglePlaces::placeDetails($place_id);
            $administrative_area_level_1 = '';
            $administrative_area_level_2 = '';
            $administrative_area_level_3 = '';
            $administrative_area_level_4 = '';
            $postal_code = '';
            $total_room = $faker->numberBetween($min = 3, $max = 9);
            $rented_room = $faker->numberBetween($min = 0, $max = $total_room);
            $available_room = $total_room - $rented_room;
            foreach ($place_detail['result']['address_components'] as $key => $value){
                if ($value['types'][0] == 'administrative_area_level_1') {
                    $administrative_area_level_1 = $value['long_name'];
                }
                else if($value['types'][0] == 'administrative_area_level_2') {
                    $administrative_area_level_2 = $value['long_name'];
                }
                else if ($value['types'][0] == 'administrative_area_level_3') {
                    $administrative_area_level_3 = $value['long_name'];
                }
                else if ($value['types'][0] == 'administrative_area_level_4') {
                    $administrative_area_level_4 = $value['long_name'];
                }
                else if ($value['types'][0] == 'postal_code') {
                    $postal_code = $value['long_name'];
                }
            }
            
            $property = Property::create([
                'title'                  => $faker->company,
                'description'            => $faker->text($maxNbChars = 200),
                'type'                   => 'house',
                'unit_size'              => $faker->numberBetween($min = 100, $max = 200),
                'building_size'          => $faker->numberBetween($min = 250, $max = 400),
                'is_co_living'           => $faker->numberBetween($min = 0, $max = 1),
                'is_entire_space'        => 1,
                'bedrooms'               => $faker->numberBetween($min = 1, $max = 5),
                'bathrooms'              => $faker->numberBetween($min = 1, $max = 2),
                'available_room'         => $available_room,
                'rented_room'            => $rented_room,
                'total_room'             => $total_room,
                'land_area_type'         => $faker->randomElement($array = array ('residential','non residential')),
                'arrangement'            => $faker->randomElement($array = array ('townhouse','standalone')),
                'is_pet_friendly'        => $faker->numberBetween($min = 0, $max = 1),
                'address'                => $address,
                'property_number'        => $faker->numberBetween($min = 1, $max = 100),
                'province'               => $administrative_area_level_1,
                'property_detail'        => $faker->text($maxNbChars = 200),
                'city'                   => $administrative_area_level_2,
                'district'               => $administrative_area_level_3,
                'village'                => $administrative_area_level_4,
                'postcode'               => $postal_code,
                'latitude'               => $latitude,
                'longitude'              => $longitude,
                'user_id'                => '1',
                'co_living_min_price'    => $faker->numberBetween($min = 1000, $max = 20000) * 1000,
                'entire_space_min_price' => $faker->numberBetween($min = 1000, $max = 20000) * 1000,
                'furniture'              => $faker->randomElement($array = array ('furnished','semi-furnished','unfurnished')),
                'belong_to'              => '1',
                'status'                 => $faker->numberBetween($min = 1, $max = 3),
                'is_insured'             => $faker->numberBetween($min = 0, $max = 1),
                'is_draft'               => 0,
                'approved_at'            => now()->toDateTimeString()
            ]);
        }
    }
}
