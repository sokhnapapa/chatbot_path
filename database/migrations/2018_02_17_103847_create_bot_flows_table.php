<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBotFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_flows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->mediumText('body');
        });

        $sql = <<<SQL
            INSERT INTO `bot_flows` (`id`, `name`, `body`) VALUES
            (1, 'New Users', 'User completed on boarding.'),
            (2, 'View FAQs', 'Users interested in viewing Frequently Asked Questions.'),
            (3, 'Request Kit', 'User initiates request for Self testing kits'),
            (4, 'Share results', 'Initiates sharing results'),
            (5, 'Instructions ', 'User interested in viewing results'),
            (6, 'Referrals ', 'User interested in referrals'),
            (7, 'Shares results', 'User shares result successfully'),
            (8, 'Unsure', 'User does not know results'),
            (9, 'User uploads ', 'User uploads their results'),
            (10, 'RapidPro', 'User subscribed to rapid pro'),
            (11, 'ART Number', 'Users enter ART Number'),
            (12, 'Visit Hospital reminder', 'User reminded to go the hospital'),
            (13, 'Flow 13', 'Flow 13 description'),
            (14, 'Flow 14', 'Flow 14 description'),
            (15, 'Flow 15', 'Flow 15 description');
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
        Schema::dropIfExists('bot_flows');
    }
}
