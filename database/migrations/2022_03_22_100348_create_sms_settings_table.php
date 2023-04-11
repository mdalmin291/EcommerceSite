<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();
            $table->text('url')->nullable();
            $table->string('api_key', 191)->nullable();
            $table->string('username', 50)->nullable();
            $table->text('password')->nullable();
            $table->string('sender_id', 50)->nullable();
            $table->string('business_name', 60)->nullable();
            $table->string('contact_info', 100)->nullable();
            $table->boolean('is_sale');
            $table->boolean('is_purchase');
            $table->boolean('is_receive');
            $table->boolean('is_payment');
            $table->boolean('is_contact');
            $table->boolean('is_receivable');
            $table->foreignId('user_id');
            $table->string('account_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_settings');
    }
}
