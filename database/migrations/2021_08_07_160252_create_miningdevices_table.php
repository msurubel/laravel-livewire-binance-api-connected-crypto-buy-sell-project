<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiningdevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miningdevices', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('name');
            $table->string('cost_kwhs');
            $table->string('power_kwhs');
            $table->string('day_income');
            $table->string('power_khs');
            $table->string('buy_cost');
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
        Schema::dropIfExists('miningdevices');
    }
}
