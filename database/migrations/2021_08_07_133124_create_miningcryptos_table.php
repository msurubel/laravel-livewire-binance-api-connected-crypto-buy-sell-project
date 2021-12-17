<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiningcryptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miningcryptos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('name');
            $table->string('symbol');
            $table->string('minig_balance');
            $table->string('minig_balance_usd');
            $table->string('mining_power');
            $table->string('day_income');
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
        Schema::dropIfExists('miningcryptos');
    }
}
