<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->nullable();
            $table->double('opening_balance')->nullable();
            $table->double('purchase_amount')->nullable();
            $table->double('sale_amount')->nullable();
            $table->double('discount')->nullable();
            $table->double('vat')->nullable();
            $table->double('commission')->nullable();
            $table->double('balance')->nullable();
            $table->string('model')->nullable();
            $table->integer('model_id')->nullable();
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
        Schema::dropIfExists('contact_balances');
    }
}
