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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->text('body_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->text('body_ar')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_read')->default(0);
            $table->foreignId('user_id');
            $table->foreignId('worker_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('worker_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('notifications');
    }
};
