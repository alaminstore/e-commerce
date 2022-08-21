<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_code');
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->enum('status', [
                Order::STATUS_PROCESSING,
                Order::STATUS_APPROVED,
                Order::STATUS_ON_SHIPPING,
                Order::STATUS_SHIPPED,
                Order::STATUS_RETURN,
                Order::STATUS_COMPLETE,
            ])->default(Order::STATUS_PROCESSING);
            $table->unsignedInteger('ordered_qty');
            $table->unsignedInteger('payment_info_id');
            $table->unsignedInteger('total_price');
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('created_by');
            $table->string('store_name');
            $table->string('brands');
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
        Schema::dropIfExists('orders');
    }
};
