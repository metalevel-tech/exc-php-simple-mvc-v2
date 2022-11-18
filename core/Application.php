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
    public Response $response;
    public static Application $app;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
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
