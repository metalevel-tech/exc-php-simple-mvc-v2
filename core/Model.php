<?php

/**
 * Class Model
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 * 
 * "abstract" class means that this class cannot be instantiated,
 * so we can only use it as a parent class and extend it
 * by subclasses, which can be instantiated.
 * 
 * "abstract" methods are methods that are declared in an abstract class,
 * but they do not have a body. The body is provided by the subclass.
 * 
 * Each model must have validation rules, so we declare an abstract method here.
 */

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    // An array where we will be stored
    // the errors of the form fields validation.
    public array $errors = [];
    
        
    /**
     * loadData
     *
     * @param  array $data
     * @return void
     */
    public function loadData(array $data): void
    {
        // Iterate through the data array,
        // check does the key exists in the $this class
        // (i.e. RegisterModel extends Model) and,
        // if it does, assign the value to the property.
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
    
    /**
     * rules
     *
     * @return array
     */
    abstract public function rules(): array;
    
    /**
     * validate
     *
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                // is_array($rule) ? $ruleName = $rule[0] : $ruleName = $rule;
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                // The RULE_MATCH is assigned to the confirmPassword field (see RegisterModel.php),
                // so we need to check if the value of the confirmPassword field is equal to 
                // the value of the password field, which name is defined in $this->{$rule['match']},
                // where $rule is 'confirmPassword' and $rule['match'] is 'password'.
                // See RegisterModel.php and watch https://youtu.be/ZSYhQkM5VIM?t=1751
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }

        return empty($this->errors);
    }
    
    /**
     * addError
     *
     * @param  string $attribute
     * @param  string $rule
     * @param  array  $params
     * 
     * @return void
     */
    public function addError(string $attribute, string $rule, array $params = []): void
    {
        $message = $this->errorMessages()[$rule] ?? '';

        // Example: $key = 'min' /{$key} = 'min', {{$key}} = '{min}'/; $value = 8
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }
    
    /**
     * errorMessages
     *
     * @return array
     */
    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => "This field is required",
            self::RULE_EMAIL => "This field must be a valid email address",
            self::RULE_MIN => "Min length of this field must be {min}",
            self::RULE_MAX => "Max length of this field must be {max}",
            self::RULE_MATCH => "This field must be the same as {match}",
            self::RULE_UNIQUE => "Record with this {field} already exists"
        ];
    }
    
    /**
     * hasError
     *
     * @param  string $attribute
     * @return mixed
     */
    public function hasError(string $attribute): mixed
    {
        return $this->errors[$attribute] ?? false;
    }
    
    /**
     * getFurstError
     *
     * @param  string $attribute
     * @return mixed
     */
    public function getFirstError(string $attribute): mixed
    {
        return $this->errors[$attribute][0] ?? false;
    }
}
