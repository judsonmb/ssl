<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('email')->unique();
            $table->enum('type', ['admin', 'main requester', 'requester']);
            $table->bigInteger('institution_id')->unsigned();
            $table->foreign('institution_id')->references('id')->on('Institutions')->ondelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('$2y$10$IuXbbX7F6ma715YhJLnzFeRkeyHVk5b32shvh8EZynrVKmN68joOe');
            $table->enum('active', [1, 0])->default(1);
            $table->rememberToken();
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
