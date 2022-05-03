<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class RapidProController extends Controller
{
    public function addUserToNegativeMessages($user)
    {

        $client = new Client();
        $url = env("RAPID_PRO_URL", "");
        $name = $user->user->name;
        $phone_number = $user->phone_number;
        $response;
        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Authorization' => 'Token ' . env("RAPIDPRO_TOKEN", ""),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "name" => $name,
                    "language" => "eng",
                    "urns" => ["tel:{'.$phone_number.'}"],
                    "groups" => [env("RAPIDPRO_HIV_AWARENESS_MSG_GROUP", "")],
                    "fields" => [
                        env("RAPIDPRO_HIV_AWARENESS_CONTACT_FIELD", "") => date("d-m-Y G:i", time() + 60),
                    ],
                ],
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }

        if (isset($response) && $response->getStatusCode() == 201) {
            return true;
        } else {
            return false;
        }

    }
}
