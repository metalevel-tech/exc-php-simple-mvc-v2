<?php

/**
 * Class NotFoundException
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\exceptions
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 * 
 * "\Exception" is the core exception class which comes from PHP
 */

namespace app\core\exceptions;

class NotFoundException extends \Exception
{
    protected $message = "The page you are searching for is not found!";
    protected $code = 404;
}