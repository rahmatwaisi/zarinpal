<?php


namespace RahmatWaisi\Zarinpal\Exceptions;


class ConfigNotFoundException extends \Exception
{

    protected $key;

    public function __construct($key)
    {
        parent::__construct(
            sprintf(
                'Configuration key [%s] not found!'
                , $key
            ),
            404
        );
    }
}
