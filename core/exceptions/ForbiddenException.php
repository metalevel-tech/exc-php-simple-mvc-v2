<?php

/**
 * Class ForbiddenException
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\exceptions
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 * 
 * "\Exception" is the core exception class which comes from PHP
 */

namespace app\core\exceptions;

class ForbiddenException extends \Exception
{
    protected $message = "You don't have permission to access this page!";
    protected $code = 403;
    
    /**
     * In the tutorial this part is defined like above missing: https://youtu.be/BHuXI5JE9Qo?t=740
     * Alternatively of this we can use some thing as below, Ref.: https://www.educba.com/php-custom-exception/
    function __construct()
    {
        parent::__construct("You don't have permission to access this page!", 403);
    }
    */
}