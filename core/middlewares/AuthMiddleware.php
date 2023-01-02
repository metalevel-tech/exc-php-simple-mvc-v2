<?php

/**
 * Class AuthMiddleware
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\middlewares
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core\middlewares;

use app\core\Application;
use app\core\exceptions\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    /**
     * Summary of actions
     * @var array of methods of the certain controller - i.e. AuthController::profile()
     */
    public array $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()) {
            // If the $actions is empty (restrict all of them) or
            // If the current action is inside the $actions
            // we gonna throw forbidden exception
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
                
            }
        }
    }


}