<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('user1_id');
            $table->foreign('user1_id')->references('id')->on('users');
            $table->unsignedBigInteger('user2_id');
            $table->foreign('user2_id')->references('id')->on('users');
            $table->float('quantity');
            $table->text('image');
            $table->enum('type', ['Food', 'Office Supply'])->default('Food');
            $table->enum('status', ['Waiting', 'Approved', 'Declined'])->default('Waiting');
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
        Schema::dropIfExists('operations');
    }
}
