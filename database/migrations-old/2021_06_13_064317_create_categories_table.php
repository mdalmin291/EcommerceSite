<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('code', 191);
            $table->string('name', 191);
            $table->text('image1')->nullable();
            $table->text('image2')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('branch_id');
            $table->enum('status', ['Active', 'Inactive'])->nullable();
            $table->tinyInteger('top_show');
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
        Schema::dropIfExists('categories');
    }
}
