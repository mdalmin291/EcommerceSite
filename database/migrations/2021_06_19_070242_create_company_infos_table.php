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
            $table->text('privacy_policy')->nullable();
            $table->text('google_map_location')->nullable();
            $table->text('terms_condition')->nullable();
            $table->text('about_us')->nullable();
            $table->text('return_policy')->nullable();
            $table->string('front_end_top_header_color')->nullable();
            $table->string('front_end_bottom_header_color')->nullable();
            $table->string('front_end_menu_color')->nullable();
            $table->string('front_end_top_footer_color')->nullable();
            $table->string('front_end_bottom_footer_color')->nullable();
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
        Schema::dropIfExists('company_infos');
    }
}
