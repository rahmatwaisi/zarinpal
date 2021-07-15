<?php

namespace RahmatWaisi\Zarinpal\Services\Payment;

use Illuminate\Support\Facades\Redirect;

class PaymentService
{
    /**
     * Redirects user to payment page
     *
     * @param string $authority
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(string $authority)
    {
        // redirect user to bank payment page
        return Redirect::away($this->prepareUrl($authority));
    }

    /**
     * Appends $authority to end of url
     *
     * @param string $authority
     * @return string
     * @see url()
     */
    public function prepareUrl(string $authority)
    {
        return sprintf('%s%s', $this->url(), $authority);
    }

    /**
     * Returns the url of pol gateway payment api.
     * @return string
     */
    public function url(): string
    {
        return config('zarinpal.apis.payment');
    }
}
