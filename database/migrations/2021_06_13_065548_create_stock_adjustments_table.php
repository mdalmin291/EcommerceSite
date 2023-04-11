<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('type',['Transfer','Decrease','Increase']);
            $table->foreignId('contact_id')->nullable();
            $table->foreignId('from_branch_id')->nullable();
            $table->foreignId('to_branch_id')->nullable();
            $table->foreignId('from_warehouse_id')->nullable();
            $table->foreignId('to_warehouse_id')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('stock_adjustments');
    }
}
