<?php
return [

    /**
     * کد پذیرندگی
     * Merchant ID
     */

    'merchant_id' => '',

    /**
     * callback url to process payment results after redirecting from payment page
     */

    'callback_route' => '/payments/callback',


    /**
     * List of zarinpal.com APIS
     */

    'apis' => [
        'authority' => 'https://api.zarinpal.com/pg/v4/payment/request.json',
        'payment' => 'https://www.zarinpal.com/pg/StartPay/',
        'verify' => 'https://api.zarinpal.com/pg/v4/payment/verify.json',
        'unverified' => 'https://api.zarinpal.com/pg/v4/payment/unVerified.json',
        'refund' => 'https://api.zarinpal.com/pg/v4/payment/refund.json'
    ],


    /**
     * Default currency to be used in payments
     */
    'currency' => "IRT"
];
