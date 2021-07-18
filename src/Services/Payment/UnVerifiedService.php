<?php


namespace RahmatWaisi\Zarinpal\Services\Payment;


use Illuminate\Support\Facades\App;
use RahmatWaisi\Zarinpal\Exceptions\ServiceUnavailable;
use RahmatWaisi\Zarinpal\Exceptions\ZarinpalException;
use RahmatWaisi\Zarinpal\Services\BaseService;

class UnVerifiedService extends BaseService
{
    /**
     * Gets the list of unverified transactions
     *
     * @return array|mixed
     * @throws ZarinpalException|ServiceUnavailable
     */
    public function getList()
    {
        $parameters = [
            'merchant_id' => $this->getConfigKey('zarinpal.merchant_id'),
        ];
        if (App::environment('local'))
            throw new ServiceUnavailable('getting unverified transactions ability, is available only in production environment.');
        if (App::isDownForMaintenance())
            throw new ServiceUnavailable('getting unverified transactions ability, is not available when application is under maintenance.');

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
