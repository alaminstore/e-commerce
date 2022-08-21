<?php

use App\Models\PaymentMethod;
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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('payment_method');
            // or
            $table->enum('payment_method', [
                PaymentMethod::METHOD_CASH_ON_DELIVERY,
                PaymentMethod::METHOD_BIKASH,
                PaymentMethod::METHOD_SSL_COMMERCE,
                PaymentMethod::METHOD_NAGAD,
            ])->default(PaymentMethod::METHOD_CASH_ON_DELIVERY);
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
        Schema::dropIfExists('payment_methods');
    }
};
