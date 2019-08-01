<?php

use Illuminate\Database\Seeder;
use App\Models\SearchPreferenceOption;

class SearchPreferenceOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('search_preference_options')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $options = [
            [
                'name'    => 'Music',
                'id_name' => 'Musik',
                'type'    => 'hobby'
            ],
            [
                'name'    => 'Movie',
                'id_name' => 'Film',
                'type'    => 'hobby'
            ],
            [
                'name'    => 'Reading',
                'id_name' => 'Membaca',
                'type'    => 'hobby'
            ],
            [
                'name'    => 'Travelling',
                'id_name' => 'Bepergian',
                'type'    => 'hobby'
            ],
            [
                'name'    => 'Sport & Outdoors',
                'id_name' => 'Olahraga',
                'type'    => 'hobby'
            ],
            [
                'name'    => 'Socializer',
                'id_name' => 'Bersosial',
                'type'    => 'lifestyle'
            ],
            [
                'name'    => 'Workaholic',
                'id_name' => 'Gila kerja',
                'type'    => 'lifestyle'
            ],
            [
                'name'    => 'Outdoor Enthusiast',
                'id_name' => 'Penyuka kegiatan luar ruangan',
                'type'    => 'lifestyle'
            ],
            [
                'name'    => 'Foodie',
                'id_name' => 'Suka makan',
                'type'    => 'lifestyle'
            ],
            [
                'name'    => 'Health Conscious',
                'id_name' => 'Sadar kesehatan',
                'type'    => 'lifestyle'
            ],
            [
                'name'    => 'Student',
                'id_name' => 'Siswa',
                'type'    => 'profession'
            ],
            [
                'name'    => 'Entrepreneur',
                'id_name' => 'Pengusaha',
                'type'    => 'profession'
            ],
            [
                'name'    => 'Civil Servant',
                'id_name' => 'Pegawai pemerintah',
                'type'    => 'profession'
            ],
            [
                'name'    => 'Employee',
                'id_name' => 'Karyawan',
                'type'    => 'profession'
            ],
            [
                'name'    => 'Freelancer',
                'id_name' => 'Paruh waktu',
                'type'    => 'profession'
            ],
            [
                'name'    => 'Retiree',
                'id_name' => 'Pensiunan',
                'type'    => 'profession'
            ]
        ];

        foreach ($options as $row) {
            SearchPreferenceOption::insert([
                'name'    => $row['name'],
                'id_name' => $row['id_name'],
                'type'    => $row['type']
            ]);
        }
    }
}
