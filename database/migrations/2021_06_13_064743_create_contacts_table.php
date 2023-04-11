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
            $table->foreignId('user_id')->nullable();
            $table->enum('type', ['Customer', 'Supplier', 'Staff', 'Both'])->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('shipping_address', 255)->nullable();
            $table->string('business_name', 191)->nullable();
            $table->string('post_code', 6)->nullable();
            $table->string('state', 100)->nullable();
            $table->foreignId('upazilla_id')->nullable()->unsigned();
            $table->foreignId('district_id')->nullable()->unsigned();
            $table->foreignId('division_id')->nullable()->unsigned();
            $table->foreignId('country_id')->nullable()->unsigned();
            $table->string('phone', 20)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('due_date')->nullable();
            $table->date('birthday')->nullable();
            $table->double('opening_balance')->nullable()->default(0);
            $table->foreignId('contact_category_id')->nullable();
            $table->foreignId('branch_id')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
