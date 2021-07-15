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
}
