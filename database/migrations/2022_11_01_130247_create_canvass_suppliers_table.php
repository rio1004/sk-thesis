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
        Schema::create('canvass_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->default(1);

            $table->string('status')->default(0);
            $table->string('type')->default(0);
            $table->integer('amount');
            $table->foreignId('supplier_id')->nullable()->references('id')->on('suppliers')->cascadeOnDelete();
            $table->foreignId('canvass_item_id');
            $table->foreignId('canvass_id');
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
        Schema::dropIfExists('canvass_suppliers');
    }
};
