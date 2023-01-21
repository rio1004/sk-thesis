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
        Schema::create('abcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->default(1);

            $table->string('procurement_title');
            $table->string('bidder');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('submitted_by_id')->nullable()->references('id')->on('officials')->nullOnDelete();
            $table->foreignId('approved_by_id')->nullable()->references('id')->on('officials')->nullOnDelete();
            $table->foreignId('recommend_by_id')->nullable()->references('id')->on('officials')->nullOnDelete();
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
        Schema::dropIfExists('abcs');
    }
};
