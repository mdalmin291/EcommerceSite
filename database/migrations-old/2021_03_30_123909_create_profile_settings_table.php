<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();
            $table->string('profile_photo', 100)->nullable();
			$table->string('business_name', 100)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('name', 100)->nullable();
			$table->text('address')->nullable();
			$table->string('mobile', 100)->nullable();
			$table->string('postal_code', 100)->nullable();
			$table->string('city', 100)->nullable();
			$table->string('country', 100)->nullable();
			$table->foreignId('user_id');
            $table->foreignId('branch_id');
            $table->enum('status', ['Active','Inactive']);
			$table->softDeletes();
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
        Schema::dropIfExists('profile_settings');
    }
}
