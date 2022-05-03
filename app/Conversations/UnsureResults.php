<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\UnSureResults as UnSureResultsModel;

class UnsureResults extends Conversation
{
    protected $user;
    protected $result_id;
    
    function __construct($user , $result_id)
    {
        $this->user = $user;
        $this->result_id = $result_id;
        # code...
    }

    public function askUserToSharePhoto(Type $var = null)
    {
        $this->bot->typesAndWaits(1);
        $this->askForImages('Please upload an image.', function ($images) {
              $un_sure_res = new UnSureResultsModel();
              $un_sure_res->hiv_result_id = $this->result_id;
              $un_sure_res->image_url = $images[0]->getUrl();
              $un_sure_res->save();
              $this->bot->typesAndWaits(1);
              $this->say("Thank you, you should receive receive your results in 24 Hours");
        });
    }
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askUserToSharePhoto();
    }
}
