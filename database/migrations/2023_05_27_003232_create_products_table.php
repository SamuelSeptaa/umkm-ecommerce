<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('shop_id');
            $table->string('product_name');
            $table->text('image_url');
            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->float('discount')->nullable();
            $table->integer('stock');
            $table->integer('total_sold')->nullable();
            $table->enum('status', ['DRAFT', 'PUBLISH'])->default('PUBLISH');
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
