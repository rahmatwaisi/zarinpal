<?php

namespace RahmatWaisi\Zarinpal\Services\Payment;

use Illuminate\Support\Facades\App;
use RahmatWaisi\Zarinpal\Exceptions\ZarinpalException;
use RahmatWaisi\Zarinpal\Services\BaseService;

class AuthorityService extends BaseService
{


    /**
     *  Gets new payment token from Zarinpal payment gateway
     *
     * @param $price
     * @param string $description
     * @param string|null $callBack
     * @param string|null $mobile
     * @param string|null $email
     * @return array|mixed
     * @throws ZarinpalException
     */
    public function getAuthority(
        $price
        , string $description
        , string $callBack = null
        , string $mobile = null
        , string $email = null
    )
    {
        $parameters = [
            'amount' => $price,
            'description' => $description,
            'merchant_id' => $this->getConfigKey('zarinpal.merchant_id'),
            'currency' => $this->getConfigKey('zarinpal.currency'),
            'callback_url' => $callBack ?? route($this->getConfigKey('callback_route')),
        ];

        $metadata = [];
        if (!is_null($mobile)) {
            $metadata['mobile'] = $mobile;
        }
        if (!is_null($email)) {
            $metadata['email'] = $email;
        }
        if (!empty($metadata)) {
            $parameters['metadata'] = json_encode($metadata);
        }

        return $this->response($this->jsonRequest($parameters));
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(array $options)
    {
        return $this->client()->post($this->url(), $options);
    }

    /**
     * @inheritDoc
     */
    public function valuesOf($responseResult): array
    {
        return [
            'code' => $responseResult->code,
            'message' => $responseResult->message,
            'authority' => $responseResult->authority,
            'fee_type' => $responseResult->fee_type,
            'fee' => $responseResult->fee,
        ];
    }

    /**
     * @inheritDoc
     */
    public function url(): string
    {
        return App::environment('local')
            ? $this->getConfigKey('zarinpal.sandbox.authority')
            : $this->getConfigKey('zarinpal.apis.authority');
    }
}
