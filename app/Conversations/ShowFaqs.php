<?php

namespace App\Conversations;

use App\Faq;
use App\FaqAction;
use App\Http\Controllers\FlowRunsController;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class ShowFaqs extends Conversation
{
    public $bot;
    public function __construct(BotMan $bot)
    {
        $this->bot = $bot;
    }
    /**
     * First question
     */
    public function showAllFaqs()
    {
        // FlowRunsController::saveRun($this->bot,2);
        $this->bot->reply(GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                ->addElements($this->makeTemplateElements())
        );
    }

    public function makeTemplateElements()
    {
        $elements = array();
        $faqs = Faq::orderBy('id', 'asc')->take(7)->get();
        for ($i = 0; $i < count($faqs); $i++) {
            $element = Element::create($faqs[$i]->title)
                ->subtitle(substr($faqs[$i]->body, 0, 40) . '...')
                ->image('https://path.tmcg.africa/images/' . $faqs[$i]->image)
                ->addButton(ElementButton::create('tell me more')
                        ->payload('faq__' . $faqs[$i]->id)->type('postback'));
            array_push($elements, $element);
        }
        $element = Element::create("Can't find what you're looking for?")
            ->subtitle('Here are more options you can try')
            ->image(url('images/more-options-1.jpg'))
            ->addButton(ElementButton::create('visit website')->url('https://path.org'))
            ->addButton(ElementButton::create('More FAQs')
                    ->payload('ask_question')->type('postback'));
        array_push($elements, $element);
        return $elements;
    }

    public function showFaqDetails($this_faq)
    {
        // FlowRunsController::saveRun($this->bot, 9);
        $faq = Faq::find($this_faq);
        if ($faq != null) {

            $faq_title = $faq->title;
            $faq_body = $faq->body;
        }
        if ($faq->image != null) {
            $attachment = new Image(asset('images/' . $faq->image));
            $message = OutgoingMessage::create($faq->body)
                ->withAttachment($attachment);
            $this->say($faq_title);

            // $this->bot->reply($message);

            $this->bot->typesAndWaits(2);
            $this->say($faq_body);
        } else {
            $this->say($faq_title);
            $this->bot->typesAndWaits(2);
            $this->say($faq_body);
        }

        if ($faq->actions != null) {
            $this->sendFaqActions($faq->actions);
        } else {
            $this->ask('Please Select a question', function (Answer $answer) {
                // Save result
                $this_faq = $answer->getText();
                $this->showFaqDetails($this_faq);

            });
        }
    }

    public function sendFaqActions($actions)
    {

        // $msg = 'What Next?';
        // $question = Question::create($msg)
        // ->fallback('Unable to ask returning users')
        // ->callbackId('ask_returning_users')
        // ->addButtons([
        //     Button::create('View More FAQs')->value('faqs'),
        //     Button::create('Main Menu')->value('main'),
        // ]);
        // $this->ask($question, function (Answer $answer) {
        //         // Detect if button was clicked:
        //         if ($answer->isInteractiveMessageReply()) {
        //             $selectedValue = $answer->getValue();
        //             $selectedText = $answer->getText();
        //             if ($selectedValue == 'faqs'){
        //                 $bot->startConversation(new ShowFaqs($bot));
        //             }
        //             else{
        //                 $this->bot->startConversation(new AskAgeAndGender($this->bot));
        //                 // $this->say('Get Demographics data');
        //             }
        //         }
        //     });

        $buttons = array();
        if (stristr($actions, ',')) {
            $all_actions = explode(',', $actions);
            foreach ($all_actions as $action) {
                $action = FaqAction::find((int) $action);
                array_push($buttons, Button::create($action->title)->value($action->payload));
            }
        } else {
            $action = FaqAction::find((int) $actions);
            array_push($buttons, Button::create($action->title)->value($action->payload));
        }

        $question = Question::create('View More FAQs')
            ->fallback('Unable to post next')
            ->callbackId('after_faq')
            ->addButtons($buttons);

        $this->ask($question, function (Answer $answer) use ($actions) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
                if ($selectedValue == 'go_to_main_menu') {
                    $this->bot->startConversation(new MainMenu());
                }
            } else {
                $this->sendFaqActions($actions);
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->showAllFaqs();
    }
}
