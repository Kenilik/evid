<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $i = DB::insert('INSERT INTO items (dataset_id, item_type_id, date_time, is_init_by_target, is_duplicate, from_num, to_num, text_content) SELECT DatasetID, 1, DateTime, initByTarget, false as is_duplicate, FromNum, ToNum, TextMessage FROM seed_textitems');

        $i = DB::statement('INSERT INTO items(dataset_id, item_type_id, date_time, is_init_by_target, is_duplicate, from_num, to_num, call_duration) SELECT DatasetID, 2, DateTime, initByTarget, false as is_duplicate, FromNum, ToNum, Duration FROM seed_callitems');

        $i = DB::statement("UPDATE items JOIN contacts ON items.from_num = contacts.phone_num SET items.from_contact_id = contacts.id");

        $i = DB::statement("UPDATE items JOIN contacts ON items.to_num = contacts.phone_num SET items.to_contact_id = contacts.id");

        return null;
    }
}
