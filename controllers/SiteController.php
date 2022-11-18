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

class SiteController extends Controller
{
    /**
     * In the main guide () this function is not-static. 
     * But in PHP 8.0+ "non-static methods cannot be called statically"...
     * But when we using $this in the function, we need to make it non-static...
     * https://lindevs.com/calling-non-static-class-methods-statically-produces-fatal-error-in-php-8-0
     * See also: app\core\Router->resolve() :84,89
     */
    public function home()
    {
        $params = [
            'name' => 'PHP Simple MVC Framework',
        ];

        return $this->render('home', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function handleContact()
    {
        return "Handling submitted data";
    }
    
}
