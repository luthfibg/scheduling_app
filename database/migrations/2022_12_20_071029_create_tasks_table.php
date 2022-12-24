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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            // $table->string('description');
            // $table->dateTime('deadline', $precision = 0)->nullable();
            // $table->enum('status', ['Not done', 'On progress', 'Done', 'Neglected'])->default('Not done');
            $table->dateTime('created_at')->useCurrent()->change();
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
        Schema::dropIfExists('tasks');
    }
};
