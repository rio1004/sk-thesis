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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('pr_id')->nullable()->references('id')->on('purchase_requests')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('po_no')->nullable();
            $table->date('po_date')->nullable();
            $table->string('mode_of_procurement')->nullable();
            $table->string('place_of_delivery')->nullable();
            $table->date('date_of_delivery')->nullable();
            $table->string('delivery_term')->nullable();
            $table->string('payment_term')->nullable();
            $table->double('funds_available')->nullable();
            $table->double('total_amount')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
};
