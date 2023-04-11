<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Customer', 'Supplier', 'Staff'])->nullable();
            $table->string('first_name', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('shipping_address', 191)->nullable();
            $table->string('post_code', 191)->nullable();
            $table->string('state', 191)->nullable();
            $table->foreignId('country_id')->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('mobile', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->date('due_date')->nullable();
            $table->date('birthday')->nullable();
            $table->date('opening_balance')->nullable();
            $table->foreignId('contact_category_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('branch_id');
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
        Schema::dropIfExists('contacts');
    }
}
