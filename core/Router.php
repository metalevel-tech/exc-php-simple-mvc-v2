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
            $this->response->setStatusCode(404);
            return $this->renderView("_HTTP404");
        }

        if (is_string($callback)) {
            $this->response->setStatusCode(200);
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        // https://www.php.net/manual/en/function.call-user-func.php
        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * Summary of renderView
     * @param string $view
     * @param array $params
     * @return string
     */
    public function renderView(string $view, array $params = []): string
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    /**
     * Summary of renderContent
     * 
     * It is like renderView, but instead of view,
     * it renders (HTML text) $viewContent directly.
     * 
     * @param string $viewContent
     * @return string
     */
    public function renderContent(string $viewContent): string
    {
        $layoutContent = $this->layoutContent();
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    /**
     * Summary of layoutContent
     * @var string $layout
     * @return string
     */
    protected function layoutContent(): string
    {
        $layout = Application::$app->controller->layout;

        ob_start();             // Start caching buffer, so nothing will be output to the browser
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();  // Stop caching buffer, and return the cached content
    }

    /**
     * Summary of renderOnlyView
     * @param string $view
     * @param array $params
     * @return string
     */
    protected function renderOnlyView(string $view = "home", array $params = []): string
    {
        /**
         * Convert $params[] to variables named as the array keys,
         * scoped only to this function. Otherwise, inside the $view file,
         * we will have to use $params['name'] instead of $name.
         * $"name" = "name value";
         * 
         foreach ($params as $key => $value) {
             $$key = $value;
         }
         */
        extract($params);

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
