<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ibtdi_My_Fatoorah Mode
    |--------------------------------------------------------------------------
    |
    | This option controls the mode for Ibtdi_My_Fatoorah service
    |
    | Supported: "test", "live"
    |
    */

    'mode' => env('IBTDI_MYFATOORAH_MODE', "test"),

    /*
    |--------------------------------------------------------------------------
    | Ibtdi_My_Fatoorah Token
    |--------------------------------------------------------------------------
    |
    | This option controls the token for Ibtdi_My_Fatoorah service
    |
    */

    'token' => env('IBTDI_MYFATOORAH_TOKEN'),
];
