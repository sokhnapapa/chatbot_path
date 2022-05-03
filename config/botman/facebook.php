<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Facebook Token
    |--------------------------------------------------------------------------
    |
    | Your Facebook application you received after creating
    | the messenger page / application on Facebook.
    |
     */
    'token' => env('FACEBOOK_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Facebook App Secret
    |--------------------------------------------------------------------------
    |
    | Your Facebook application secret, which is used to verify
    | incoming requests from Facebook.
    |
     */
    'app_secret' => env('FACEBOOK_APP_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Facebook Verification
    |--------------------------------------------------------------------------
    |
    | Your Facebook verification token, used to validate the webhooks.
    |
     */
    'verification' => env('FACEBOOK_VERIFICATION'),

    /*
    |--------------------------------------------------------------------------
    | Facebook Start Button Payload
    |--------------------------------------------------------------------------
    |
    | The payload which is sent when the Get Started Button is clicked.
    |
     */
    'start_button_payload' => 'GET_STARTED',

    /*
    |--------------------------------------------------------------------------
    | Facebook Greeting Text
    |--------------------------------------------------------------------------
    |
    | Your Facebook Greeting Text which will be shown on your message start screen.
    |
     */
    'greeting_text' => [
        'greeting' => [
            [
                'locale' => 'default',
                'text' => 'An HIV Self-Testing (HIVST) assistant that guides you on where to find free HIV Self Test kits,how to test, ask questions and get answers from health specialists.',
            ],
            [
                'locale' => 'en_US',
                'text' => 'An HIV Self-Testing (HIVST) assistant that guides you on where to find free HIV Self Test kits,how to test, ask questions and get answers from health specialists.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Facebook Persistent Menu
    |--------------------------------------------------------------------------
    |
    | Example items for your persistent Facebook menu.
    |
     */
    'persistent_menu' => [
        [
            'locale' => 'default',
            'composer_input_disabled' => 'false',
            'call_to_actions' => [
                [
                    'title' => 'Main Menu',
                    'type' => 'postback',
                    'payload' => 'main_menu',
                ],
                [
                    'title' => 'View FAQs',
                    'type' => 'postback',
                    'payload' => 'faqs_1',
                ],
                [
                    'title' => 'Instructions and Guides',
                    'type' => 'postback',
                    'payload' => 'instructions',
                ],
                [
                    'title' => 'Find Free Kits',
                    'type' => 'postback',
                    'payload' => 'test',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Facebook Domain Whitelist
    |--------------------------------------------------------------------------
    |
    | In order to use domains you need to whitelist them
    |
     */
    'whitelisted_domains' => [
        'https://path.tmcg.africa',
        'https://5dbc-85-203-44-132.ngrok.io',
    ],
];
