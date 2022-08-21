<?php

use App\Models\PaymentInfo;
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
        Schema::create('payment_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('payment_method_id')->constrained()->cascadeOnDelete();
            $table->enum('status', [
                PaymentInfo::STATUS_PAID,
                PaymentInfo::STATUS_UNPAID,
                PaymentInfo::STATUS_PARTIAL,
            ])->default(PaymentInfo::STATUS_UNPAID);
            $table->decimal('payable', 12, 2);
            $table->decimal('due', 12, 2);
            $table->unsignedBigInteger('created_by');
            $table->dateTime('paid_at')->nullable();
            $table->text('product')->nullable();
            $table->text('comment')->nullable();

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
        Schema::dropIfExists('payment_infos');
    }
};
