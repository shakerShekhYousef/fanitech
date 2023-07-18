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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->text('details_en')->nullable();
            $table->text('details_ar')->nullable();
            $table->string('image')->nullable();
            $table->string('offer_number')->nullable();
            $table->string('worker_price')->nullable();
            $table->double('lat');
            $table->double('long');
            $table->string('sub_category_description')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('worker_id')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id');
            $table->foreignId('offer_status_id');
            $table->text('refuse_reason')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('worker_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('sub_category_id')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade');
            $table->foreign('offer_status_id')
                ->references('id')
                ->on('offer_statuses')
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
        Schema::dropIfExists('offers');
    }
};
