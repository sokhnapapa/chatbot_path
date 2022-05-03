<?php

namespace App\Conversations;

use App\Conversations\Consent;
use App\Conversations\PositiveResults;
use App\Conversations\UnsureResults;
use App\HIVResults;
use App\HIVSTRequestedKitsResult;
use App\Http\Controllers\HIVSTRequestController as HIVSTRequest;
use App\Http\Controllers\RapidProController;
use App\PositiveResult as PositiveResultsModel;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ResultInterpretation extends Conversation
{
    protected $user;
    protected $used_kit;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function askIfUsedBotToGetKit()
    {
        $msg = 'Are these results from the latest kit you obtained from this bot';
        $question = Question::create($msg)
            ->fallback('Unable to understand results')
            ->callbackId('ask_test_results')
            ->addButtons([
                Button::create('Yes')->value(1),
                Button::create('No')->value(0),
            ]);

        $request_kit = HIVSTRequest::getUserLastestRequestedKitWithOutResults($this->user->user_id);

        if ($request_kit) {
            $this->ask($question, function (Answer $answer) use ($request_kit) {
                $this->bot->typesAndWaits(1);
                if ($answer->isInteractiveMessageReply()) {
                    $selectedValue = $answer->getValue();
                    $selectedText = $answer->getText();
                    if ($selectedValue == 1) {
                        $this->used_kit = $request_kit->id;
                        $this->askHIVResults();
                    } else {
                        $this->askHIVResults();
                    }
                }
            });
        } else {
            $this->askHIVResults();
        }
        return false;
    }

    public function askHIVResults()
    {
        $msg = 'Share with us your HIVST results';

        $question = Question::create($msg)
            ->fallback('Unable to understand results')
            ->callbackId('ask_test_results')
            ->addButtons([
                Button::create('Positive')->value('positive'),
                Button::create('Negative')->value('negative'),
                Button::create('Unsure')->value('unsure'),
            ]);

        $this->ask($question, function (Answer $answer) {
            $this->bot->typesAndWaits(1);
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedText = $answer->getText();
                $results = new HIVResults();
                $results->user_id = $this->user->user_id;
                $results->result = $selectedValue;
                $results->save();
                if ($this->used_kit) {
                    //Add kit to
                    $used_kit_result = new HIVSTRequestedKitsResult();
                    $used_kit_result->requested_kit = $this->used_kit;
                    $used_kit_result->result = $results->id;
                    $used_kit_result->save();
                }
                $this->bot->typesAndWaits(1);
                if ($selectedValue == 'negative') {
                    if ($this->user->consent) {
                        $results = (new RapidProController())->addUserToNegativeMessages($this->user);

                        if ($results) {
                            $this->bot->typesAndWaits(1);
                            $this->say("We have subscribed you to HIV/AIDS prevention messages");
                        }

                    } else {
                        $this->bot->startConversation(new Consent($this->user, 'add_to_rapid_pro'));
                    }

                } else if ($selectedValue == 'positive') {
                    $positive_results = new PositiveResultsModel();
                    $positive_results->result_id = $results->id;
                    $positive_results->save();
                    $this->say('Thank you for using the self test. It is important that you do a confirmatory test at a referral health facility.');
                    $this->bot->startConversation(new PositiveResults($this->user));
                } else {

                    $this->bot->startConversation(new UnsureResults($this->user, $results->id));
                }
            }
        });
    }
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askIfUsedBotToGetKit();
    }
}
