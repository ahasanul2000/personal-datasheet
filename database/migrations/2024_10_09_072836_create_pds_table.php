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
        Schema::create('pds', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('fullName');
            $table->string('phone');
            $table->string('address');
            $table->integer('age');
            $table->string('image')->nullable(); // Allow image field to be nullable
            $table->timestamps();
            $table->softDeletes(); // Add this line to enable soft deletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pds');
    }
};
