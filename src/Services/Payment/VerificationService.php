<?php

namespace RahmatWaisi\Zarinpal\Services\Payment;

use RahmatWaisi\Zarinpal\Exceptions\ZarinpalException;
use RahmatWaisi\Zarinpal\Services\BaseService;

class VerificationService extends BaseService
{
    /**
     * Sends a post request to server with information about a payment i.e. $token and $price
     * and if payment was successful it will return a json object that has a status key with
     * true value.
     *
     * Otherwise status will be false and also an errorCode and errorDesc will be presented.
     *
     * @param $price
     * @param string $authority
     * @return array|mixed
     * @throws ZarinpalException
     */
    public function verifyPayment($price, string $authority)
    {
        $parameters = [
            'merchant_id' => $this->getConfigKey('zarinpal.merchant_id'),
            'price' => $price,
            'authority' => $authority,
        ];

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
            // عددي كه نشان دهنده موفق بودن يا عدم موفق بودن پرداخت ميباشد.
            'code' => $responseResult->code,
            //در صورتي كه پرداخت موفق باشد؛ شماره تراكنش پرداخت انجام شده را بر ميگرداند.
            'message' => $responseResult->message,
            // شماره کارت به صورت Mask
            'card_hash' => $responseResult->card_hash,
            // هش کارت به صورت SHA256
            'card_pan' => $responseResult->card_pan,
            // شماره مرجع
            'ref_id' => $responseResult->ref_id,
            // پرداخت کننده کارمزد که در پنل قابل انتخاب است کاربر و یا خود پذیرنده
            'fee_type' => $responseResult->fee_type,
            // کارمزد
            'fee' => $responseResult->fee,
        ];
    }

    /**
     * @inheritDoc
     */
    public function url(): string
    {
        return $this->getConfigKey('zarinpal.apis.verify');
    }
}
