<?php

use Illuminate\Database\Seeder;

class DatasetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('datasets')->insert([
	    	'investigation_id' => "1",
            'description' => "Production Order 1",
            'target_num' => "64220226477",
            'target_name' => "Josephine SMITH",
	    ]);

        DB::table('datasets')->insert([
            'investigation_id' => "1",
            'description' => "Production Order 2",
            'target_num' => "64220226477",
            'target_name' => "Josephine SMITH",
        ]);
    }
}
