<?php

use Illuminate\Database\Seeder;
use App\Models\Locale;

class LocaleSeeder extends Seeder
{
    public function __construct()
    {
        $this->table = 'locales';
        $this->filename = base_path('database/seeds/locales.csv');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($this->table)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $seedData = $this->seedFromCSV($this->filename, '|');
        $seedData = array_chunk($seedData, 50, true);
        foreach ($seedData as $key => $value) {
            Locale::insert($value);
        }
        DB::commit();
    }

    private function seedFromCSV($filename, $delimitor = "|")
    {
        if(!file_exists($filename) || !is_readable($filename))
        {
            return FALSE;
        }

        $header = NULL;
        $data = array();

        if(($handle = fopen($filename, 'r')) !== FALSE)
        {
            while(($row = fgetcsv($handle, 2000, $delimitor)) !== FALSE)
            {
                if(!$header) {
                    $header = $row;
                } else {
                    $temp = array_combine($header, $row);
                    $temp['created_at'] = date("Y-m-d H:i:s");
                    $temp['updated_at'] = date("Y-m-d H:i:s");
                    $data[] = $temp;
                }
            }
            fclose($handle);
        }

        return $data;
    }
}
