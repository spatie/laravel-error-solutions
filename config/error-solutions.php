<?php

return [
    /**
     * Display the error share button in the error page.
     */
    'enabled' => true,

    /**
     * This is the URL where the error will be sent to.
     *
     * In most cases, you will not need to change this value.
     */
    'endpoint' => env('ERROR_SHARE_ENDPOINT', 'https://flareapp.io/'),
];
