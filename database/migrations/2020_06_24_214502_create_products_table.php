<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('childcategory_id')->nullable();
            $table->string('image')->nullable();
            $table->string('photos')->nullable();
            $table->string('name')->nullable();
            $table->string('prev_price')->nullable();
            $table->string('price')->nullable();
            $table->longText('description')->nullable();
            $table->longText('policy')->nullable();
            $table->string('views')->nullable();
            $table->string('stock')->nullable();
            $table->string('condition')->nullable();
            $table->string('slug')->nullable();
            $table->string('status')->nullable();
            $table->string('deals')->nullable();
            $table->string('featured')->nullable();
            $table->string('trending')->nullable();
            $table->string('new')->nullable();
            $table->string('top')->nullable();
            $table->string('flash')->nullable();
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
        Schema::dropIfExists('products');
    }
}
