<?php

namespace App\Conversations;

use App\FacebookUser;
use App\Http\Controllers\RapidProController;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class Consent extends Conversation
{
    protected $user;

    public function __construct(FacebookUser $user, $then = null)
    {
        $this->user = $user;
        $this->then = $then;
    }

    public function askConsent()
    {
        $msg = 'By continuing to use the app you Consent to receiving HIV prevention services through SMS?';

        $question = Question::create($msg)
            ->fallback('Unable to create a new database')
            ->callbackId('update_consent')
            ->addButtons(
                [
                    Button::create('Yes')->value(1),
                    Button::create('No')->value(0),
                ]
            );

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
                $this->user->consent = $selectedValue;
                $this->user->save();
                if ($this->then === 'add_to_rapid_pro') {
                    if ($this->user->consent) {
                        $this->add_to_rapid_pro_negative();
                    }
                }
            }
        });
    }

    public function add_to_rapid_pro_negative()
    {
        $results = (new RapidProController())->addUserToNegativeMessages($this->user);

        if ($results) {
            $this->bot->typesAndWaits(1);
            $this->say("We have subscribed you to HIV/AIDS prevention messages");
        }
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askConsent();
    }
}
