<?php


namespace RahmatWaisi\Zarinpal\Traits;

use GuzzleHttp\Client;

trait HttpClient
{

    /**
     * Creates an instance of @link \GuzzleHttp\Client
     *
     * @return Client
     */
    public function client()
    {
        return new Client();
    }
}
