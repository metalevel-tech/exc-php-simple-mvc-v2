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

    protected string $emailServer = "";
    protected string $emailAdmin = "";

    public function __construct(array $contactUsDetails)
    {
        $this->emailServer = $contactUsDetails['emailServer'];
        $this->emailAdmin = $contactUsDetails['emailAdmin'];
    }

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

    /**
     * Summary of send
     * 
     * Ref.: https://www.php.net/manual/en/function.mail.php
     * 
     * @return bool
     */
    public function send(): bool
    {
        $to = $this->emailAdmin;
        $from = $this->emailServer;

        $subject = $this->subject;
        $message = "Message from: $this->email" 
            . "\r\n" . "Message body:" . "\r\n"
            . wordwrap($this->body, 70, "\r\n");
        $headers = [
            "From" => $from ? "PHP MVC <$from>" : "PHP MVC",
            "Reply-To" => $this->email,
            "X-Mailer" => "PHP/" . phpversion(),
            "Content-Type" => "text/plain; charset=utf-8"
        ];

        return mail($to, $subject, $message, $headers);
    }
}