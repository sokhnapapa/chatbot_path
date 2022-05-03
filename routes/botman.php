<?php
use App\Conversations\ShowFaqs;
use App\Conversations\ShowInstructions;
use App\Conversations\ShowLocations;
use App\Conversations\ShowLocationsByCounty;
use App\Conversations\TalkToCounselor;
use App\Conversations\TestFollowup;
use App\Conversations\ResultsDisclosure;
use App\Conversations\ShowReferrals;
use App\Conversations\AskLocations;

use App\FbUser;
use App\Http\Controllers\FlowRunsController;
use App\Http\Controllers\NewUserController;

use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Drivers\DriverManager;

// use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
// use BotMan\Drivers\Facebook\Extensions\ElementButton;

DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookImageDriver::class);
DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookLocationDriver::class);

$botman = resolve('botman');
//The get started menu
$botman->hears('GET_STARTED', BotManController::class . '@startConversation')->stopsConversation();

$botman->hears('main_menu', BotManController::class . '@startConversation')->stopsConversation();

// Result interpretation

$botman->hears('HIV_RESULTS', BotManController::class . '@resultInterpretation')->stopsConversation();

$botman->hears('stop', function ($bot) {
    $bot->reply('stopped');
})->stopsConversation();

//main menu payload
$botman->hears('faqs_1', function ($bot) {
    $bot->startConversation(new ShowFaqs($bot));
})->stopsConversation();

//single faq payload details
$botman->hears('faq__{id}', function ($bot, $id) {
    $faq_details = new ShowFaqs($bot);
    $faq_details->showFaqDetails($id);
});

//test instructions
$botman->hears('instructions', BotManController::class .'@showInstructions')->stopsConversation();

//capture location sharing type
$botman->hears('test', BotManController::class . '@getTestingKit')->stopsConversation();

//tetsing referrals and linkages
$botman->hears('refer', BotManController::class . '@showReferrals')->stopsConversation();


// $botman->hears('location', BotManController::class.'@AskLocations')->stopsConversation();

//end bot testing

$botman->fallback(BotManController::class . '@startConversation');
