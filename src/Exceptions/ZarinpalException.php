<?php

namespace RahmatWaisi\Zarinpal\Exceptions;

class ZarinpalException extends \Exception
{
    /**
     * Error CODE or ID
     * @var int
     */
    protected $error_code;

    public function __construct($errorId)
    {
        $this->error_code = intval($errorId);
        parent::__construct(ZarinpalResponseCode::getErrorMessage($errorId), $errorId);
    }
}
