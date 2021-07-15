<?php


namespace RahmatWaisi\Zarinpal\Services\Payment;


use RahmatWaisi\Zarinpal\Exceptions\ZarinpalException;
use RahmatWaisi\Zarinpal\Services\BaseService;

class RefundService extends BaseService
{
    /**
     * Reverses a payment using $token
     *
     * @param string $authority
     * @return array|mixed
     * @throws ZarinpalException
     */
    public function refund(string $authority)
    {
        $parameters = [
            'authority' => $authority
        ];

        return $this->response($this->jsonRequest($parameters));
    }

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
            // عددي كه نشان دهنده موفق بودن يا عدم موفق عمليات ميباشد
            'code' => $responseResult->code,
            // وضعیت
            'message' => $responseResult->message,
            // در صورت موفق بودن؛ شماره تراكنش انجام شده را بر ميگرداند
            'ref_id' => $responseResult->ref_id,
            // آیدی نشست
            'session' => $responseResult->session,
            // شماره شبا حسابی که برگشت داده شده است
            'iban' => $responseResult->iban,
        ];
    }

    /**
     * @inheritDoc
     */
    public function url(): string
    {
        return $this->getConfigKey('zarinpal.apis.refund');
    }
}
