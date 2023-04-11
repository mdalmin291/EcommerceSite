<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name', 191);
            $table->string('business_name', 191);
            $table->string('trade_license', 191);
            $table->string('trn_number', 15);
            $table->text('profile_photo_path')->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('business_location', 191);
            $table->foreignId('district_id');
            $table->string('mobile')->unique()->nullable();
            $table->enum('account_type',['Individual', 'Seller']);
            $table->enum('status', ['Pending', 'Approved', 'Cancel'])->default('Pending');
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
        Schema::dropIfExists('vendors');
    }
}
