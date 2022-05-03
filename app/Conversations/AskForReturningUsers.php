<?php

namespace App\Conversations;

// namespace BotMan\Drivers\Facebook;

use App\Conversations\AskAgeAndGender;
use App\FbUser;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
// use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
// use BotMan\Drivers\Facebook\Extensions\ListTemplate;
// use BotMan\Drivers\Facebook\Extensions\Element;
//

class AskForReturningUsers extends Conversation
{
    public $bot;
    public $db_user;
    public $age;
    public $gender;
    public $phone;
    public $new_user;

    public function __construct(BotMan $bot)
    {
        $this->bot = $bot;
        $this->db_user = FBUser::where('user_id', $bot->getUser()->getId())->first();
    }

    public function isNewUser()
    {
        // Access user information
        $user = $bot->getUser();
        // Access user psid (page scoped id)
        $psid = $user->getId();
        //get db user
        $db_user = FbUser::where('user_id', $psid)->first();
        if ($db_user != null) {
            // if (FbUser::where('user_id',$psid)->whereNotNull('age')->first() != null){
            //     // $menu = new AskAgeAndGender($bot);
            //     // $menu->displayMainMenu();

            // }
            $this->displayMainMenu();

            // else{
            //     $this->bot->startConversation(new AskAgeAndGender($this->bot));
            //     // $bot->startConversation(new AskAgeAndGender($bot));
            //     FlowRunsController::saveRun($bot,1);
            // }
        } else {
            $this->saveNewUser($user);
            $bot->typesAndWaits(2);
            $bot->reply("Hello, Welcome to the HIV Self-Testing (HIVST) assistant. Here, you will find where to purchase HIV self test kits, guidance on how to test, be able to ask questions and get prompt answers. You will also be able to speak to a health specialist if you need to. Let's proceed!");
            // $bot->startConversation(new AskAgeAndGender($bot));
            $this->bot->startConversation(new AskAgeAndGender($this->bot));
            // FlowRunsController::saveRun($bot,1);
            //return true;
        }
    }

// private function sendIntroMessage(){

//         $this->bot->reply("Welcome to the HIV Self-Testing (HIVST) assistant powered by PATH Uganda. Here, you will find locations where you can get free HIV self test kits, guidance on how to use the HIV self testing kit, be able to ask questions and get prompt answers. Let's proceed!");
    //         // $this->bot->typesAndWaits(2);
    //         // $message = OutgoingMessage::create('atahment');
    //         $this->ReturningUsers();
    //         // $this->bot->startConversation(new AskUserConsent());
    //     }

// public function ReturningUsers(){
    //     $msg = 'Have you used this Bot before?';
    //     $question = Question::create($msg)
    //     ->fallback('Unable to ask returning users')
    //     ->callbackId('ask_returning_users')
    //     ->addButtons([
    //         Button::create('Yes')->value('yes'),
    //         Button::create('No')->value('no'),
    //     ]);
    //       $this->ask($question, function (Answer $answer) {
    //             // Detect if button was clicked:
    //             if ($answer->isInteractiveMessageReply()) {
    //                 $selectedValue = $answer->getValue();
    //                 $selectedText = $answer->getText();
    //                 if ($selectedValue == 'yes'){
    //                     // $this->say('Display menu buttons');
    //                     $this->displayMainMenu();
    //                 }
    //                 else{
    //                     $this->bot->startConversation(new AskAgeAndGender($this->bot));
    //                     // $this->say('Get Demographics data');
    //                 }
    //             }
    //         });
    // }

// public function displayMainMenu(){
    //     $msg = 'Please choose what kind of information you need from the menu below.';
    //     $titletext1= 'General Information on HIV Self Testing';
    //     $titletext2 = 'Where to find free or paid for HIV Self Test kit';
    //     $titletext3 = 'How to use the HIV Self Test Kit';
    //     $titletext4 = 'HIV Self test results intepretation';
    //     $subtitletext1 = 'Frequently Asked Questions (FAQs)';
    //     $subtitletext2 = 'Pharmacies & Locations';
    //     $subtitletext3 = 'Instructions & Videos';
    //     $subtitletext4 = 'Results Intepretation';
    //     $btn1 = 'View';
    //     $btn2 = 'Start';

//     $this->say($msg);

//     $this->bot->reply(ListTemplate::create()
    //     ->useCompactView()
    //     ->addGlobalButton(ElementButton:: create ('Visit Website')
    //     ->url('https://www.path.org/')
    //     )
    //     ->addElement(
    //         Element::create($titletext1)
    //             ->subtitle($subtitletext1)
    //             ->image(url('images/FAQS-menu-1.jpg'))
    //             ->addButton(ElementButton::create($btn1)
    //                 ->payload('faqs_1')->type('postback'))
    //     )
    //     ->addElement(
    //         Element::create($titletext2)
    //             ->subtitle($subtitletext2)
    //             ->image(url('images/where-to-buy-menu-1.jpg'))
    //             ->addButton(ElementButton::create($btn1)
    //                 ->payload('locations_3')->type('postback')
    //             )
    //     )
    //     ->addElement(
    //         Element::create($titletext3)
    //             ->subtitle($subtitletext3)
    //             ->image(url('images/instructions-menu-1.jpg'))
    //             ->addButton(ElementButton::create($btn1)
    //                 ->payload('instructions_2')->type('postback')
    //             )
    //     )
    //     ->addElement(
    //         Element::create($titletext4)
    //             ->subtitle($subtitletext4)
    //             ->image(url('images/instructions-menu-1.jpg'))
    //             ->addButton(ElementButton::create($btn2)
    //                 ->payload('instructions_2')->type('postback')
    //             )
    //     )
    // );
    // }
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        // $this->ReturningUsers();
        // $this->sendIntroMessage();
        $this->isNewUser();
    }
}
