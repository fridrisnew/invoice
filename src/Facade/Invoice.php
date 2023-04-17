<?php


namespace Fridris\Invoice\Facade;

use Illuminate\Support\Facades\Facade;

class Invoice extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'invoice-pl';
    }
    /**
     * Resolve a new instance
     * @param string $method
     * @param array<mixed> $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::$app->make(static::getFacadeAccessor());

        switch (count($args)) {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                $callable = [$instance, $method];
                if (! is_callable($callable)) {
                    throw new \UnexpectedValueException("Method Invoice::{$method}() does not exist.");
                }
                return call_user_func_array($callable, $args);
        }
    }
}
