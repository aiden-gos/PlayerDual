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
            $table->foreignId('ordering_user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('ordered_user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->string('message')->nullable();
            $table->string('status');
            $table->double('price');
            $table->integer('duration');
            $table->double('total_price');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
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
