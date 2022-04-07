<?php

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
        Schema::create('importdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('import_id');
            $table->integer('product_id');
            $table->text('barcodes');
            $table->bigInteger('product_code');
            $table->string('detail_image')->nullable();
            $table->double('detail_import_price');
            $table->double('detail_sell_price');
            $table->date('detail_date_start');
            $table->date('detail_date_end');
            $table->integer('detail_quantity');
            $table->integer('detail_soldout')->default(0);
            $table->string('detail_drive')->nullable();
            $table->string('detail_vat')->nullable();
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
        Schema::dropIfExists('importdetails');
    }
};
