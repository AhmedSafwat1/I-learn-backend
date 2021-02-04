<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("subject_id");

            $table->foreign('subject_id')
                   ->references('id')
                   ->on('subjects')
                   ->onUpdate('cascade')
                   ->onDelete('cascade');

            $table->foreign('user_id')
                   ->references('id')
                   ->on('users')
                   ->onUpdate('cascade')
                   ->onDelete('cascade');

            $table->primary(["subject_id", "user_id"]);

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
        Schema::dropIfExists('user_subjects');
    }
}
