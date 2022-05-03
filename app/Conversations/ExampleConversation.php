<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

use BotMan\Drivers\Facebook\Extensions\Element as Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton as ElementButton;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate as ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate as GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\ListTemplate as ListTemplate;

class ExampleConversation extends Conversation
{
    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create("Huh - you woke me up. What do you need?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Tell a joke')->value('joke'),
                Button::create('Give me a fancy quote')->value('quote'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'joke') {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say($joke->value->joke);
                } else {
                    $this->say(Inspiring::quote());
                }
            }
        });
    }

    public function testWebview(){

        $this->bot->reply(ButtonTemplate::create('Do you want to get a free HIVST Kit?')
	        ->addButton(ElementButton::create('Free Kit')
            ->type('web_url')
            ->url('https://path.tmcg.africa/instruction')
            ->enableExtensions()
        )
            ->addButton(ElementButton::create('Get a Kit')
            ->url('https://path.tmcg.africa/instruction')
            ->heightRatio(ElementButton::RATIO_TALL)
            ->enableExtensions()
            
        )
    );


        $button = ElementButton::create('View Item')
            ->url('https://path.tmcg.africa/instruction')
            ->heightRatio(ElementButton::RATIO_TALL)
            ->enableExtensions();
        
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        // $this->askReason();
        $this->testWebview();
    }
}
