<?php

namespace RahmatWaisi\Zarinpal\Facade;

use Illuminate\Support\Facades\Facade;


/**
 * Class Zarinpal
 * @package RahmatWaisi\Zarinpal
 *
 * @method static authority($price, string $description, string $callBack = null, string $mobile = null, string $email = null)
 * @method static pay(string $authority)
 * @method static verify($price, string $authority)
 * @method static refund(string $authority)
 * @method static getListOfUnverifiedTransactions()
 *
 * @author Rahmat Waisi <rahmatwaisi@gmail.com>
 */
class Zarinpal extends Facade
{
    /**
     * The name of the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zarinpal';
    }
}
