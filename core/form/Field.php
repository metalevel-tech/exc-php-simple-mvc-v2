<?php

/**
 * Class Field
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\form
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';

    public Model $model;
    public string $attribute;
    public string $type;

    /**
     * Summary of __construct
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    /**
     * Summary of __toString
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('
            <div class="mb-3">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
            ',
            self::cleanLabel($this->attribute),
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }

    /**
     * Summary of passwordField
     * @return Field
     */
    public function passwordField(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    protected function cleanLabel(string $label): string
    {
        $words = preg_split('/(?=[A-Z])/', $label, 0, PREG_SPLIT_NO_EMPTY);
        return ucfirst(strtolower(implode(' ', $words)));
    }
}