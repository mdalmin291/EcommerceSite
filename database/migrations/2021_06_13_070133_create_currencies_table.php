<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('title', 100);
            $table->string('symbol', 100);
            $table->enum('symbol_position', ['Prefix', 'Surfix'])->nullable();
            $table->string('in_word_prefix', 100)->nullable();
            $table->string('in_word_suffix', 100)->nullable();
            $table->enum('in_word_prefix_position', ['Prefix', 'Suffix'])->nullable();
            $table->enum('in_word_suffix_position', ['Prefix', 'Suffix'])->nullable();
            $table->foreignId('branch_id');
            $table->foreignId('created_by');
            $table->boolean('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('currencies');
    }
}
