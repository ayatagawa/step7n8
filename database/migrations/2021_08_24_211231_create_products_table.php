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
        if (!Schema::hasTable('products')) {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('company_id');
            $table->string('product_name');
            $table->integer('price');
            $table->integer('stock');
            $table->text('comment');
            $table->timestamps();
            // $table->foreign('company_id')
            // ->references('id')
            // ->on('companies')
            // ->onDelete('cascade');
            });
        }
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
