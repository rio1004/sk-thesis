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
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('dv_no')->nullable();
            $table->date('dv_date')->nullable();
            $table->string('check_no')->nullable();
            $table->string('check_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('or_no')->nullable();
            $table->string('or_date')->nullable();
            $table->string('payee_name')->nullable();
            $table->string('payee_address')->nullable();
            $table->string('payee_tin')->nullable();
            $table->foreignId('payee_id')->nullable()->references('id')->on('suppliers')->nullOnDelete();
            $table->text('particular_text')->nullable();
            $table->foreignId('bmo_id')->nullable()->references('id')->on('officials')->nullOnDelete();
            $table->foreignId('treasurer_id')->nullable()->references('id')->on('officials')->nullOnDelete();
            $table->foreignId('chairperson_id')->nullable()->references('id')->on('officials')->nullOnDelete();
            $table->double('total_amount')->default(0);
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
        Schema::dropIfExists('disbursements');
    }
};
