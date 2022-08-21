<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            // $table->foreign('product_category_id')
            //     ->references('id')
            //     ->on('product_categories')
            //     ->onDelete('cascade');
            $table->foreignId('product_category_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('product_name');
            $table->unsignedBigInteger('sku');
            $table->string('thumbnail')->nullable();
            $table->unsignedDecimal('mrp');
            $table->unsignedInteger('qty');
            $table->bigInteger('created_by');
            $table->dateTime('mfg_date')->nullable();
            $table->dateTime('exp_date')->nullable();
            $table->timestampsTz();
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
};
