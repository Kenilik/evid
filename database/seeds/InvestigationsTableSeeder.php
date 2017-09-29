<?php

use Illuminate\Database\Seeder;

class InvestigationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('investigations')->insert([
	        'case_num' => "123456/1234",
	        'operation_name' => "EVIDENTIAL",
	        'description' => 'This is a test investigation to demonstrate the Evidentialiser features.',
	    ]);
        
        factory(App\Investigation::class, 10)->create();
     
    }
}
