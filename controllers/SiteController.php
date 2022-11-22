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

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    /**
     * home
     *
     * @return string
     */
    public function home()
    {
        $params = [
            "name" => "PHP Simple MVC Framework",
        ];

        return $this->render("home", $params);
    }

    /**
     * contact
     *
     * @return string
     */
    public function contact()
    {
        return $this->render("contact");
    }

    /**
     * handleContact
     *
     * @param  \app\core\Request $request
     * @return string
     */
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        // echo "<pre>";
        // var_dump($body);
        // echo "</pre>";
        // exit;

        return "Handling submitted data";
    }
}
