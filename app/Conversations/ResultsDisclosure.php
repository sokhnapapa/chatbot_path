<?php

namespace App\Conversations;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ResultsDisclosure extends Conversation
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
    public function disclose()
    {
        // FlowRunsController::saveRun($this->bot,13);
        // $user = $this->bot->getUser();
        // $this->fb_user = FbUser::where('user_id',$user->getId())->first();
        $question = Question::create('It is important to know what to do after receiving your test result. In order to guide you, please select your test result')
            ->fallback('Unable to ask test results')
            ->callbackId('ask_test_results')
            ->addButtons([
                Button::create('Positive')->value('POSITIVE'),
                Button::create('Negative')->value('NEGATIVE'),
                Button::create('Unclear')->value('UNCLEAR'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
                if ($selectedValue == 'POSITIVE') {
                    // $this->fb_user->results = 'Positive';
                    // $this->fb_user->save();
                    $this->say('Thank you for using the self test. It is important that you do a confirmatory test at a referral health facility. You can find referral health facility locations by calling 1190.');
                    // $this->bot->startConversation(new TalkToCounselor($this->bot));
                } elseif ($selectedValue == 'NEGATIVE') {
                    // $this->fb_user->results = 'Negative';
                    // $this->fb_user->save();
                    $this->say('Please call our counselors on the toll free line 0800205555 for more information on how to protect yourself and remain Negative.');
                    //$this->bot->startConversation(new TalkToCounselor($this->bot));
                } elseif ($selectedValue == 'UNCLEAR') {
                    // $this->fb_user->results = 'Unclear';
                    // $this->fb_user->save();
                    $this->say('Thank you for using the self test. It is important that you do a confirmatory test at a referral health facility. You can find referral health facility locations by calling 1190.');
                    // $this->bot->startConversation(new TalkToCounselor($this->bot));
                } else {
                    $this->disclose();
                }
                // $this->fb_user->followed = 1;
                // $this->fb_user->save();

            } else {
                $this->disclose();
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->disclose();
    }
}
