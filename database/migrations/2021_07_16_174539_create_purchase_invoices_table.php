<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code', 191);
            $table->foreignId('contact_id')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->double('total_amount')->nullable();
            $table->double('other_amount')->nullable();
            $table->double('discount')->nullable();
            $table->double('shipping_charge')->nullable();
            $table->double('commission')->nullable();
            $table->double('vat')->nullable();
            $table->double('payable_amount')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('purchase_invoices');
    }
}
