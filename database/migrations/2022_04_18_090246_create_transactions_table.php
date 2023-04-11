<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('date')->nullable();
            $table->string('transaction_id')->nullable();
            $table->enum('type', ['Payment', 'Receive']);
            $table->foreignId('payment_method_id');
            $table->foreignId('chart_of_account_id');
            $table->foreignId('contact_id');
            $table->double('amount', 20,4)->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('note',500)->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
