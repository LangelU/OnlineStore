<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('saleNumber');
            $table->bigInteger('amount');
            $table->bigInteger('unitary_value');
            $table->bigInteger('total_value');
            $table->unsignedBigInteger('ID_user');
            $table->unsignedBigInteger('ID_product');
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
        Schema::dropIfExists('sales');
    }
}
