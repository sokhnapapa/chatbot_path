<?php

namespace App\Http\Controllers;

use App\Conversations\AskLocations;
use App\Conversations\ExampleConversation;
use App\Conversations\MainMenu;
use App\Conversations\OnBoarding;
use App\Conversations\PositiveResults;
use App\Conversations\ResultInterpretation as ResultInterpretationConversation;
use App\Conversations\ShowLocations;
use App\Conversations\ShowReferrals;
use App\Conversations\ShowInstructions;

use App\FacebookUser;
use App\HIVResults;
use App\User;
use BotMan\BotMan\BotMan;
use BotMan\Drivers\Facebook\FacebookDriver;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    protected $bot;

    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */

     //onboarding questions
    public function startConversation(BotMan $bot)
    {

        $user = $bot->getUser();
        $ps_id = $user->getId();
        if ($ps_id) {
            $bot_user = $this->getCurrentBotUser($bot);
            if (!$bot_user) {
                $bot->reply('Hi, welcome to PATH HIV self testing kit chatbot where you will find instructions on how to use HIV self testing kit. Get pharmacies locations and where you get find free or Paid for HIV self testing kits. Answer these questions before we proceed.');
                //totally new user
                $fb_user = $this->saveNewBotUser($bot->getUser());
                $bot->startConversation(new OnBoarding($fb_user));
            } else if ($bot_user->consent === null) {
                //if user not yet consented
                $bot->startConversation(new OnBoarding($bot_user));
            } else {
                $bot->startConversation(new MainMenu());
            }
        } else {
            $bot->reply("We are sorry we are unable to help you in a moment, Try later");
        }

        //Log::debug($bot_user);
    }


    //main menu display
    public function displayMainMenu(BotMan $bot)
    {
        $bot->startConversation(new MainMenu());
    }

    //results interpretation
    public function resultInterpretation(BotMan $bot)
    {
        $user = $this->getCurrentBotUser($bot);
        if ($user) {
            $bot->startConversation(new ResultInterpretationConversation($user));
        }
    }
    //show instructions and videos
    public function showInstructions(Botman $bot){
        $user = $this->getCurrentBotUser($bot);
        if ($user) {
            $bot->startConversation(new ShowInstructions());
        }
    }

    //show pharmacies and eligibility test
    public function getTestingKit(BotMan $bot)
    {
        $user = $this->getCurrentBotUser($bot);
        if ($user) {
            $bot->startConversation(new ShowLocations($bot, $user));
        } else {
        }

    }
    //consent to be uploaded to rapid pro
    public function askConsent(Botman $bot)
    {
        $user = $this->getCurrentBotUser($bot);
        $bot->startConversation(new Consent($user));
    }

    public function checkIfConsented($user_id)
    {
        return true;
    }
    //show referealls and linkages sites
    public function showReferrals(Botman $bot)
    {
        $user = $this->getCurrentBotUser($bot);
        if ($user) {
            $bot->startConversation(new ShowReferrals($bot, $user));
        }
    }
    //save new bot user
    public function saveNewBotUser($bot_user)
    {
        //Log::debug(print_r($bot_user, true));
        $_user = new User;
        $_user->name = $bot_user->getFirstName() . " " . $bot_user->getLastName();
        $_user->save();

        $fb_user = new FacebookUser;
        $fb_user->user_id = $_user->id;
        $fb_user->ps_id = $bot_user->getId();
        $fb_user->save();
        return $fb_user;
    }
    //facility reminder
    public function askIfVisitedHealthyFacilityResults()
    {
        $botman = resolve('botman');
        //get all results which are positive and
        $positive_un_answered_results = HIVResults::distinct()->where('result', 'positive')->where('art_number', null)->get();
        $positive_un_answered_results->each(function ($result, $key) use ($botman) {
            $user = User::where('id', $result->user_id)->get()->first();
            $fb_user = FacebookUser::where('user_id', $result->user_id)->get()->first();
            $botman->startConversation(new PositiveResults($fb_user), $fb_user->ps_id, FacebookDriver::class);
        });

    }

    public function getCurrentBotUser($bot)
    {
        $user = $bot->getUser();
        $ps_id = $user->getId();
        return FacebookUser::where('ps_id', $ps_id)->first();
    }

    public function startConversa(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }



}
