<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLockedBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locked_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('symbol');
            $table->string('locked_amount');
            $table->string('profit');
            $table->string('locked_days');
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
        Schema::dropIfExists('locked_balances');
    }
}
