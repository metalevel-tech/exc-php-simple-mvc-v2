<?php

/**
 * Class Session
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 
 * References:
 * > https://www.php.net/manual/en/reserved.variables.session.php
 * > https://www.php.net/manual/en/function.session-start.php
 * > https://youtu.be/nikoPDqTvKI?t=1790
 */

namespace app\core;
use OutOfBoundsException;

class Session
{
    protected const FLASH_KEY = "flash_messages";

    public function __construct()
    {
        session_start();

        // https://youtu.be/nikoPDqTvKI?t=1957
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$flashMessage) {
            // Mark to be removed at the end of the current request
            $flashMessage["remove"] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function __destruct() {
        // Iterate over all flash messages and remove the ones marked to be removed
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$flashMessage) {
            if($flashMessage["remove"]) {
                unset($flashMessages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function setFlash($key, $message): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            "remove" => false,
            "value" => $message
        ];
    }
    
    public function getFlash($key): string|false
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }
 
}
