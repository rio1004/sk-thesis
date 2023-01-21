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
        Schema::create('purchase_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->default(1);
            $table->foreignId('purchase_request_id')->constrained()->cascadeOnDelete();
            $table->integer('item_no')->nullable();
            $table->string('item');
            $table->string('unit');
            $table->double('estimated_unit_cost')->default(0);
            $table->double('estimated_amount')->default(0);
            $table->integer('qty')->default(0);
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
        Schema::dropIfExists('purchase_request_items');
    }
};
