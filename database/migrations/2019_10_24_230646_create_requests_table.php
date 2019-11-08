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
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->ondelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->bigInteger('technician_id')->unsigned()->nullable();
            $table->foreign('technician_id')->references('id')->on('users');
            $table->enum('type', ['bug', 'nova funcionalidade', 'melhoria', 'pedido'])->nullable();
            $table->enum('priority', ['crítica', 'maior', 'menor', 'leve'])->nullable();
            $table->date('deadline')->nullable();
            $table->enum('status', ['a fazer', 'fazendo', 'bloqueada', 'feita'])->default('a fazer');
            $table->enum('delivered', ['dentro do prazo', 'atrasado'])->nullable();
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
