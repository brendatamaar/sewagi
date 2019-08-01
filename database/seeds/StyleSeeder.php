<?php

use Illuminate\Database\Seeder;
use App\Models\Style;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('styles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $arrayStyle = [
            [
                'name'    => 'Industrial',
                'id_name' => 'Industrial',
                'image'   => ''
            ],
            [
                'name'    => 'Minimalist',
                'id_name' => 'Minimalis',
                'image'   => ''
            ],
            [
                'name'    => 'Contemporary',
                'id_name' => 'Kontemporer',
                'image'   => ''
            ],
            [
                'name'    => 'Vintage',
                'id_name' => 'Antik',
                'image'   => ''
            ],
            [
                'name'    => 'Traditional',
                'id_name' => 'Tradisional',
                'image'   => ''
            ],
            [
                'name'    => 'Scandinavian',
                'id_name' => 'Skandinavia',
                'image'   => ''
            ],
            [
                'name'    => 'Coastal',
                'id_name' => 'Pesisir',
                'image'   => ''
            ],
            [
                'name'    => 'Unconventional',
                'id_name' => 'Inkonvensional',
                'image'   => ''
            ]
        ];
        
        foreach ($arrayStyle as $row) {
            Style::insert([
                'name'    => $row['name'],
                'id_name' => $row['id_name'],
                'image'   => $row['image']
            ]);
        }
    }
}
