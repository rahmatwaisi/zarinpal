<?php

namespace RahmatWaisi\Zarinpal\Services;

use GuzzleHttp\RequestOptions;
use Illuminate\Http\Response;
use RahmatWaisi\Zarinpal\Exceptions\ZarinpalException;
use RahmatWaisi\Zarinpal\Util\ZarinpalResponseCode;
use RahmatWaisi\Zarinpal\Traits\GetConfigKey;
use RahmatWaisi\Zarinpal\Traits\HttpClient;

abstract class BaseService
{
    use HttpClient;
    use GetConfigKey;

    /**
     * Prepares request and sends it to server
     *
     * @param string $requestOption request body
     * @param array $parameters
     * @param array|null $headers
     * @return mixed
     */
    private function request(array $parameters, string $requestOption, array $headers = null)
    {
        $options[$requestOption] = $parameters;
        if (!is_null($headers) && !empty($headers))
            $options['headers'] = $headers;

        return $this->sendRequest($options);
    }

    /**
     * Prepares json request and sends it to server
     *
     * @param array $parameters
     * @param array|null $headers
     * @return mixed
     */
    public function jsonRequest(array $parameters, array $headers = null)
    {
        return $this->request($parameters, RequestOptions::JSON, $headers);
    }

    /**
     * Prepares form request and sends it to server
     *
     * @param array $parameters
     * @param array|null $headers
     * @return mixed
     */
    public function formRequest(array $parameters, array $headers = null)
    {
        return $this->request($parameters, RequestOptions::FORM_PARAMS, $headers);
    }

    /**
     * Prepares multipart request and sends it to server
     *
     * @param array $parameters
     * @param array|null $headers
     * @return mixed
     */
    public function multipartRequest(array $parameters, array $headers = null)
    {
        return $this->request($parameters, RequestOptions::MULTIPART, $headers);
    }


    /**
     * Sends request to server
     * should use url() method
     *
     * @param array $options
     * @return mixed
     * @see BaseService::url()
     */
    abstract public function sendRequest(array $options);

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
                $result = json_decode($response->getBody()->getContents());
                if (in_array($result->code, [ZarinpalResponseCode::SUCCESS, ZarinpalResponseCode::VERIFIED])) {
                    return $this->valuesOf($result);
                }
                throw new ZarinpalException($result->code);
            }
        }
        throw new ZarinpalException(ZarinpalResponseCode::SERVER_ERROR);
    }

}
