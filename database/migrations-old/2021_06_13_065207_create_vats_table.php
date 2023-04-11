<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vats', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->nullable();
            $table->string('name',100)->nullable();
            $table->string('rate_percent');
            $table->string('rate_fixed')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('branch_id');
            $table->enum('status', ['Active','Inactive']);
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
        Schema::dropIfExists('vats');
    }
}
