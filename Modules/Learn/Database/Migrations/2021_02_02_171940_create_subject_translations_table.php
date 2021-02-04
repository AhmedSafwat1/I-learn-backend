<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_translations', function (Blueprint $table) {
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('locale')->index();
            $table->bigInteger('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->primary(['subject_id','locale']);
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
        Schema::dropIfExists('subject_translations');
    }
}
