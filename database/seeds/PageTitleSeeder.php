<?php

use Illuminate\Database\Seeder;
use App\Models\PageTitle;

class PageTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_titles')->truncate();

        $arrayTitle = [
            /* Homepage */
            [
                'title' => '<span class="text-color-orange">Find home on your terms,</span><br>
                            <span class="text-color-dark">& list your property for free.</span>',
                'id' => '<span class="text-color-orange">Tentukan rumah sesuai kriteria Anda</span>
                            <span class="text-color-dark">& iklankan properti Anda dengan secara gratis.</span>',
                'page'     => 'homepage'
            ],
            [
                'title' => '<span class="text-color-dark">Need more rental flexibility?</span><br>
                            <span class="text-color-orange">Discover Co-Living.</span>',
                'id' => '<span class="text-color-dark">Butuh penyewaan yang lebih fleksibel?</span><br>
                            <span class="text-color-orange">Jelajahi Hunian Bersama.</span>',
                'page' => 'homepage'
            ],
            [
                'title' => '<span class="text-color-dark">Rent what you love!</span><br>
                            <span class="text-color-orange">Flexible stays and Co-Living.</span>',
                'id' => '<span class="text-color-dark">Sewa yang kamu suka!</span><br>
                            <span class="text-color-orange">Tinggal secara fleksibel dan bersama-sama.</span>',
                'page' => 'homepage'
            ],

            /* Housemate */
            [
                'title' => '<span class="text-color-orange">Find the adequate housemate,</span>
                                <span class="text-color-dark">& only share a success fee.</span>',
                'id' => '<span class="text-color-orange">Iklankan secara gratis, temukan teman serumah </span>
                                <span class="text-color-dark">& dan bayar saat berhasil.</span>',
                'page'     => 'property-lister-housemate'
            ],

            /* Homeowner */
            [
                'title' => '<span class="text-color-dark">Want to grow your income?</span><br>
                            <span class="text-color-orange">List your property with us.</span>',
                'id' => '<span class="text-color-dark">Ingin menaikkan pendapatanmu?</span><br>
                            <span class="text-color-orange">Sewakan properti Anda dengan kami.</span>',
                'page'     => 'property-lister-homeowner'
            ],
            [
                'title' => '<span class="text-color-dark">Discover Co-Living</span>'.
                            '<span class="text-color-orange">and give your<br>property the edge.</span>',
                'id' => '<span class="text-color-dark">Jelajahi Hunian Bersama</span>'.
                            '<span class="text-color-orange">dan berikan<br>properti Anda keunggulan.</span>',
                'page'     => 'property-lister-homeowner'
            ],

            /* Property Agent */
            [
                'title' => '<span class="text-color-dark">Grow your income</span>' .
                                '<span class="text-color-orange"> by listing<br>your properties with us for free.</span>',
                'id' => '<span class="text-color-dark">Tingkatkan penghasilan Anda</span>' .
                                '<span class="text-color-orange"> dengan mendaftarkan<br>property Anda dengan kami. Gratis!</span>',
                'page'     => 'property-lister-property-agent'
            ],
            [
                'title' => '<span class="text-color-dark">A co-brokerage platform giving you</span>
                                <span class="text-color-orange">qualified leads to make more deals!</span>',
                'id' => '<span class="text-color-dark">Platform co-broker memberikan Anda</span>
                                <span class="text-color-orange">prospek potensial untuk meningkatkan penghasilan Anda!</span>',
                'page'     => 'property-lister-property-agent'
            ],

            /* Building Management */
            [
                'title' => '<span class="text-color-dark">Grow your income</span>' .
                                '<span class="text-color-orange"> by listing<br>your property inventory with us for free.</span>',
                'id' => '<span class="text-color-dark">Tingkatkan penghasilan Anda</span>' .
                                '<span class="text-color-orange"> dengan mengiklankan<br>property Anda bersama kami. Gratis!</span>',
                'page'     => 'property-lister-building-management'
            ],
            [
                'title' => '<span class="text-color-dark">A co-brokerage platform giving you</span>
                                <span class="text-color-orange">qualified leads to make more deals!</span>',
                'id' => '<span class="text-color-dark">Platform co-broker memberikan Anda</span>
                                <span class="text-color-orange">prospek potensial untuk meningkatkan penghasilan Anda!</span>',
                'page'     => 'property-lister-building-management'
            ],
        ];
        foreach ($arrayTitle as $row) {
            PageTitle::create([
                'en_title' => $row['title'],
                'id_title' => $row['id'],
                'page'     => $row['page'],
            ]);
        }
    }
}
