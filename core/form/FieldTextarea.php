<?php

/**
 * Class FieldTextarea
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\form
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core\form;

use app\core\Model;

class FieldTextarea extends FieldBase
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;

    /**
     * Summary of renderFieldTag
     * @return string
     */
    public function renderFieldTag(): string
    {
        return sprintf('
                <textarea name="%s" class="form-control%s">%s</textarea>
            ',
            $this->attribute,
            $this->model->hasError($this->attribute) ? " is-invalid" : "",
            $this->model->{$this->attribute}
        );
    }
}