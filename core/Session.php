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

    public function setFlash(string $key, string $message): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            "remove" => false,
            "value" => $message
        ];
    }
    
    public function getFlash(string $key): string|false
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }
 
    public function set(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key): string|false
    {
        return $_SESSION[$key] ?? false;
    }
    
    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }
}
