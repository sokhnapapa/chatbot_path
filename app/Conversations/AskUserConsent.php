<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\FbUser;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class AskUserConsent extends Conversation
{
    public $bot;
    public $db_user;
    public $contact_user;


    public function __construct(BotMan $bot){
        $this->bot = $bot;
        $this->db_user = FBUser::where('user_id',$bot->getUser()->getId())->first();
    }

    public function UserConsent(){
        if ($this->db_user->lang == 'eng'){
            $msg = 'Before we proceed. We will use your phone number to further contact you about HIV self testing kits and other related services or information regarding HIVST. Shall we proceed?';
        }
        $question = Question::create($msg)
        ->fallback('Unable to consent')
        ->callbackId('user_consent')
        ->addButtons([
            Button::create('Yes')->value('yes'),
            Button::create('No')->value('no'),
        ]);
        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                if ($selectedValue == 'yes'){
                    $this->say('Thank you!');
                    $this->displayMainMenu();
                }
                else{
                    $this->say('Okay Noted.');
                    $this->displayMainMenu();
                }
            }
        });
    }
    // public function displayMainMenu(){
    //     if ($this->language == 'eng'){
    //         $msg = 'Please choose what kind of information you need from the menu below.';
    //         $tt1 = 'General Information on HIV Self Testing';
    //         $tt2 = 'Where to Find free/paid for HIV Self Test kit';
    //         $tt3 = 'How to use the HIV Self Test Kit';
    //         $tt4 = 'HIV Self test results intepretation';
    //         $st1 = 'Frequently Asked Questions (FAQs)';
    //         $st2 = 'Pharmacies & Locations';
    //         $st3 = 'Instructions & Videos';
    //         $st4 = 'Results Intepretation';
    //         $btn1 = 'View';
    //         $btn2 = 'Start';
    //         $btn3 = 'Change Language';
    //     }
    //     $this->bot->typesAndWaits(2);
    //     $this->say($msg);
    //     $this->bot->typesAndWaits(2);
    //     $this->bot->reply(GenericTemplate::create()
    //         ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
    //         ->useCompactView()
    //         ->addGlobalButton(ElementButton::create($btn3)->payload('change_language')->type('postback'))

    //         ->addElement(
    //             Element::create($tt1)
    //                 ->subtitle($st1)
    //                 ->image(url('images/FAQS-menu-1.jpg'))
    //                 ->addButton(ElementButton::create($btn1)
    //                     ->payload('faqs_1')->type('postback'))
    //         )
    //         ->addElement(
    //             Element::create($tt2)
    //                 ->subtitle($st2)
    //                 ->image(url('images/where-to-buy-menu-1.jpg'))
    //                 ->addButton(ElementButton::create($btn1)
    //                     ->payload('locations_3')->type('postback')
    //                 )
    //         )
    //         ->addElement(
    //             Element::create($tt3)
    //                 ->subtitle($st3)
    //                 ->image(url('images/instructions-menu-1.jpg'))
    //                 ->addButton(ElementButton::create($btn1)
    //                     ->payload('instructions_2')->type('postback')
    //                 )
    //         )
    //         ->addElement(
    //             Element::create($tt4)
    //                 ->subtitle($st4)
    //                 ->image(url('images/instructions-menu-1.jpg'))
    //                 ->addButton(ElementButton::create($btn2)
    //                     ->payload('instructions_2')->type('postback')
    //                 )
    //         )
    //     );
    // }

    
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->UserConsent();
    }
}
