<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

/**
 * Class AuthController
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\controllers
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        $this->setLayout("auth");
        
        if ($request->isPost()) {
            return "Handling submitted data";
        }

        return $this->render("login");
    }
    
    public function register(Request $request)
    {
        $this->setLayout("auth");
        
        if ($request->isPost()) {
            return "Handling submitted data";
        }

        return $this->render("register");
    }
}
