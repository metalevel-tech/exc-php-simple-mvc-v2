<?php

/**
 * Class Application
 * 
 * @author  Spas Z. Spasov
 * @package PHP MVC Framework, based https://github.com/thecodeholic/php-mvc-framework
 */


namespace app\core;

class Application
{
    // PHP 7.4 typed properties feature
    public Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
        $this->router->resolve();
    }

    
}
