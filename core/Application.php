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
    // PHP 7.4 typed properties, 
    // https://www.php.net/manual/en/migration74.new-features.php
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    
}
