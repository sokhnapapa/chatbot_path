<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHIVSTRequestedKitsResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_i_v_s_t_requested_kits_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requested_kit')->unsigned();
            $table->foreign('requested_kit')->references('id')->on('h_i_v_s_t_requests')->unique();
            $table->integer('result')->unsigned();
            $table->foreign('result')->references('id')->on('h_i_v_results')->unique();
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
        Schema::dropIfExists('h_i_v_s_t_requested_kits_results');
    }
}
