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
        Schema::create('skcc_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->default(1);

            $table->foreignId('skcc_id')->constrained()->cascadeOnDelete();
            $table->string('account_no')->nullable();
            $table->string('check_no')->nullable();
            $table->date('date')->nullable();
            $table->string('payee_name')->nullable();
            $table->double('amount')->nullable();
            $table->string('purpose')->nullable();
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
        Schema::dropIfExists('skcc_items');
    }
};
