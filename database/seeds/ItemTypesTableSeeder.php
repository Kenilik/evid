<?php

use Illuminate\Database\Seeder;

class ItemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_types')->insert([
        	'id' => 1,
	        'name' => "Cellular SMS",
	        'description' => "Text message sent or received via the cellular network.",
	    ]);

        DB::table('item_types')->insert([
        	'id' => 2,
	        'name' => "Cellular Voice Call",
	        'description' => "Voice call made or received via the cellular network.",
        ]);
    }
}
