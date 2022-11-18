<?php

/**
 * Class Response
 * 
 * @author  Spas Z. Spasov
 * @package PHP MVC Framework, based https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

class Response
{        
    /**
     * setStatusCode
     *
     * @param  int $code
     * @return void
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
