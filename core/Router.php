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
    // protected array $routes = [
    //     'get' => [
    //         '/' => 'homeCallBack',
    //         '/contacts' => 'contactsCallBack',
    //     ],
    //     'post' => [
    //         '/posts' => 'postsCallBack',
    //     ]
    // ];
    protected array $routes = [];

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';
        exit;
    }
}
