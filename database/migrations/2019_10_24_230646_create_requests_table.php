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
            $table->engine = 'InnoDB';
			$table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('project_id')->unsigned();
            $table->enum('created_out', ['0','1']);
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');
            $table->string('title');
            $table->text('description');
            $table->bigInteger('technician_id')->unsigned()->nullable();
            $table->foreign('technician_id')->references('id')->on('users');
            $table->enum('type', ['bug', 'dúvida', 'melhoria', 'nova funcionalidade', 'pedido', 'outros'])->nullable();
            $table->enum('priority', ['crítica', 'maior', 'menor', 'leve'])->nullable();
            $table->date('deadline')->nullable();
            $table->enum('status', ['a fazer', 'fazendo', 'bloqueada', 'feita'])->default('a fazer');
            $table->enum('delivered', ['dentro do prazo', 'atrasado'])->nullable();
            $table->integer('ali_data_type_amount')->default(0);
            $table->integer('ali_register_type_amount')->default(0);
            $table->string('ali_justify')->nullable();
            $table->integer('aie_data_type_amount')->default(0);
            $table->integer('aie_register_type_amount')->default(0);
            $table->string('aie_justify')->nullable();
            $table->integer('ee_data_type_amount')->default(0);
            $table->integer('ee_referenced_files_amount')->default(0);
            $table->string('ee_justify')->nullable();
            $table->integer('se_data_type_amount')->default(0);
            $table->integer('se_referenced_files_amount')->default(0);
            $table->string('se_justify')->nullable();
            $table->integer('ce_data_type_amount')->default(0);
            $table->integer('ce_referenced_files_amount')->default(0);
            $table->string('ce_justify')->nullable();
            $table->integer('function_points')->nullable();
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
