<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('Users');
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('Projects')->ondelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->bigInteger('technician_id')->unsigned()->nullable();
            $table->foreign('technician_id')->references('id')->on('Users');
            $table->enum('type', ['bug', 'new feature', 'improvement', 'request'])->nullable();
            $table->enum('priority', ['critical', 'bigger', 'smaller', 'mild'])->nullable();
            $table->date('deadline')->nullable();
            $table->enum('status', ['to do', 'doing', 'blocked', 'done'])->default('to do');
            $table->enum('delivered', ['on time', 'late'])->nullable();
            $table->integer('function_points')->default(0);
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
        Schema::dropIfExists('requests');
    }
}
