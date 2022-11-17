<?php

/**
 * Class Router
 * 
 * @author  Spas Z. Spasov
 * @package PHP MVC Framework, based https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

class Router
{
    public Request $request;

    /**
     *  protected array $routes = [
     *      'get'  => [ '/' => 'callBack', '/contacts' => 'callBack' ],
     *      'post' => [ '/posts' => 'callBack', ... ]
     *  ];
     */
    protected array $routes = [];

    
    /**
     * __construct
     *
     * @param  \app\core\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return 'Not found';
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);

        // echo '<pre>';
        // var_dump($path);
        // var_dump($method);
        // var_dump($this->routes);
        // echo '</pre>';
        // exit;
    }

    public function renderView($view)
    {
        include_once __DIR__ . "/../views/$view.php";
    }
}
