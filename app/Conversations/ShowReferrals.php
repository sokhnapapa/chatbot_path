<?php

namespace App\Conversations;

use App\Http\Controllers\FlowRunsController;
use App\ReferralsAndLinkagaes;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class ShowReferrals extends Conversation
{

    public $bot;
    protected $user;

    public function __construct(BotMan $bot, $user)
    {
        $this->bot = $bot;
        $this->user = $user;
    }

    public function askLocation()
    {
        $msg = 'Tell us the name of your district. e.g. Kampala/Wakiso/Mukono';

        $this->ask($msg, function ($answer, $conversation) {
            $reply = $answer->getText();
            $this->bot->typesAndWaits(1);
            $this->showPharmacies($reply);
        });

    }

    public function showPharmacies($response)
    {
        // FlowRunsController::saveRun($this->bot, 15);

        $element = $this->sendLocationsList($response);
        if (!empty($element)) {
            $this->bot->reply(GenericTemplate::create()
                    ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                    ->addElements($element)
            );
        } else {
            $this->say('Sorry, there are no available clinics near you. Try again with a different location name or district.');
            $this->askLocation();
        }
    }

    public function sendLocationsList($response)
    {

        $elements = array();
        $pharmacies = ReferralsAndLinkagaes::where('district', 'like', "%" . $response . "%")->orderBy('id', 'asc')->take(8)->get();
        for ($i = 0; $i < count($pharmacies); $i++) {
            $element = Element::create($pharmacies[$i]->facility_name, 0, 15)
                ->subtitle(substr($pharmacies[$i]->district . ', ' . $pharmacies[$i]->level, 0, 20) . '...')
                ->image(url('images/where-to-buy-menu-1.jpg'))
                ->addButton(ElementButton::create('View on Map')
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
        $this->askLocation();
    }
}
