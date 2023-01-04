<?php

/**
 * Class FieldBase
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\form
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core\form;
use app\core\Model;

abstract class FieldBase
{
    abstract public function renderFieldTag(): string;
    public string $attribute;
    public Model $model;

    /**
     * Summary of __construct
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
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
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
            ',
            $this->model->getLabel($this->attribute),
            $this->renderFieldTag(),
            $this->model->getFirstError($this->attribute)
        );
    }
}