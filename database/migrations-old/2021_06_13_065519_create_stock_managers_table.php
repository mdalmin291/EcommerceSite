<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_managers', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->string('code', 100)->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('invoice_id')->nullable();
            $table->foreignId('stock_adjustment_id')->nullable();
            $table->enum('flow', ['In', 'Out'])->nullable();
            $table->double('quantity', 20, 4)->nullable();
            $table->double('price', 20, 4)->nullable();
            $table->double('vat', 20, 4)->nullable();
            $table->double('discount', 20, 4)->nullable();
            $table->double('subtotal', 20, 4)->nullable();
            $table->foreignId('warehouse_id');
            $table->foreignId('user_id');
            $table->foreignId('branch_id');
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
        Schema::dropIfExists('stock_managers');
    }
}
