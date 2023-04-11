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
            //$table->string('code', 100)->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('invoice_id')->nullable();
            $table->foreignId('stock_adjustment_id')->nullable();
            $table->enum('flow', ['In', 'Out'])->nullable();
            $table->double('quantity', 20, 4)->nullable();
            $table->double('price', 20, 4)->nullable();
            $table->double('vat', 20, 4)->nullable();
            $table->double('discount', 20, 4)->nullable();
            $table->double('subtotal', 20, 4)->nullable();
            $table->double('stock_in_opening', 20, 4)->nullable()->default(0);
            $table->double('stock_in_purchase', 20, 4)->nullable()->default(0);
            $table->double('stock_in_inventory', 20, 4)->nullable()->default(0);
            $table->double('stock_out_opening', 20, 4)->nullable()->default(0);
            $table->double('stock_out_sale', 20, 4)->nullable()->default(0);
            $table->double('stock_out_sale_web', 20, 4)->nullable()->default(0);
            $table->double('stock_out_inventory', 20, 4)->nullable()->default(0);
            $table->foreignId('warehouse_id');
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
        Schema::dropIfExists('stock_managers');
    }
}
