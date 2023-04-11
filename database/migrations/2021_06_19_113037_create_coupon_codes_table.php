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
            $table->string('code', 50)->nullable();
            $table->integer('expired_day')->nullable();
            $table->timestamp('expired_date')->nullable();
            $table->timestamp('after_effect_date')->nullable();
            $table->enum('offer_type', ['Percentage', 'Amount', 'Reward-Point'])->nullable();
            $table->double('offer_amount', 20, 4)->nullable();
            $table->double('min_buy_amount', 20, 4)->nullable();
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
        Schema::dropIfExists('coupon_codes');
    }
}
