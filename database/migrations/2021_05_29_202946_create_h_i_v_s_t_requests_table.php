<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHIVSTRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_i_v_s_t_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requester')->unsigned();
            $table->foreign('requester')->references('id')->on('users')->unique();
            $table->integer('access_location')->unsigned();
            $table->foreign('access_location')->references('id')->on('h_i_v_s_t_access_locations')->unique();
            $table->integer('access_code');
            $table->boolean('picked');
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
        Schema::dropIfExists('h_i_v_s_t_requests');
    }
}
