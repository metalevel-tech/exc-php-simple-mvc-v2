<?php

/**
 * Class View
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

class View
{
    public string $title = "";

    /**
     * Summary of renderView
     * @param string $view
     * @param array $params
     * @return string
     */
    public function renderView(string $view, array $params = []): string
    {
        $viewContent = $this->renderOnlyView($view, $params); // Here we define $this->title
        $layoutContent = $this->layoutContent();              // Here we use $this->title

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
        // Default layout: https://youtu.be/BHuXI5JE9Qo?t=200
        $layout = Application::$app->layout;
        
        // Or if $controller exist get the layout from the controller.
        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }

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
