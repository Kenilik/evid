<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(InvestigationsTableSeeder::class);
    	$this->call(UsersTableSeeder::class);
    	$this->call(InvUsersTableSeeder::class);
    	$this->call(ItemTypesTableSeeder::class);
    	$this->call(DatasetsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        
    }
}
