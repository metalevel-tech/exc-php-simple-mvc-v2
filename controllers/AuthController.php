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
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    /**
     * Summary of login
     * 
     * @param Request $request
     * @param Response $response
     * 
     * @return string|bool
     */
    public function login(Request $request, Response $response): string|bool
    {
        $loginForm = new LoginForm();

        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->session->setFlash("success", "Welcome back!");
                $response->redirect("/");
                return true;
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
     * 
     * @return string|bool
     */
    public function register(Request $request, Response $response): string|bool
    {
        $user = new User();

        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                // Set a success flash message
                // https://youtu.be/nikoPDqTvKI?t=2200
                Application::$app->session->setFlash("success", "Thank you for the registering!");

                // Redirect to the home page
                // https://youtu.be/nikoPDqTvKI?t=1675
                // header("Location: /");
                $response->redirect("/");
                return true;
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

    public function logout(Request $request, Response $response): void
    {
        Application::$app->session->setFlash("success", "Good bye. See you later!");
        Application::$app->logout();
        $response->redirect("/");
    }

    public function profile(): string
    {
        $params = [
            "name" => Application::$app->user ? Application::$app->user->getDisplayName() : "Anonymous"
        ];

        return $this->render("profile", $params);
    }
}