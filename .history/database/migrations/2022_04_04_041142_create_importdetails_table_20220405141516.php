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
            $table->string('importdetail_image');
            $table->double('importdetail_import_price');
            $table->double('importdetail_sell_price');
            $table->date('importdetail_date_start');
            $table->date('importdetail_date_end');
            $table->integer('importdetail_quantity');
            $table->string('importdetail_drive');
            $table->string('importdetail_vat')->nullable();
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
