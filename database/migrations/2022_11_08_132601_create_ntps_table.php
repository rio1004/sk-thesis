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
        Schema::create('ntps', function (Blueprint $table) {
            $table->id();
            $table->string('ntp_date');
            $table->string('project_location');
            $table->string('ntp_effectivity_date');
            $table->foreignId('canvass_id')->nullable()->references('id')->on('canvasses')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('ntps');
    }
};
