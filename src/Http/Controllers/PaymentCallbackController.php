<?php


namespace RahmatWaisi\Zarinpal\Http\Controllers;

use Illuminate\Http\Request;
use RahmatWaisi\Zarinpal\Exceptions\ZarinpalException;
use RahmatWaisi\Zarinpal\Exceptions\ZarinpalResponseCode;

class PaymentCallbackController
{
    /**
     * Successful payment status
     */
    const PAYMENT_SUCCESSFUL = 'OK';

    /**
     * Failed payment status
     */
    const PAYMENT_FAILED = 'NOK';

    public function __construct()
    {
        // TODO add no middlewares
    }

    /**
     * @throws ZarinpalException
     */
    function callback(Request $request)
    {
        // Check if gateway response has expected keys;
        if (!$request->has([
            'Authority',
        ])) throw new ZarinpalException(ZarinpalResponseCode::FAILED);

        // response is ok and has all keys that we expect.

        $authority = $request->query('Authority');
        $status = $request->query('Status');

        if ($status === self::PAYMENT_SUCCESSFUL){

            // TODO store above values in database here
            //  call Zarinpal::verifyPayment(....)

        }else{

            // TODO handle the failed request here
            //  i.e.
            //  1- throw new ZarinpalException(ZarinpalResponseCode::FAILED);
            //  2- return a proper response
            //  3- call Zarinpal::refundPayment(....)
            //  anything else

        }
    }
}
