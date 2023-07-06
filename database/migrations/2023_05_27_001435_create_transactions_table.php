<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id');
            $table->foreignId('shop_id');
            $table->string('transaction_code');
            $table->string('receipt_number');
            $table->enum('status', ['PAYMENT', 'PROCESSING', 'SHIPPED', 'DONE'])->default('PAYMENT');
            $table->integer('total_products');
            $table->float('sub_total');
            $table->float('voucher_discount');
            $table->float('shipping_fee');
            $table->float('total');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('shipping_method');
            $table->string('shipping_type');
            $table->string('waybill')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('payment_channel')->nullable();
            $table->enum('payment_status', ['PENDING', 'SETTLEMENT', 'FAILED', 'EXPIRE'])->default('PENDING');
            $table->timestamp('paid_date')->nullable();
            $table->string('payment_url')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
