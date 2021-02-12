<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_works', function (Blueprint $table) {
            $table->uuid('id');
            $table->text("note")->nullabel();
            $table->string("price")->default(0);
            $table->boolean("is_paied")->default(false);
            $table->boolean("is_free")->default(false);
            $table->string("status", "15")->default("wait");

            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("teacher_id");

            $table->foreign('student_id')
                    ->references('id')->on('users')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');

            $table->foreign('teacher_id')
                    ->references('id')->on('users')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            $table->primary("id");

            $table->softDeletes();
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
        Schema::dropIfExists('home_works');
    }
}
