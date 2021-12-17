<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyminingdevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyminingdevices', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('order_ref');
            $table->string('user_id');           
            $table->string('name');
            $table->string('symbol_for');
            $table->string('cost_kwhs');
            $table->string('power_kwhs');
            $table->string('day_income');
            $table->string('power_khs');
            $table->string('quantity');
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
        Schema::dropIfExists('buyminingdevices');
    }
}
