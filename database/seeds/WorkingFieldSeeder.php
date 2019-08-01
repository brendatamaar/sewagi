<?php

use Illuminate\Database\Seeder;
use App\Models\WorkingField;

class WorkingFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('working_fields')->truncate();

        $array = [
            [
                'name'    => 'Computers and Technology',
                'id_name' => 'Komputer dan teknologi'
            ],
            [
                'name'    => 'Health Care and Allied Health',
                'id_name' => 'Perawatan kesehatan'
            ],
            [
                'name'    => 'Education and Social Services',
                'id_name' => 'Pendidikan dan layanan sosial'
            ],
            [
                'name'    => 'Arts and Communications',
                'id_name' => 'Seni dan komunikasi'
            ],
            [
                'name'    => 'Trades and Transportation',
                'id_name' => 'Perdagangan dan transportasi'
            ],
            [
                'name'    => 'Management, Business, and Finance',
                'id_name' => 'Manajemen, bisnis, dan keuangan'
            ],
            [
                'name'    => 'Architecture and Civil Engineering',
                'id_name' => 'Arsitektur dan teknik sipil'
            ],
            [
                'name'    => 'Science',
                'id_name' => 'Sains'
            ],
            [
                'name'    => 'Hospitality, Tourism, and the Service Industry',
                'id_name' => 'Perhotelan, pariwisata, dan industri jasa'
            ],
            [
                'name'    => 'Law and Law Enforcement',
                'id_name' => 'Hukum dan penegakan hukum'
            ]
        ];
        foreach ($array as $row) {
            WorkingField::create([
                'name'    => $row['name'],
                'id_name' => $row['id_name'],
            ]);
        }
    }
}
