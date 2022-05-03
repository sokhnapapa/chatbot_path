<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Conversations\TalkToCounselor;
use App\Conversations\TestFollowup;

use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Facebook\FacebookDriver;

use App\EligibilityTestQuestion;
use App\EligibilityTestQuestionAnswer;
use App\FacebookUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

DriverManager::loadDriver(FacebookDriver::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('location/{lat}/{lng}', 'LocationsController@show');

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
Route::get('/botman/send_message', 'BotManController@askIfVisitedHealthyFacilityResults');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/unsure', 'UnsureResultsController@index')->name('unsure');
Route::get('/unsure/set_result', 'UnsureResultsController@update_hiv_result');

Route::get('/instruction', function () {
    $question_bank = EligibilityTestQuestion::orderBy('id', 'asc')->get();
    return view('instruction', compact('question_bank'));
});

Route::post('/instruction', function (Request $request) {
    $user = FacebookUser::where('ps_id', $request->ps_id)->first();

    $filtered = collect($request->all())->filter(function ($value, $key) {
        return is_numeric($key);
    })->map(function ($answer, $question) use ($user) {
        return [
            'user_id' => $user->user_id,
            'question_id' => $question,
            'answer' => $answer,
        ];
    })->toArray();

    // Log::info($filtered);
});

Route::post('/saving_answer', function (Request $request) {
    $user = FacebookUser::where('ps_id', $request->ps_id)->first();

    $filtered = collect($request->all())->filter(function ($value, $key) {
        return is_numeric($key);
    })->map(function ($answer, $question) use ($user) {
        return [
            'user_id'=>$user->user_id,
            'question_id'=>$question,
            'answer'=>$answer,
            'created_at' => now(),
            'updated_at' => now()
        ];
    })->toArray();

    EligibilityTestQuestionAnswer::insert($filtered);

    // Log::info($filtered);
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::view('/privacy-policy', 'privacy-policy');

Route::get('/close-webview', function (Request $request)
{
//    LOG::info($request);
    // get fb user using PSID
    $fb_user = FacebookUser::where('ps_id', $request->ps_id)->first();

    $eligibility_answers = EligibilityTestQuestionAnswer::where('user_id', $fb_user->user_id)
        ->latest()
        ->get()
        ->unique('question_id')
        ->filter(function($val){
            return $val->answer == 1;
        });

//    LOG::info($eligibility_answers);

    $bot = resolve('botman');

    if ($eligibility_answers->count() > 0){
//        $msg = "You qualify for a free HIV self testing kit.";
        $bot->startConversation(new \App\Conversations\AskLocations(), $request->ps_id, FacebookDriver::class);

    }else{
        $msg = "You don't qualify for a free HIV self testing kit. However, you can buy one online from www.rockethealth.shop";
//        $msg1 = "Remember to always type menu to get back to the main menu and select a service.";
        $bot->say($msg, $request->ps_id, FacebookDriver::class);
    }
});
