<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('date')->nullable();
            $table->foreignId('contact_id');
            $table->foreignId('sale_invoice_id')->nullable();
            $table->double('total_amount', 20,4)->nullable();
            $table->double('charge', 20,4)->nullable();
            $table->double('vat', 20,4)->nullable();
            $table->double('discount', 20,4)->nullable();
            $table->double('net_amount', 20,4)->nullable();
            $table->foreignId('payment_method_id');
            $table->string('transaction_id')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('note',500)->nullable();
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
        Schema::dropIfExists('sale_payments');
    }
}
