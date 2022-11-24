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

use app\core\Model;

class LoginModel extends Model
{
    public string $email = '';
    public string $password = '';
    
    /**
     * Summary of login
     * @return void
     */
    public function login(): void
    {
        echo "User log-in...";
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
