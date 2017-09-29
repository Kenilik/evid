<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('inv_users', function (Blueprint $table) 
         {
            $table->increments('id');
            $table->integer('investigation_id');
            $table->integer('user_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            //index definitions
            $table->unique(['investigation_id', 'user_id']);
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_users');
    }
}
