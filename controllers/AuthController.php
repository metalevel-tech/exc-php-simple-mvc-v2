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
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    /**
     * login
     *
     * @param  Request $request
     * @return string
     */
    // public function login(Request $request, Response $response
    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            
            if ($loginForm->validate() && $loginForm->login()) {
                return "Success";
            }

            // We can change the layout for the view only,
            // after hitting the submit button.
            $this->setLayout("auth");
            return $this->render("login", [
                "model" => $loginForm
            ]);
        }

        $this->setLayout("auth");
        return $this->render("login", [
            "model" => $loginForm
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
                // Set a success flash message
                // https://youtu.be/nikoPDqTvKI?t=2200
                Application::$app->session->setFlash('success', 'Thank you for the registering!');
                
                // Redirect to the home page
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
