<?php

namespace App\Conversations;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Question;

class ShowInstructions extends Conversation
{
    
    public function askKitType()
    {
        // FlowRunsController::saveRun($this->bot,3);
        $this->bot->typesAndWaits(1);

        $question = Question::create("Please select the type of Kit you are interested in")
            ->fallback('Unable to ask kit type question')
            ->callbackId('ask_kit_type')
            ->addButtons([
                Button::create('Oraquick (Oral)')->value('Oral'),
                Button::create('Insti (Blood)')->value('Blood'),
            ]);

        return $this->ask($question, function (Answer $answer) {

            if ($answer->isInteractiveMessageReply()) {
                $kit_type = $answer->getValue();
                $this->sendVideo($kit_type); 
            }
        });
    }
    

    public function sendVideo($kit_type){

        if ($kit_type == 'Oral') {

            $url = new Video('https://path.tmcg.africa/videos/oral-kit-en.mp4', ['custom_payload' => true,]);
            $message = OutgoingMessage::create('Here is a short video to illustrate how you can use the Oraquick (Oral) HIV Self Test Kit.') ->withAttachment($url);

            $this->say('Here is a short video to illustrate how you can use the Oraquick (Oral) HIV Self Test Kit.');
            $this->bot->typesAndWaits(2);
            $this->say('Click video to play it. If you need more information on HIV self testing, call the toll free number 0800205555 for more information.');
            $this->say($message);

        }elseif($kit_type == 'Blood') {

            $url = new Video('https://path.tmcg.africa/videos/blood-kit-en.mp4', ['custom_payload' => true,]);
            $message = OutgoingMessage::create('Here is a short video to illustrate how you can use the Insti (Blood) HIV Self Test Kit.')->withAttachment($url);
            $this->say('Here is a short video to illustrate how you can use the Insti (Blood) HIV Self Test Kit.');
            $this->bot->typesAndWaits(2);
            $this->say('Click video to play it. If you need more information on HIV self testing, call the toll free number 0800205555 for more information.');
            $this->say($message);
        } 
    }


    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askKitType();
    }
}
