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

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\LoginModel;
use app\models\User;

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
        $loginModel = new LoginModel();
        
        if ($request->isPost()) {
            $loginModel->loadData($request->getBody());
            
            if ($loginModel->validate() && $loginModel->login()) {
                return "Success";
            }

            // We can change the layout for the view only,
            // after hitting the submit button.
            $this->setLayout("auth");
            return $this->render("login", [
                "model" => $loginModel
            ]);
        }

        $this->setLayout("auth");
        return $this->render("login", [
            "model" => $loginModel
        ]);
    }

    /**
     * register
     *
     * @param  Request $request
     * @return string
     */
    public function register(Request $request): string
    {
        $user = new User();

        if ($request->isPost()) {
            $user->loadData($request->getBody());
            
            if ($user->validate() && $user->save()) {
                // return "Success";
                // https://youtu.be/nikoPDqTvKI?t=1675
                // header("Location: /");
                Application::$app->response->redirect("/");
            }

            // We can change the layout for the view only,
            // after hitting the submit button.
            $this->setLayout("auth");
            return $this->render("register", [
                "model" => $user
            ]);
        }

        $this->setLayout("auth");
        return $this->render("register", [
            "model" => $user
        ]);
    }
}
