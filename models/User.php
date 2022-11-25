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

use app\core\DbModel;

class User extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmPassword = '';

    /**
     * Summary of tableName
     * @return string
     */
    public function tableName(): string
    {
        return 'users';
    }

    /**
     * Summary of attributes
     * @return array
     */
    public function attributes(): array
    {
        return ['firstName', 'lastName', 'email', 'password', 'status'];
    }

    /**
     * Summary of register
     */
    public function save(): bool
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
    
    /**
     * Summary of rules
     * @return array
     */
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
            "confirmPassword" => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, "match" => "password"]
            ]
        ];
    }
}
