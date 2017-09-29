<?php

use Illuminate\Database\Seeder;

class InvUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('inv_users')->insert([
	        'investigation_id' => 1,
	        'user_id' => 1,
    	]);

        factory(App\InvUser::class, 10)->create();
    }
}
