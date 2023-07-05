<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id');
            $table->foreignId('voucher_id');
            $table->foreignId('transaction_id');
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
        Schema::dropIfExists('voucher_logs');
    }
}
