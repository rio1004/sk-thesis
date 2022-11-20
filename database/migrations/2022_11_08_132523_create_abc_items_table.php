<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abc_items', function (Blueprint $table) {
            $table->id();

     $table->integer('item_no')->nullable();
     $table->string('qty');
     $table->string('tax')->default(0);
     $table->string('insurance')->default(0);
     $table->string('indirect_cost')->default(0);
     $table->string('market_price')->default(0);
     $table->string('valuation_adjustment')->default(0);
     $table->string('total_cost')->default(0);
     $table->string('unit_cost')->default(0);

     $table->foreignId('item');
     $table->foreignId('unit');
     $table->foreignId('abc_id')->nullable()->references('id')->on('abcs')->cascadeOnDelete();
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
        Schema::dropIfExists('abc_items');
    }
};
