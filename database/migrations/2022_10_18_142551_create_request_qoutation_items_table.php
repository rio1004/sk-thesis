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
        Schema::create('request_qoutation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->default(1);
            $table->integer('qty');
            $table->foreignId('rfq_id')->nullable()->references('id')->on('request_qoutations')->nullOnDelete();
            $table->string('item');
            $table->string('unit');
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
        Schema::dropIfExists('request_qoutation_items');
    }
};
