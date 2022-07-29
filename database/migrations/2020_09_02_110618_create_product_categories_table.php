<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('product_categories', function (Blueprint $table)
        {
        $table->foreign('parent_id')->references('id')->on('product_categories')->onUpdate('cascade')->onDelete('set null');
        });

    }

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
