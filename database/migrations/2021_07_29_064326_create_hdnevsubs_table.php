<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHdnevsubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hdnevsubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_id');
            $table->string('main_menu_id');
            $table->string('name');
            $table->string('link');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hdnevsubs');
    }
}
