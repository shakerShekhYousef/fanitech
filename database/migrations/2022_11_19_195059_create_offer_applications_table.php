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
        Schema::disableForeignKeyConstraints();
        Schema::create('offer_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id');
            $table->foreignId('offer_id');
            $table->double('price');
            $table->foreign('worker_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('offer_id')
                ->references('id')
                ->on('offers')
                ->onDelete('cascade');
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
        Schema::dropIfExists('offer_applications');
    }
};
