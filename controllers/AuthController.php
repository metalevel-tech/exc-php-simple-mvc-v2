<?php

/**
 * Class AuthController
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\controllers
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    /**
     * login
     *
     * @param  Request $request
     * @return string
     */
    public function login(Request $request)
    {
        if ($request->isPost()) {
            return "Handling submitted data";
        }

        $this->setLayout("auth");

        return $this->render("login");
    }

    /**
     * register
     *
     * @param  Request $request
     * @return string
     */
    public function register(Request $request): string
    {
        $registerModel = new RegisterModel();

        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            
            if ($registerModel->validate() && $registerModel->register()) {
                return "Success";
            }

            // We can change the layout for the view only,
            // after hitting the submit button.
            $this->setLayout("auth");
            return $this->render("register", [
                "model" => $registerModel
            ]);
        }

        $this->setLayout("auth");
        return $this->render("register", [
            "model" => $registerModel
        ]);
    }
}
