<?php

/**
 * Class LoginModel
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\models
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    public string $email = "";
    public string $password = "";
    
    /**
     * Summary of login
     * @return bool
     */
    public function login(): bool
    {   
        // See the comments under the Part 5 video lesson: https://youtu.be/mtBIu9dfclY
        // In this case we've defined the method as static...
        $user = User::findOne(["email" => $this->email]);
        
        if (!$user) {
            $this->addError("email", "User with this email does not exist!");
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError("password", "Your password is incorrect!");
            return false;
        }

        echo "<pre>";
        echo var_dump($user);
        echo "</pre>";
        exit;
        // return Application::$app->login();
    }
    
    /**
     * Summary of rules
     * @return array
     */
    public function rules(): array
    {
        return [
            "email" => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL
            ],
            "password" => [
                self::RULE_REQUIRED
            ]
        ];
    }
}
