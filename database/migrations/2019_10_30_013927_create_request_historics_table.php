<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_historics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('request_id')->unsigned();
            $table->foreign('request_id')->references('id')->on('Requests')->ondelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('Users');
            $table->string('message')->default('enviou uma solicitação.');
            $table->enum('action',['creation', 'update', 'completed'])->default('creation');
            $table->dateTime('action_datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }
	
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_historics');
    }
}
