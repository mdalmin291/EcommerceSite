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
            $table->foreignId('vendor_id')->nullable();
            $table->string('code', 191);
            $table->string('name', 500);
            $table->double('regular_price', 20, 4);
            $table->double('special_price')->default(0);
            $table->double('wholesale_price', 20, 4);
            $table->double('purchase_price', 20, 4)->default(0);
            $table->double('discount', 20, 4)->default(0)->nullable();
            $table->foreignId('sub_sub_category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('contact_id')->nullable();
            // $table->foreignId('product_feature_id')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->string('low_alert', 191)->nullable();
            $table->string('color', 500)->nullable();
            $table->string('size', 500)->nullable();
            $table->double('min_order_qty', 20, 4)->nullable();
            $table->enum('barcode_generate_state', ['Bulk', 'Single']);
            $table->enum('in_stock', ['In Stock', 'Out of Stock']);
            $table->foreignId('vat_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
