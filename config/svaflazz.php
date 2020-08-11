<?php

return [
    /*
    * Digiflazz will require you to request username and key
    * these will be used for making a request to digiflazz
    */
    'username' => env('DIGIFLAZZ_USERNAME'),
    'key' => env('DIGIFLAZZ_KEY'),

    /*
    * Digiflazz Base URL
    */
    'base_url' => env('DIGIFLAZZ_BASE_URL', 'https://api.digiflazz.com/v1'),
];
