<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountriesTableSeeder::class,
            LaratrustSeeder::class,
            PageTitleSeeder::class,
            WorkingFieldSeeder::class,
            PropertySeeder::class,
            BedroomSeeder::class,
            BedroomVariantSeeder::class,
            AmenitySeeder::class,
            BedroomAmenitySeeder::class,
            FacilitySeeder::class,
            StyleSeeder::class,
            PropertyAmenitySeeder::class,
            PropertyFacilitySeeder::class,
            PropertyStyleSeeder::class,
            PropertyPriceSeeder::class,
            PhotoTypeSeeder::class,
            SearchPreferenceOptionSeeder::class,
            LanguageSeeder::class,
            ScheduleTourStatusesTableSeeder::class
        ]);
    }
}
