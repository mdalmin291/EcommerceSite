<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->nullable();
            $table->timestamp('expired_date')->nullable();
            $table->enum('offer_type', ['Percentage', 'Amount'])->nullable();
            $table->double('amount', 20, 4)->nullable();
            $table->double('min_buy_amount', 20, 4)->nullable();
            $table->enum('status', ['Active', 'Inactive']);
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
        Schema::dropIfExists('coupon_codes');
    }
}
