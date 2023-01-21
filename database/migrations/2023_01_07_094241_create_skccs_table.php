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
        Schema::create('skccs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->default(1);

            $table->foreignId('disbursement_id')->constrained()->cascadeOnDelete();
            $table->string('skcc_no')->nullable();
            $table->date('skcc_date')->nullable();
            $table->string('to_name')->nullable();
            $table->string('to_company')->nullable();
            $table->string('to_address')->nullable();
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
        Schema::dropIfExists('skccs');
    }
};
