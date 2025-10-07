<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PayHere Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for PayHere payment gateway integration
    |
    */

    'merchant_id' => env('PAYHERE_MERCHANT_ID'),
    'merchant_secret' => env('PAYHERE_MERCHANT_SECRET'),
    'sandbox_mode' => env('PAYHERE_SANDBOX_MODE', true),
    
    'urls' => [
        'sandbox' => 'https://sandbox.payhere.lk/pay/checkout',
        'live' => 'https://www.payhere.lk/pay/checkout',
    ],
];
