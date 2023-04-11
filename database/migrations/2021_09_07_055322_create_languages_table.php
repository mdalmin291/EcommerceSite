<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('language')->unique();
            $table->string('sign_up')->nullable();
            $table->string('sign_in')->nullable();
            $table->string('new_product')->nullable();
            $table->string('best_selling_product')->nullable();
            $table->string('home')->nullable();
            $table->string('product_categories')->nullable();
            $table->string('shop_page')->nullable();
            $table->string('complain_or_opinion')->nullable();
            $table->string('communication')->nullable();
            $table->string('return_policy')->nullable();
            $table->string('contact_us')->nullable();
            $table->string('privacy_policy')->nullable();
            $table->string('terms_and_condition')->nullable();
            $table->string('about_us')->nullable();
            $table->string('mission_and_vision')->nullable();
            $table->string('my_account')->nullable();
            $table->string('menu')->nullable();
            $table->string('product_search')->nullable();
            $table->string('beaking_news')->nullable();
            $table->string('total')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('discount')->nullable();
            $table->string('more_categories')->nullable();
            $table->string('more_products')->nullable();
            $table->string('shopping_cart')->nullable();
            $table->string('checkout')->nullable();
            $table->string('shopping_cart_button_text')->nullable();
            $table->string('checkout_button_text')->nullable();
            $table->string('login_button_text')->nullable();
            $table->string('register_button_text')->nullable();
            $table->string('logout_button_text')->nullable();
            $table->string('sell_button_text')->nullable();
            $table->string('sold_out_button_text')->nullable();
            $table->string('cart_page_order_finish_button_text')->nullable();
            $table->string('checkout_page_order_done_button_text')->nullable();
            $table->string('see_your_order_button_text')->nullable();
            $table->string('more_order_button_text')->nullable();
            $table->string('business_name_label')->nullable();
            $table->string('your_name_label')->nullable();
            $table->string('zilla_label')->nullable();
            $table->string('delivery_address_label')->nullable();
            $table->string('mobile_number_label')->nullable();
            $table->string('full_address_label')->nullable();
            $table->string('unit')->nullable();
            $table->string('cart_page_header_title')->nullable();
            $table->string('checkout_page_header_title')->nullable();
            $table->string('ordered_product_title')->nullable();
            $table->string('bill_total_title')->nullable();
            $table->string('business_name_placeholder')->nullable();
            $table->string('your_name_placeholder')->nullable();
            $table->string('your_mobile_number_placeholder')->nullable();
            $table->string('full_address_placeholder')->nullable();
            $table->string('delivery_address_placeholder')->nullable();
            $table->string('select_zila_option_text')->nullable();
            $table->string('no_product_in_shopping_bag_alert_text')->nullable();
            $table->string('no_product_alert')->nullable();
            $table->string('cash_on_delivery_text')->nullable();
            $table->boolean('is_default')->default(0);
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
        Schema::dropIfExists('languages');
    }
}
