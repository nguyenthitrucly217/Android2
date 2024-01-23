<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up()
    {
        Schema::create('nttl_productsale', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->default(0);
            $table->float('pricesale');
            $table->unsignedInteger('quantity')->default(0);
            $table->datetime('date_begin');
            $table->datetime('date_end');
            $table->timestamps();//created_at, updated_at
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('status')->default(2);


        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down()
    {
        Schema::dropIfExists('nttl_productsale');
    }
}
