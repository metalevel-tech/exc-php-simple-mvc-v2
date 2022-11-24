<?php

/**
 * Class Form
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\form
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core\form;

use app\core\Model;

class Form
{
    /**
     * Summary of begin
     * @param string $action
     * @param string $method
     * @return Form
     * @output string
     */
    public static function begin(string $action, string $method): Form
    {
        // Output the <form> open tag
        printf('<form action="%s" method="%s">', $action, $method);
        // Then return a new instance of the Form class, thus allowing us to chain methods
        return new Form();
    }

    /**
     * Summary of end
     * @return void
     * @output string
     */
    public static function end(): void
    {
        printf('</form>');
    }

    /**
     * Summary of field
     * @param Model $model
     * @param string $attribute
     * @return Field
     */
    public function field(Model $model, string $attribute): Field
    {
        return new Field($model, $attribute);
    }
}