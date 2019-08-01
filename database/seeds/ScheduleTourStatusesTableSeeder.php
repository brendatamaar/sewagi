<?php

use Illuminate\Database\Seeder;

class ScheduleTourStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('schedule_tour_statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $data = [
            [
                'id' => 1,
                'en_renter_status' => 'Awaiting confirmation',
                'id_renter_status' => 'Awaiting confirmation',
                'en_lister_status' => 'Property tour request',
                'id_lister_status' => 'Property tour request'
            ],
            [
                'id' => 2,
                'en_renter_status' => 'Tour confirmation delayed for 24 hours. Due to awaiting feedback from property lister.',
                'id_renter_status' => 'Tour confirmation delayed for 24 hours. Due to awaiting feedback from property lister.',
                'en_lister_status' => 'Property tour request',
                'id_lister_status' => 'Property tour request'
            ],
            [
                'id' => 3,
                'en_renter_status' => 'Confirmed',
                'id_renter_status' => 'Confirmed',
                'en_lister_status' => 'Confirmed',
                'id_lister_status' => 'Confirmed'
            ],
            [
                'id' => 4,
                'en_renter_status' => '[property] is no longer available.',
                'id_renter_status' => '[property] is no longer available.',
                'en_lister_status' => '[property] has been unpublished.',
                'id_lister_status' => '[property] has been unpublished.'
            ],
            [
                'id' => 5,
                'en_renter_status' => '[property] is not available for rent until [date].',
                'id_renter_status' => '[property] is not available for rent until [date].',
                'en_lister_status' => '[property] has been unpublished.',
                'id_lister_status' => '[property] has been unpublished.'
            ],
            [
                'id' => 6,
                'en_renter_status' => 'Awaiting confirmation',
                'id_renter_status' => 'Awaiting confirmation',
                'en_lister_status' => 'Awaiting confirmation',
                'id_lister_status' => 'Awaiting confirmation'
            ],
        ];

        DB::table('schedule_tour_statuses')->insert($data);
    }
}
