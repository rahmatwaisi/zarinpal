<?php

namespace RahmatWaisi\Zarinpal\Facade;

use Illuminate\Support\Facades\Facade;


/**
 * Class Zarinpal
 * @package RahmatWaisi\Zarinpal
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
