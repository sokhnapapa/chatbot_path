<?php

namespace App\Conversations;

use App\Pharmacy;
use App\ReferralsAndLinkagaes;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
class AskLocations extends Conversation
{

    function askLocation(){
        $msg = 'Please tell us your nearest town e.g. Kyengera, Wantoni, Banda, Kamyokya, Nabweru, Nkumba, or Makerere ';

        $this->ask($msg, function ($answer, $conversation) {
            $reply = $answer->getText();
            $this->bot->typesAndWaits(1);
//            $this->user->location = $reply;
//            $this->user->save();
            $this->showPharmacies($reply);
//            $this->sendLocationsList($reply);
        });

    }


    public function showPharmacies($response)
    {
        // FlowRunsController::saveRun($this->bot, 15);
        //botman generic scroll list to show the list of hospitals

//        Log::info("hey");
        $element = $this->sendLocationsList($response);
        if (!empty($element)) {
            $this->bot->reply(GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                ->addElements($element)
            );
        } else {
            $this->say('Sorry, there are no available pharmacies giving out free HIV self testing kit near you. Try again with a different location name');
            $this->bot->typesAndWaits(2);
            $this->askLocation();
        }
    }

    public function sendLocationsList($response)
    {
        //make a list of pharmacy or clinics
        $elements = array();
        $pharmacies = Pharmacy::where('village', 'like', "%" . $response . "%")->orderBy('id', 'asc')->take(10)->get();
        for ($i = 0; $i < count($pharmacies); $i++) {
            $element = Element::create($pharmacies[$i]->facility_name)
                ->subtitle(substr($pharmacies[$i]->village . ', ' . $pharmacies[$i]->sub_county, 0, 60) . '...')
                ->image(url('images/where-to-buy-menu-1.jpg'))
                ->addButton(ElementButton::create('Call Representative')
                    ->payload("0750538391")->type('phone_number')); #$pharmacies[$i]->phone_number
            array_push($elements, $element);
        }
        return $elements;
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->say ('You qualify for a free HIV self testing kit.');
        $this->bot->typesAndWaits(2);
        $this->askLocation();
    }
}
