<?php


namespace RahmatWaisi\Zarinpal\Traits;

use RahmatWaisi\Zarinpal\Exceptions\ConfigNotFoundException;
use Symfony\Component\ErrorHandler\Error\FatalError;

trait GetConfigKey
{
    /**
     * Looks for a key in config files
     *
     * @param $key
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     * @throws FatalError
     */
    public function getConfigKey($key)
    {
        try {
            $value = config($key);
            if (is_null($value)) throw new ConfigNotFoundException($key);
        } catch (ConfigNotFoundException $ex) {
            throw new FatalError($ex->getMessage(), $ex->getCode(), []);
        }
        return $value;
    }
}
