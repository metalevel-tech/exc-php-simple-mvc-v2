<?php

/**
 * Class Controller
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;
use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = "main";
    public string $action = "";

    /**
     * Summary of middlewares
     * @var \app\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];

    /**
     * setLayout
     *
     * @param  string $layout
     * @return void
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    /**
     * render
     *
     * @param  string $view
     * @param  array $params // Default empty array is important
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        return Application::$app->view->renderView($view, $params);
    }

    /**
     * Summary of registerMiddleware
     * @param BaseMiddleware $middleware
     * @return void
     */
    public function registerMiddleware(BaseMiddleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Get summary of middlewares
     *
     * @return  \app\core\middlewares\BaseMiddleware[]
     */ 
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
