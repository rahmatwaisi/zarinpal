<?php


namespace RahmatWaisi\Zarinpal;

use RahmatWaisi\Zarinpal\Services\Payment\AuthorityService;
use RahmatWaisi\Zarinpal\Services\Payment\PaymentService;
use RahmatWaisi\Zarinpal\Services\Payment\RefundService;
use RahmatWaisi\Zarinpal\Services\Payment\UnVerifiedService;
use RahmatWaisi\Zarinpal\Services\Payment\VerificationService;

class ZarinpalService
{

    /**
     * AuthorityService
     */
    protected $authorityService;

    /**
     * PaymentService
     */
    protected $paymentService;

    /**
     * RefundService
     */
    protected $refundService;

    /**
     * UnVerifiedService
     */
    protected $unVerifiedService;

    /**
     * VerificationService
     */
    protected $verificationService;


    public function __construct()
    {
        $this->authorityService = new AuthorityService();
        $this->paymentService = new PaymentService();
        $this->refundService = new RefundService();
        $this->unVerifiedService = new UnVerifiedService();
        $this->verificationService = new VerificationService();
    }

    /**
     * @throws Exceptions\ZarinpalException
     */
    public function authority($price, string $description, string $callBack = null, string $mobile = null, string $email = null)
    {
        return $this->authorityService->getAuthority($price, $description, $callBack, $mobile, $email);
    }

    /**
     * Redirects user to payment page
     * @param string $authority
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(string $authority)
    {
        return $this->paymentService->pay($authority);
    }

    /**
     * @throws Exceptions\ZarinpalException
     */
    public function verify($price, string $authority)
    {
        return $this->verificationService->verifyPayment($price, $authority);
    }

    /**
     * @throws Exceptions\ZarinpalException
     * @throws Exceptions\ServiceUnavailable
     */
    public function refund(string $authority)
    {
        return $this->refundService->refund($authority);
    }

    /**
     * @throws Exceptions\ZarinpalException
     * @throws Exceptions\ServiceUnavailable
     */
    public function getListOfUnverifiedTransactions()
    {
        return $this->unVerifiedService->getList();
    }
}
