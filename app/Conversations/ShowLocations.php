<?php

namespace App\Conversations;

use App\EligibilityTestQuestion;
use App\EligibilityTestQuestionAnswer;
use App\Http\Controllers\FlowRunsController;
use App\Location;
use App\Pharmacy;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class ShowLocations extends Conversation
{
    public $bot;
    protected $user;
    protected $lat;
    protected $lon;
    protected $question_bank;
    protected $cursor = 0;
    protected $last_question_id;
    protected $eligible = false;

    public function __construct(BotMan $bot, $user)
    {
        $this->bot = $bot;
        $this->user = $user;
        $this->makeQuestionsBank();
    }

    public function showWebview()
    {

        $this->bot->reply(ButtonTemplate::create('Do you want to get a free HIVST Kit? Click the button to take the eligibility test.')
                ->addButton(ElementButton::create('Take Test')
                        ->type('web_url')
                        ->url('https://path.tmcg.africa/instruction?ps_id=' . $this->user->ps_id)
                        // ->url('https://0a506a36c833.ngrok.io/instruction?ps_id=' . $this->user->ps_id)
                        ->heightRatio(ElementButton::RATIO_TALL)
                        ->enableExtensions()
                )

        );
    }

    public function makeQuestionsBank()
    {
        $elements = array();
        $question_bank = EligibilityTestQuestion::orderBy('id', 'asc')->get();

        for ($i = 0; $i < count($question_bank); $i++) {
            $question = Question::create($question_bank[$i]->question)
                ->fallback('unable to ask question')
                ->callbackId('ask_eligibility_')
                ->addButtons([
                    Button::create('YES')->value(implode(',', [1, $question_bank[$i]->id])),
                    Button::create('NO')->value(implode(',', [0, $question_bank[$i]->id])),
                ]);
            array_push($elements, $question);
        }
        // $this->question_bank=$elements;
        $this->question_bank = $elements;
    }

    public function askEligibilityQuestions()
    {
        $this->ask($this->question_bank[$this->cursor], function ($answer, $bot) {
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = explode(",", $answer->getValue()); // will be either 'yes' or 'no'
                $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
                $question_answer = new EligibilityTestQuestionAnswer();
                $question_answer->user_id = $this->user->id;
                $question_answer->answer = $selectedValue[0];
                $question_answer->question_id = $selectedValue[1];
                $question_answer->save();

                $this->cursor++;
                $question_count = count($this->question_bank);

                if ($this->cursor == $question_count) {
                    $eligibility_answers = EligibilityTestQuestionAnswer::where('user_id', $this->user->id)
                        ->orderBy('id', 'desc')
                        ->limit($question_count)
                        ->get();
                    $this->eligible = $eligibility_answers->contains(function ($answer) {
                        return $answer->answer == 1;
                    });
                    if ($this->eligible) {
                        $this->say("You qualify for a free HIV self testing kit");
                        $this->bot->typesAndWaits(2);
                        $this->askLocation();

                    } else {
                        $this->say("You don't qualify for a free HIV self testing kit.");

                        $this->say("However, you can purchase one from https://www.rockethealth.shop");
                    }

                } else {
                    $this->askEligibilityQuestions();
                }
            }
        });
    }

    public function askLocation()
    {
        $msg = 'Please tell us your nearest town e.g. Kyengera/Wantoni/Banda/Kamyokya/Nabweru/Nkumba/Makerere ';

        $this->ask($msg, function ($answer, $conversation) {
            $reply = $answer->getText();
            $this->bot->typesAndWaits(1);
            $this->user->location = $reply;
            $this->user->save();
            $this->showPharmacies($reply);
        });

    }

    public function showPharmacies($response)
    {
        // FlowRunsController::saveRun($this->bot, 2);

        $element = $this->sendLocationsList($response);
        if (!empty($element)) {
            $this->bot->reply(GenericTemplate::create()
                    ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                    ->addElements($element)
            );
        } else {
            $this->say('Sorry, there are no available pharmacies giving out free HIV self testing kit near you. Try again with a different location name');
        }
    }

    public function sendLocationsList($response)
    {

        $elements = array();
        $pharmacies = Pharmacy::where('village', 'like', "%" . $response . "%")->orderBy('id', 'asc')->take(4)->get();
        for ($i = 0; $i < count($pharmacies); $i++) {
            $element = Element::create($pharmacies[$i]->facility_name)
                ->subtitle(substr($pharmacies[$i]->village . ', ' . $pharmacies[$i]->sub_county, 0, 40) . '...')
                ->image(url('images/where-to-buy-menu-1.jpg'))
                ->addButton(ElementButton::create('Call Representative')
                ->payload("0750538391")->type('phone_number')); #$pharmacies[$i]->phone_number
            array_push($elements, $element);
        }
        return $elements;
    }
    /**
     * Start the conversation
     */
    public function run()
    {
//         $this->say('Before we proceed. Please answer YES or NO to the following questions for us to know if you qualify for a free HIV self testing kit');
        $this->bot->typesAndWaits(1);
//         $this->askEligibilityQuestions();
        $this->showWebview();

    }
}
