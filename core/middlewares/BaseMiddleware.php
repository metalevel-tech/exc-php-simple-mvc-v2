<?php

/**
 * Class BaseMiddleware
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\middlewares
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core\middlewares;

abstract class BaseMiddleware
{
    abstract public function execute();
}
