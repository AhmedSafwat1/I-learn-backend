<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('user_name')->nullable();
            $table->string('image')->default("/uploads/users/user.png");
            $table->string('phone_code')->nullable();
            $table->string('mobile');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(true);
            $table->string('password')->nullable();
            $table->text("setting")->nullable(); 
            $table->enum("type",["student","admin", "teacher"])->index()->default("admin");
            $table->enum("gender",["male","female"])->nullable();       
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
