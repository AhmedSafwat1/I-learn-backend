<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sections', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("section_id");

            $table->foreign('section_id')
                   ->references('id')
                   ->on('sections')
                   ->onUpdate('cascade')
                   ->onDelete('cascade');

            $table->foreign('user_id')
                   ->references('id')
                   ->on('users')
                   ->onUpdate('cascade')
                   ->onDelete('cascade');
            $table->primary(["section_id", "user_id"]);
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
        Schema::dropIfExists('user_sections');
    }
}
