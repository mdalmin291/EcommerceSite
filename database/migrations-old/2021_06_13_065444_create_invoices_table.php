<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Order', 'Sales', 'Purchase', 'Quate']);
            $table->timestamp('date');
            $table->string('code', 100)->nullable();
            $table->foreignId('contact_id')->nullable();
            $table->double('subtotal', 20, 4)->nullable();
            $table->double('vat_total', 20, 4)->nullable();
            $table->double('discount_value', 20, 4)->nullable();
            $table->double('discount', 20, 4)->nullable();
            $table->double('shipping_charge', 20, 4)->nullable();
            $table->double('earn_point', 20, 4)->nullable();
            $table->double('earn_point_amount', 20, 4)->nullable();
            $table->double('expense_point', 20, 4)->nullable();
            $table->double('expense_point_amount', 20, 4)->nullable();
            $table->double('grand_total', 20, 4)->nullable();
            $table->foreignId('user_id');
            $table->foreignId('branch_id');
            $table->enum('status', ['Pending', 'In Process', 'Delivered', 'Accepted', 'Rescheduled', 'Picked Up', 'Cancel', 'Return']);
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
        Schema::dropIfExists('invoices');
    }
}
