<?php

namespace App\Http\Controllers;

use App\FacebookUser;
use App\HIVResults;
use App\UnSureResults;
use BotMan\Drivers\Facebook\FacebookDriver;
use Illuminate\Http\Request;

class UnsureResultsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $results = UnSureResults::where('status', 0)->get();
        return view('unsure/index', compact('results'));
    }

    public function update_hiv_result(Request $request)
    {
        $result_id = $request->result_id;
        $result = HIVResults::where('id', $result_id)->first();
        $result->update(['result' => $request->status]);

        $unsure_result = UnSureResults::where('hiv_result_id', $result_id);
        $unsure_result->update(['status' => 1]);

        $fb_user = FacebookUser::where('user_id', $result->user_id)->first();
        $ps_id = $fb_user->ps_id;

        $botman = resolve('botman');
        $botman->typesAndWaits(2);
        $botman->say('Hi,' . $fb_user->user->name . " your screening result is " . $request->status, $ps_id, FacebookDriver::class);

        if ($request->status == 'positive') {
            $botman->say('Note: This is not a confirmatory test result. Please visit your nearest health facility for confirmatory HIV testing');
        } else {

        }
        return redirect('unsure');
    }
}
