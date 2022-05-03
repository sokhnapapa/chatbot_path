<?php

namespace App\Conversations;

use App\Conversations\MainMenu;
use App\FacebookUser;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class OnBoarding extends Conversation
{
    protected $user;

    public function __construct(FacebookUser $user)
    {
        $this->user = $user;
    }

    public function askYearOfBirth()
    {
        $this->bot->typesAndWaits(1);
        $msg = 'Please put your birth year e.g. 1992';
        $error_msg_age = 'You need to enter a valid year';
        if ($this->user->birth_year != null) {
            $this->askGender();
            return;
        }

        $this->ask($msg, function ($answer, $conversation) use ($error_msg_age) {
            $reply = $answer->getText();
            if (preg_match('/^\d{4}$/', $reply)) {
                $this->user->birth_year = $reply;
                try {
                    $this->user->save();
                    $this->askGender();
                } catch (\Throwable $th) {
                    $this->user->birth_year = null;
                    $conversation->say($error_msg_age);
                    $this->askYearOfBirth();
                }

            } else {
                $conversation->say($error_msg_age);
                $this->askYearOfBirth();
            }

        });

    }

    public function askGender()
    {
        $question = Question::create('Please pick you gender')
            ->fallback('Unable to create a new database')
            ->callbackId('update_gender')
            ->addButtons([
                Button::create('Male')->value('male'),
                Button::create('Female')->value('female'),
            ]);

        if ($this->user->gender == null) {
            $this->bot->typesAndWaits(1);
            $this->ask($question, function (Answer $answer) {
                // Detect if button was clicked:
                if ($answer->isInteractiveMessageReply()) {
                    $selectedValue = $answer->getValue();
                    $selectedText = $answer->getText();
                    $this->user->gender = $selectedValue;
                    $this->user->save();
                    $this->askPhoneNumber();
                }
            });
        } else {
            $this->askPhoneNumber();
        }
    }

    public function askPhoneNumber()
    {
        $msg = 'Please put your phone number e.g. 0712345678';
        $error_msg_age = 'Enter a valid Ugandan phone number';
        if ($this->user->phone_number == null) {
            $this->bot->typesAndWaits(1);
            $this->ask($msg, function ($answer, $conversation) use ($error_msg_age) {
                $reply = $answer->getText();

                if (preg_match('/^(\+256|256|07)[0-9]{8,9}$/', $reply)) {
                    if (preg_match("/^\+/", $reply)) {
                        $reply = preg_replace("/^\+/", "", $reply);
                    } elseif (preg_match("/^0/", $reply)) {
                        $reply = preg_replace("/^0/", "256", $reply);
                    }
                    $this->user->phone_number = $reply;
                    $this->user->save();
                    $this->askConsent();
                } else {
                    $conversation->say($error_msg_age);
                    $this->askPhoneNumber();
                }
            });
        } else {
            $this->askConsent();
        }
    }

    public function askConsent()
    {
        $msg = 'Before we proceed. We will use your phone number to further contact you about HIV prevention services through SMS. Shall we proceed?';

        $question = Question::create($msg)
            ->fallback('Unable to create a new database')
            ->callbackId('update_consent')
            ->addButtons([
                Button::create('Yes')->value(1),
                Button::create('No')->value(0),
            ]);

        $this->ask($question, function (Answer $answer) {
            $this->bot->typesAndWaits(1);
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
                $this->user->consent = $selectedValue;
                $this->user->save();
                $this->bot->startConversation(new MainMenu());
                return false;
            }
        });

    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askYearOfBirth();
    }
}
