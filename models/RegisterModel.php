<?php

/**
 * Class RegisterModel
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\models
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $passwordConfirm;

    public function register()
    {
        echo "Creating new user";
    }

    public function rules(): array
    {
        return [
            "firstName" => [self::RULE_REQUIRED],
            "lastName" => [self::RULE_REQUIRED],
            "email" => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL
            ],
            "password" => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, "min" => 8],
                [self::RULE_MAX, "max" => 32]
            ],
            "passwordConfirm" => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, "match" => "password"]
            ]
        ];
    }
}
