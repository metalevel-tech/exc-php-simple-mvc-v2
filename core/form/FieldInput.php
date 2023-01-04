<?php

/**
 * Class FieldInput
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\form
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core\form;

use app\core\Model;

class FieldInput extends FieldBase
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;


    /**
     * Summary of __construct
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    /**
     * Summary of passwordField
     * @return FieldInput|static
     */
    public function passwordField(): FieldInput
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    /**
     * Summary of renderFieldTag
     * @return string
     */
    public function renderFieldTag(): string
    {
        return sprintf('
                <input type="%s" name="%s" value="%s" class="form-control%s">
            ',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? " is-invalid" : ""
        );
    }
}