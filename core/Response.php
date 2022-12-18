<?php

/**
 * Class Response
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

class Response
{
    /**
     * Summary of setStatusCode
     * @param  int $code
     * @return void
     */
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    /**
     * Summary of redirect
     * @param string $url
     * @return void
     */
    public function redirect(string $url): void
    {
        header("Location: $url");
    }
}
