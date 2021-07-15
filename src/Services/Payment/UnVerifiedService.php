<?php


namespace RahmatWaisi\Zarinpal\Services\Payment;


use RahmatWaisi\Zarinpal\Exceptions\ZarinpalException;
use RahmatWaisi\Zarinpal\Services\BaseService;

class UnVerifiedService extends BaseService
{
    /**
     * Gets the list of unverified transactions
     *
     * @return array|mixed
     * @throws ZarinpalException
     */
    public function getList()
    {
        $parameters = [
            'merchant_id' => $this->getConfigKey('zarinpal.merchant_id'),
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
            // عددي كه نشان دهنده موفق بودن يا عدم موفق عمليات ميباشد .
            'code' => $responseResult->code,
            // پیغام سیستم
            'message' => $responseResult->message,
            // حاوي اطلاعات اضافه تراكنش اعم از نوع درگاه و زمان پرداخت به صورت JSON Encode شده ميباشد.
            'authorities' => $responseResult->authorities,
        ];
    }

    /**
     * @inheritDoc
     */
    public function url(): string
    {
        return $this->getConfigKey('zarinpal.apis.unverified');
    }
}
