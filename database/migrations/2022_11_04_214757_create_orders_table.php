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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("offer_id")
                ->nullable()
                ->constrained('offers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId("task_id")
                ->nullable()
                ->constrained('tasks')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('status')->default(0);
            $table->foreignId("canceled_user_id")
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('return_comment')->nullable();
            $table->text('surrender_comment')->nullable();
            $table->text('cancel_comment')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
