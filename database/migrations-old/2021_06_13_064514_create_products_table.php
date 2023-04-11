<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 191);
            $table->string('name', 191);
            $table->string('short_description', 191);
            $table->string('long_description', 191);
            $table->double('regular_price', 20, 4);
            $table->double('special_price', 20, 4);
            $table->double('wholesale_price', 20, 4);
            $table->double('purchase_price', 20, 4)->default(0);
            $table->double('discount', 20, 4)->default(0);
            $table->foreignId('sub_sub_category_id');
            $table->foreignId('brand_id')->nullable();
            $table->string('low_alert', 191);
            $table->text('youtube_link')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->foreignId('contact_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('vat_id')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->nullable();
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
        Schema::dropIfExists('products');
    }
}
