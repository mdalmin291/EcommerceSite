<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['Invoice','Receipt']);
            $table->string('logo',191)->nullable();
            $table->string('invoice_header',191)->nullable();
            $table->string('invoice_title',191)->nullable();
            $table->text('invoice_footer')->nullable();
            $table->string('vat_reg_no',191)->nullable();
            $table->string('vat_area_code',191)->nullable();
            $table->string('vat_text',191)->nullable();
            $table->string('website',191)->nullable();
            $table->foreignId('currency_id');
            $table->tinyInteger('is_paid_due_hide')->nullable();
            $table->tinyInteger('is_memo_no_hide')->nullable();
            $table->tinyInteger('is_chalan_no_hide')->nullable();
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
        Schema::dropIfExists('invoice_settings');
    }
}
