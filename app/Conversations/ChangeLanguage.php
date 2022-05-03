<?php

namespace App\Conversations;


use App\FbUser;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ChangeLanguage extends Conversation
{
    public $bot;
    public $db_user;
    public function __construct(BotMan $bot){
        $this->bot = $bot;
        $this->db_user = FBUser::where('user_id',$bot->getUser()->getId())->first();
    }

    public function AskchangeLanguage(){
        $msg = 'Choose Language you want to use today';

        $question = Question::create($msg)
            ->fallback('Unable to ask language change')
            ->callbackId('ask_language_change')
            ->addButtons([
                Button::create('English')->value('eng'),
                // Button::create('Kiswahili')->value('swa'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                //$selectedText = $answer->getText();
                if ($selectedValue == 'eng'){
                    $this->db_user->lang = 'eng';
                    $this->db_user->save();
                    $this->bot->typesAndWaits(2);
                    $this->say('You selected English.');
                    $this->bot->typesAndWaits(2);
                    $this->say('Remember to always type \'menu\' to return to the main menu');
                    $this->bot->startConversation(new AskForReturningUsers());
                }
                else{
                    $this->changeLanguage();
                }
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->say('Welcome');
        $this->bot->typesAndWaits(2);
        $this->AskchangeLanguage();
    }
} 