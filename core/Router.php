<?php

/**
 * Class Router
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;
use app\core\exceptions\NotFoundException;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * Summary of __construct
     * @param  \app\core\Request $request
     * @param  \app\core\Response $response
     * @return Router
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Summary of get
     * @param  string $path
     * @param  mixed $callback
     * @return void
     */
    public function get(string $path, mixed $callback): void
    {
        $this->routes["get"][$path] = $callback;
    }

    /**
     * Summary of post
     * @param  string $path
     * @param  mixed $callback
     * @return void
     */
    public function post(string $path, mixed $callback): void
    {
        $this->routes["post"][$path] = $callback;
    }

    /**
     * Summary of resolve
     * 
     * @var string $path
     * @var string $method
     * @var mixed $callback
     * 
     * @return string
     */
    public function resolve(): string
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            $this->response->setStatusCode(200);
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            // We need this annotation, otherwise the IDE doesn't know 
            // instance of which class is the $controller var... 
            // see the foreach() below... https://youtu.be/BHuXI5JE9Qo?t=970

            /** @var \app\core\Controller $controller */
            $controller =  new $callback[0]();

            Application::$app->controller = $controller;
            $controller->action = $callback[1]; // See the second argument in index.php...
            $callback[0] = Application::$app->controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        // https://www.php.net/manual/en/function.call-user-func.php
        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * Summary of renderView
     * 
     * Because we've moved all these methods in View class,
     * in case we do not want to rebuild the rest of the code right now
     * we can link the methods like this.
     * 
     * @param string $view
     * @param array $params
     * @return string
     */
    public function renderView(string $view, array $params = []): string
    {
        return Application::$app->view->renderView($view, $params);
    }

    // /**
    //  * Summary of renderContent
    //  * 
    //  * It is like renderView, but instead of view,
    //  * it renders (HTML text) $viewContent directly.
    //  * 
    //  * @param string $viewContent
    //  * @return string
    //  */
    // public function renderContent(string $viewContent): string
    // {
    //     $layoutContent = $this->layoutContent();
    //     return str_replace("{{content}}", $viewContent, $layoutContent);
    // }

    // /**
    //  * Summary of layoutContent
    //  * @var string $layout
    //  * @return string
    //  */
    // protected function layoutContent(): string
    // {
    //     // Default layout: https://youtu.be/BHuXI5JE9Qo?t=200
    //     $layout = Application::$app->layout;
        
    //     // Or if $controller exist get the layout from the controller.
    //     if (Application::$app->controller) {
    //         $layout = Application::$app->controller->layout;
    //     }

    //     ob_start();             // Start caching buffer, so nothing will be output to the browser
    //     include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
    //     return ob_get_clean();  // Stop caching buffer, and return the cached content
    // }

    // /**
    //  * Summary of renderOnlyView
    //  * @param string $view
    //  * @param array $params
    //  * @return string
    //  */
    // protected function renderOnlyView(string $view = "home", array $params = []): string
    // {
    //     /**
    //      * Convert $params[] to variables named as the array keys,
    //      * scoped only to this function. Otherwise, inside the $view file,
    //      * we will have to use $params['name'] instead of $name.
    //      * $"name" = "name value";
    //      * 
    //      foreach ($params as $key => $value) {
    //          $$key = $value;
    //      }
    //      */
    //     extract($params);

    //     ob_start();
    //     include_once Application::$ROOT_DIR . "/views/$view.php";
    //     return ob_get_clean();
    // }
}
