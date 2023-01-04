<?php

/**
 * Class SiteController
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
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * home
     *
     * @return string
     */
    public function home(): string
    {
        $params = [
            "projectName" => "PHP Simple MVC Framework",
        ];

        return $this->render("home", $params);
    }

    /**
     * Summary of contact
     * @param Request $request
     * @param Response $response
     * @return string|bool
     */
    public function contact(Request $request, Response $response): string|bool
    {
        $contact = new ContactForm(Application::$CONTACT_US_DETAILS);

        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate()) {
                if ($contact->send()) {
                    Application::$app->session->setFlash("success", "Thanks for contacting us!");
                    $response->redirect("/contact");
                    return true;
                } else {
                    Application::$app->session->setFlash("warning", "Something went wrong, please try again later.");
                    return $this->render("contact", [
                        "model" => $contact
                    ]);
                }
            }
        }

        return $this->render("contact", [
            "model" => $contact
        ]);
    }
}
