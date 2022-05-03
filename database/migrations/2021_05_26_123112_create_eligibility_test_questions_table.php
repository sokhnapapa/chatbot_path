<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEligibilityTestQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eligibility_test_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->timestamps();
        });

        $sql = <<<SQL
            INSERT INTO `eligibility_test_questions`(`id`, `question`) VALUES
            (1, 'Have you tested for HIV in the last 12 months?'),
            (2, 'Have you had TB Disease or presumptive TB (2 weeks’ history of Cough,night sweats, weight loss, fever)?'),
            (3, 'Have you had symptoms of Sexually Transmitted Infection (blisters, sores, unusual urethral or vaginal discharge)?'),
            (4, 'Are you newly diagnosed with Hepatitis B or C ?'),
            (5, 'Have you experienced sexual violence (SGBV)?'),
            (6, 'Have you done a reactive HIV self-test result ?'),
            (7, 'Have you been identified through an index client ?'),
            (8, 'Have you been exposed to blood or body fluids from a known HIV positive or unknown HIV status source ?'),
            (9, 'Have you had signs and symptoms of HIV disease and have not had an HIV test in the last 1 month ?'),
            (10,'Have you had unprotected sex with partner(s) of unknown HIV status?'),
            (11,'Have you had unprotected sex with an HIV positive partner?'),
            (12,'Have you shared injecting needles or piercing objects with anyone else?');
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
        Schema::dropIfExists('eligibility_test_questions');
    }
}
