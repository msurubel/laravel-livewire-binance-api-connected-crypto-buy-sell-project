<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad_image');
            $table->string('hilight_text');
            $table->string('headline');
            $table->string('body_text');
            $table->string('background_image');
            $table->string('button_show');
            $table->string('button_link');
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
        Schema::dropIfExists('siteads');
    }
}
