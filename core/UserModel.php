<?php

/**
 * Class UserMod
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

abstract class UserModel extends DbModel
{
    public string $password; // Otherwise PHP IntelePhense complains about $user->password in LoginForm:login()
    abstract public function getDisplayName(): string;
}