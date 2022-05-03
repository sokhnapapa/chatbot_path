<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->mediumText('body');
            $table->string('type', 100);
            $table->string('payload', 100);
        });

        $sql = <<<SQL
            INSERT INTO `faq_actions` (`id`, `title`, `body`, `type`, `payload`) VALUES
            (1, 'Return to main Menu ', 'view frequently asked questions', 'button', 'go_to_main_menu'),
            (2, 'view faqs2', 'view frequently asked questions2', 'button', 'view_faqs2'),
            (3, 'view faqs3','view frequently asked questions3', 'button', 'view_faqs3');
        SQL;

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_actions');
    }
}
