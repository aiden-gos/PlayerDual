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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->nullable();
            $table->double('balance')->default(0);
            $table->string('country')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('avatar')->nullable();
            $table->double('price')->default(0);
            $table->string('card_number')->nullable();
            $table->string('card_expire')->nullable();
            $table->string('card_cvv')->nullable();
            $table->unsignedBigInteger('role_id')->default(2);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
