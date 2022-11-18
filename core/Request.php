<?php

/**
 * Class Request
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

class Request
{
    /**
     * getPath
     *
     * @param $_SERVER['REQUEST_URI']
     * @return void
     */
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * method
     *
     * @param $_SERVER['REQUEST_METHOD']
     * @return void
     */
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
