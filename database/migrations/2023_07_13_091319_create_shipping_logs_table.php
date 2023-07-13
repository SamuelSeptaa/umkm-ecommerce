<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id');
            $table->enum('status', ['REQUESTED', 'ALLOCATED', 'PICKING_UP', 'PICKED', 'DROPPING_OFF', 'DELIVERED', 'CANCELLED']);
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
        Schema::dropIfExists('shipping_logs');
    }
}
