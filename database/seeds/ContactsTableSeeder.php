<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$i = DB::insert('INSERT INTO contacts (dataset_id, phone_num, name) SELECT 1, PhoneNum, PhoneName FROM seed_phonebook');
		return null;
    }
}
