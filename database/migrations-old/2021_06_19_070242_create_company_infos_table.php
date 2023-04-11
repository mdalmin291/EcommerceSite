<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('mobile', 100)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('hotline', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('web', 191)->nullable();
            $table->text('logo')->nullable();
            $table->text('facebook_link')->nullable();
            $table->text('youtube_link')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('branch_id');
            $table->enum('status', ['Active', 'Inactive']);
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
        Schema::dropIfExists('company_infos');
    }
}
