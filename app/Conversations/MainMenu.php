<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Facebook\Extensions\Element as Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton as ElementButton;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate as ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate as GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\ListTemplate as ListTemplate;

class MainMenu extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    
    public function showMenu(){
        $msg = 'Please select an item from the menu below.';
        $titletext1= 'Where to find free or paid HIV Self Test kit';
        $titletext2 = 'How to use the HIV Self Testing Kit';
        $titletext3 = 'Send HIV self kit test results';
        $titletext4 = 'General Information on HIV Self Testing ';
        $titletext5 = 'Referrals And Linkage Sites';
        $subtitletext1 = 'Pharmacies & Locations';
        $subtitletext2 = 'Instructions & Videos';
        $subtitletext3 = 'Results Intepretation';
        $subtitletext4 = 'Frequently Asked Questions(FAQs)';
        $btn1 = 'View FAQs';
        $btn2 = 'Learn More';
        $btn3 ='Get Kits';
        $btn4 = 'Share Kit Results';
        $btn5 = 'Show Referrals';
        // $btn3 = 'Get Started';
    
        $this->say($msg);
        $this->bot->typesAndWaits(1);
        $this->bot->reply(GenericTemplate::create()
        ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
        ->addElement(
            Element::create($titletext1)
                ->subtitle($subtitletext1)
                ->image(url('images/where-to-buy-menu-1.jpg'))
                ->addButton(ElementButton::create($btn3)
                    ->payload('test')->type('postback'))
        )
        ->addElement(
            Element::create($titletext2)
                ->subtitle($subtitletext2)
                ->image(url('images/instructions-menu-1.jpg'))
                ->addButton(ElementButton::create($btn2)
                    ->payload('instructions')->type('postback')
                )
        )
        ->addElement(
            Element::create($titletext3)
                ->subtitle($subtitletext3)
                ->image(url('images/call-counselor-menu-1.jpg'))
                ->addButton(ElementButton::create($btn4)
                    ->payload('HIV_RESULTS')->type('postback')
                )
        )
        ->addElement(
            Element::create($titletext4)
                ->subtitle($subtitletext4)
                ->image(url('images/FAQS-menu-1.jpg'))
                ->addButton(ElementButton::create($btn1)
                    ->payload('faqs_1')->type('postback')
                )
        )
        ->addElement(
            Element::create($titletext5)
                ->subtitle($subtitletext1)
                ->image(url('images/where-to-buy-menu-1.jpg'))
                ->addButton(ElementButton::create($btn5)
                    ->payload('refer')->type('postback'))
        )
        );
        return false;
    }


    public function run()
    {
        $this->showMenu();
    }
}
