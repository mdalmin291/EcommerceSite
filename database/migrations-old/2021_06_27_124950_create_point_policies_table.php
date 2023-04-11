<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_policies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->double('amount', 20, 2)->nullable();
            $table->double('point_value', 20, 2)->nullable();
            $table->double('point_amount', 20, 2)->nullable();
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
        Schema::dropIfExists('point_policies');
    }
}
