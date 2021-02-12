<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeWorkSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_work_solutions', function (Blueprint $table) {
            $table->uuid('id');
            $table->text("note")->nullable();
            $table->uuid("home_work_id");

            $table->foreign('home_work_id')
                    ->references('id')->on('home_works')
                    ->onUpdated("cascade")
                    ->onDelete('cascade');

            $table->primary("id");
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
        Schema::dropIfExists('home_work_solutions');
    }
}
