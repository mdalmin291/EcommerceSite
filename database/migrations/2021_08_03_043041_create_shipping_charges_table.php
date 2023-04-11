<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->nullable();
            $table->string('title', 200)->nullable();
            $table->enum('type', ['price', 'weight'])->nullable();
            $table->double('from', 20, 4)->nullable();
            $table->double('to', 20, 4)->nullable();
            $table->double('shipping_fee', 20, 4)->default(0);
            $table->foreignId('country_id');
            $table->foreignId('branch_id');
            $table->foreignId('created_by');
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_charges');
    }
}
