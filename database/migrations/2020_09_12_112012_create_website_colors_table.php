<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('theme_color')->nullable();
            $table->string('menu_color')->nullable();
            $table->string('footer_color')->nullable();
            $table->string('copyright_color')->nullable();
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
        Schema::dropIfExists('website_colors');
    }
}
