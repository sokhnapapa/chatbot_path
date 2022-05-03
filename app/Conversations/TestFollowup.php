<?php

namespace App\Conversations;

use App\FbUser;
use App\Http\Controllers\FlowRunsController;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

class TestFollowup extends Conversation
{
    public $bot;
    public $fb_user;
    public function __construct(BotMan $bot)
    {
        $this->bot = $bot;
    }
    /**
     * First question
     */
    public function startFollowup()
    {
        // FlowRunsController::saveRun($this->bot,10);

        $this->bot->reply(ButtonTemplate::create('Have you been able to get and use an HIV self test kit since our last interaction?')
                ->addButton(ElementButton::create('YES')->type('postback')->payload('YES_TEST'))
                ->addButton(ElementButton::create('NO')->type('postback')->payload('NO_TEST'))
        );
    }

    public function startYesTest()
    {
        // FlowRunsController::saveRun($this->bot,11);
        $user = $this->bot->getUser();
        $this->fb_user = FbUser::where('user_id', $user->getId())->first();
        $this->fb_user->tested = 1;
        $this->fb_user->save();

        $question = Question::create('Was this your first time to use the Self Test Kit?')
            ->fallback('Unable to ask whether times of kit use')
            ->callbackId('first_time_user')
            ->addButtons([
                Button::create('Yes')->value('YES_FIRST_USER'),
                Button::create('No')->value('NO_FIRST_USER'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
                if ($selectedValue == 'YES_FIRST_USER') {
                    $this->fb_user->first_timer = 1;
                    $this->fb_user->save();
                } elseif ($selectedValue == 'NO_FIRST_USER') {
                    $this->fb_user->first_timer = 0;
                    $this->fb_user->save();
                } else {
                    $this->startYesTest();
                }
                //ask where kit was bought
                $this->askPlace();
            } else {
                $this->startYesTest();
            }
        });

    }

    public function startNoTest()
    {
        FlowRunsController::saveRun($this->bot, 12);
        $user = $this->bot->getUser();
        $this->fb_user = FbUser::where('user_id', $user->getId())->first();
        $this->fb_user->tested = 1;
        $this->fb_user->save();

        $this->say('If you need more information and support,');
        $main_menu = new AskAgeAndGender($this->bot);
        $main_menu->displayMainMenu();
    }

    public function askPlace()
    {
        $this->ask('Where Did you purchase the Self Test Kit?', function (Answer $answer) {
            // Save result
            $b_f = $answer->getText();
            if (isset($b_f) && !empty($b_f) && $b_f != '') {
                $this->fb_user->bought_from = $b_f;
                $this->fb_user->save();
                $this->askKitType();
            } else {
                $this->askPlace();
            }
        });
    }

    public function askKitType()
    {
        $question = Question::create('Which of these Self Test Kits did you use?')
            ->fallback('Unable to ask kit type used')
            ->callbackId('kit_type_tested')
            ->addButtons([
                Button::create('Oraquick (Oral) ')->value('ORAL_KIT'),
                Button::create('Insti (Blood)')->value('BLOOD_KIT'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
                if ($selectedValue == 'ORAL_KIT') {
                    $this->fb_user->kit_used = 'Oral';
                    $this->fb_user->save();
                } elseif ($selectedValue == 'BLOOD_KIT') {
                    $this->fb_user->kit_used = 'Blood';
                    $this->fb_user->save();
                } else {
                    $this->askKitType();
                }
                //disclose results
                $this->bot->startConversation(new ResultsDisclosure($this->bot));

            } else {
                $this->askKitType();
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->startFollowup();
    }
}
