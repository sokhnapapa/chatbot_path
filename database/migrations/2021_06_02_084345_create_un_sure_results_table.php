<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnSureResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('un_sure_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hiv_result_id')->unsigned();
            $table->foreign('hiv_result_id')->references('id')->on('h_i_v_results')->unique();
            $table->text('image_url');
            $table->unsignedInteger('status')->default(0);
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
        Schema::dropIfExists('un_sure_results');
    }
}
