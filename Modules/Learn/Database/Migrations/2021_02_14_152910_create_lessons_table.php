<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->uuid('id');
            $table->string("title")->nullable();
            $table->text("note")->nullabel();
            $table->string("price")->default(0);
            $table->boolean("is_paied")->default(false);
            $table->boolean("is_free")->default(false);
            $table->string("status", "15")->default("wait");
            
            $table->timestamp("start_at")->nullable();
            $table->time("time")->nullable();
            $table->date("date")->nullable();
            $table->unsignedInteger("duration")->default("60");
            $table->timestamp("end_at")->nullable();
            $table->string("type","15")->defult("house");

            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("teacher_id");

            $table->unsignedBigInteger("subject_id");

            $table->foreign('student_id')
                    ->references('id')->on('users')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');
            
            $table->foreign('subject_id')
                    ->references('id')->on('subjects')
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
        Schema::dropIfExists('lessons');
    }
}
