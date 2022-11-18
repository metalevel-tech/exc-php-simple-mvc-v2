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
    
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }
    
    /**
     * run
     *
     * @return void
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}
