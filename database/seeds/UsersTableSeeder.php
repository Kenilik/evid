<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
	        'name' => "Shayne Precious",
	        'email' => "shayne@kenilik.com",
	        'qid' => 'SPBO60',
	        'password' => bcrypt('precious'),
	    ]);

        factory(App\User::class, 20)->create();
    }
}