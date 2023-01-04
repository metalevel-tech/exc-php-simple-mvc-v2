<?php

/**
 * Class ContactForm
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\models
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\models;

use app\core\Model;

class ContactForm extends Model
{

    public string $subject = "";
    public string $email = "";
    public string $body = "";

    /**
     * rules
     * @return array
     */
    public function rules(): array
    {
        return [
            "subject" => [
                    self::RULE_REQUIRED
            ],
            "email" => [
                    self::RULE_REQUIRED,
                    self::RULE_EMAIL
            ],
            "body" => [
                    self::RULE_REQUIRED
            ]
        ];
    }
    
    /**
     * Summary of labels
     * @return array
     */
    public function labels(): array
    {
        return [
            "subject" => "Enter your subject",
            "email" => "Your email",
            "body" => "Enter the body of the message"
        ];
            
    }

    public function send(): bool
    {
        return true;
    }
}