<?php

namespace RahmatWaisi\Zarinpal\Services;

use Illuminate\Http\Response;
use RahmatWaisi\Zarinpal\Exceptions\ZarinpalException;
use RahmatWaisi\Zarinpal\Exceptions\ZarinpalResponseCode;
use RahmatWaisi\Zarinpal\Traits\GetConfigKey;
use RahmatWaisi\Zarinpal\Traits\HttpClient;

abstract class BaseService
{
    use HttpClient;
    use GetConfigKey;

    /**
     * Send request to server
     *
     * @param array $parameters
     * @return mixed
     */
    abstract public function request(array $parameters);

    /**
     * @param $responseResult
     * @return mixed
     * @todo Implement this method and return fields of response that you want
     *
     */
    abstract public function valuesOf($responseResult): array;

    /**
     * @return string
     * @todo Return the url that you want to send request to it.
     */
    abstract public function url(): string;

    /**
     * returns values of $response that you specify in {@link valuesOf()} method
     *
     * @param $response
     * @return array|mixed
     *
     * @throws  ZarinpalException  with error code = 500
     */
    public function response($response)
    {
        if ($response->getStatusCode() == Response::HTTP_OK) {
            if ($response->getBody()) {
                $result = json_decode($response->getBody());
                if (in_array($result->code, [ZarinpalResponseCode::SUCCESS, ZarinpalResponseCode::VERIFIED])) {
                    return $this->valuesOf($result);
                }
                throw new ZarinpalException($result->code);
            }
        }
        throw new ZarinpalException(ZarinpalResponseCode::SERVER_ERROR);
    }

}
