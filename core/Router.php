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

    /**
     * get
     *
     * @param  string $path
     * @param  function $callback
     * @return void
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * resolve
     *
     * @return void
     */
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

    /**
     * renderView
     *
     * @param  string $view
     * @return void
     */
    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * layoutContent
     *
     * @param  string $layout
     * @return string
     */
    protected function layoutContent(string $layout = "main")
    {
        ob_start();             // Start caching buffer, so nothing will be output to the browser
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();  // Stop caching buffer, and return the cached content
    }

    /**
     * renderOnlyView
     *
     * @param  string $view
     * @return string
     */
    protected function renderOnlyView(string $view = "home")
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
