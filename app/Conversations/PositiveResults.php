<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\PositiveResult as PositiveResultsModel;
use App\User;
use App\HIVResults;

class PositiveResults extends Conversation
{
    protected $user;

    public function __construct($user) {
        $this->user = $user;
    }
    public function askIfUserVisitedHealthCenter()
    {
        $question = Question::create('Have you gone to the health center for HIV confirmatory test?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Yes')->value('yes'),
            Button::create('No!')->value('no'),
        ]);
        $this->bot->typesAndWaits(1);
        $this->ask($question,function ($answer, $conversation){
            if($answer->isInteractiveMessageReply()){
                $selectedValue = $answer->getValue();
                if($selectedValue == 'no'){
                    $this->say('Please plan to go to a health center near you for confirmatory test. We will remind you after one week');
                    //Trigger to run this again after one week
                }else{
                    $this->askARTNumber();
                }
            }
        });
    }

    public function askARTNumber()
    {
        $this->bot->typesAndWaits(1);
        $this->ask("Please share your HIV clinic number (ART number)",function ($answer, $conversation){
                $reply = $answer->getText();
                $this->bot->typesAndWaits(1);
                $user = User::where('id',$this->user->user_id)->get()->first();
                $result = HIVResults::where('user_id',$user->id)->get()->last();
                $result->art_number =  $reply;
                $result->save();
                $this->say("Thank you for sharing your ART Number, we will share your number to a health service provider to contact you.");
        });
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askIfUserVisitedHealthCenter();
    }
}
