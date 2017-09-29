<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('dataset_id')->nullable()->unsigned();
            $table->integer('item_type_id')->unsigned();
            $table->bigInteger('item_no')->unsigned()->nullable();
            $table->boolean('is_init_by_target')->nullable();
            $table->integer('from_contact_id')->nullable()->unsigned();
            $table->integer('to_contact_id')->nullable()->unsigned();
            $table->dateTime('date_time');
            $table->string('from_num')->nullable();
            $table->string('to_num')->nullable();
            $table->string('text_content')->nullable();
            $table->integer('call_duration')->nullable()->unsigned();
            $table->text('task_description')->nullable();
            $table->boolean('is_duplicate')->default(false);
            $table->boolean('is_graded')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            //index definitions
            $table->foreign('dataset_id')->references('id')->on('datasets');
            $table->foreign('item_type_id')->references('id')->on('itemtypes');
            $table->foreign('from_contact_id')->references('id')->on('contacts');
            $table->foreign('to_contact_id')->references('id')->on('contacts');
            $table->unique(['dataset_id', 'item_no']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
