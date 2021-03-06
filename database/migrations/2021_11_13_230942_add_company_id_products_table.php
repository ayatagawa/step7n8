<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        // Schema::table('products', function (Blueprint $table) {
        //     $table->bigInteger('company_id');
        //     $table->foreign('company_id')
        //     ->references('id')
        //     ->on('companies')
        //     ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_company_id_foreign');
        });
    }
}
