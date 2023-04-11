<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddToCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_to_cards', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 50);
            $table->foreignId('product_id');
            $table->float('quantity')->default(0);
            $table->float('unit_price')->default(0);
            $table->float('total_price')->default(0);
            $table->json('data', 250)->nullable();
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
        Schema::dropIfExists('add_to_cards');
    }
}
