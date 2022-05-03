<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->mediumText('body');
            $table->string('image', 200)->nullable();
            $table->string('actions')->nullable();
        });

        $sql = <<<SQL
            INSERT INTO faqs (id, title, body, image, actions) VALUES
            (1, 'What is HIV self-testing?', 'HIV self-testing is the process in which a person collects his or her own specimen (oral fluid or\nblood) and then performs an HIV test and interprets the result, often in a private setting, either\nalone or with someone he or she trusts.\nHIVST does not provide a definitive HIV-positive diagnosis. All reactive (positive) self-test results\nneed to be confirmed by a trained tester using a validated national testing algorithm. Non-reactive\n(negative) self-test results are considered negative. However, in accordance with existing WHO\nHIVST guidance individuals who may have been exposed to HIV in the past 6 weeks and those at\nhigh on-going risk (such as key populations) are advised to retest. HIV self-testing is a process\nwhereby a person collects his or her own sample and conducts an HIV test.', 'faq-1-1.jpg', '1'),
            (2, 'Is HIV self-testing the right option for me?', 'An HIV test is the only way of knowing your HIV status. This is important in making informed\nchoices about your health and lifestyle. HIV self-testing allows you to test yourself privately and at\nyour own convenience. HIV self-tests are not suitable for those who are taking anti-retrovirals\n(ARVs). If you think you have been exposed to HIV or are at risk of infection, HIV self-testing offers\nan opportunity for you to determine your status.', 'faq-2-1.jpg', '1'),
            (3, 'Which HIV self-test kits are available?', 'At present, there are two types of HIV self-test kits available, which detect the HIV virus using\neither a blood or oral fluid (saliva) sample.', 'faq-3-1.jpg', '1'),
            (4, 'How reliable are HIV self-test kits?', 'When used according to the manufacturer''s instructions provided, both the blood and oral HIV self-tests are accurate.', 'faq-4-1.jpg', '1'),
            (5, 'Where can I get an HIV self-test kit?', 'Approved HIV self-test kits are available in the public & private health facilities as well as in select pharmacies.', 'faq-5-1.jpg', '1'),
            (6, 'How do I conduct an HIV self-test?','Follow instructions as provided by the manufacturer and the service provider.', 'faq-6-1.jpg', '1'),
            (7, 'What should I do if my test result is reactive (positive)?', 'If you interpret a HIV reactive (positive) result, it is important that you go for a confirmatory HIV test at a facility/community offering HIV Testing Services by a qualified health provider to know your status.', 'faq-7-1.jpg', '1'),
            (8, 'What should I do if I test HIV negative?', 'Remember that it can take up to 3 months after exposure to HIV for detect a HIV infection.  Therefore, if you were exposed to HIV less than 3 months ago, you need to test again after 4 weeks to be sure that your status is truly negative. However, if you have not been exposed to HIV over the past 3 months and you conducted the test as instructed, then it is highly likely a negative result means you do not have HIV.   If you continue to be at risk of HIV infection, you should continue to re-test every 3 months. You should also talk to a health provider about other HIV prevention options.', 'faq-8-1.jpg', '1'),
            (9, 'If HIV cannot be transmitted through saliva, why use oral fluids (saliva) to test for HIV?', 'HIV cannot be transmitted through saliva, urine or sweat.   HIV can be transmitted through contact with blood, vaginal and rectal fluids and breast milk from an infected person.  \r\n\r\nHIV self-tests detect if your body has been previously exposed to HIV. If it has, your body will have produced antibodies specific to HIV to defend itself against the virus.  These antibodies can be detected from oral fluids (as well as in blood). The HIV self-test does not detect the actual virus. ', 'faq-9-1.jpg', '1'),
            (10, 'Can my partner and I test as a couple? If so, what will happen if one of us tests HIV positive?', 'You and your partner can test together in your privacy.   Each of you should use separate test kits and conduct the test as indicated in the instructions provided. If any of you interpret a reactive (positive) result, you must visit a HIV Testing service provider at the facility/community for a HIV test.', 'faq-10-1.jpg', '1'),
            (11, 'I’m HIV positive, Can I use the HIV Self-Testing kit to test my child?', 'You should never use the HIV self-test kit on babies.  For children, it is recommended to take them to the health facility for HIV testing.', 'faq-11-1.jpg', '1'),
            (12, 'What should I do if someone wants to force me to take a test?', 'The HIV prevention and control Act 2006 prohibits compulsory testing and therefore HIV testing without your consent is illegal! You have the right to refuse to take a HIV test or stop the procedure at any time if you feel not ready to know your status.', 'faq-12-1.jpg', '1'),
            (13, 'Where can I get more information on HIV prevention, care and treatment? ', 'You can visit the nearest health/community facility or call the helpline for more information.', 'faq-13-1.jpg', '1');

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
        Schema::dropIfExists('faqs');
    }
}
