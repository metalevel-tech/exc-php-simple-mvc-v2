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
        // (i.e. User extends Model) and,
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
     * Summary of labels
     * 
     * Ref: https://youtu.be/nikoPDqTvKI?t=2800
     * 
     * @return array
     */
    public function labels(): array
    {
        return [];
    }


    public function getLabel(string $attribute): string
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    // An array where we will be stored
    // the errors of the form fields validation.
    public array $errors = [];    

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
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }

                // The RULE_MATCH is assigned to the confirmPassword field (see User.php),
                // so we need to check if the value of the confirmPassword field is equal to 
                // the value of the password field, which name is defined in $this->{$rule['match']},
                // where $rule is 'confirmPassword' and $rule['match'] is 'password'.
                // See User.php and watch https://youtu.be/ZSYhQkM5VIM?t=1751
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    // $rule['match'] will return 'password'
                    $rule['match'] = $this->getLabel($rule['match']);
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }

                // The RULE_UNIQUE is assigned to the email field (see User.php),
                // so we need to check if the value of the email field is unique in the database.
                // See User.php and watch https://youtu.be/nikoPDqTvKI?t=1260
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttribute = :attribute");
                    $statement->bindValue(":attribute", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $this->getLabel($attribute)]);
                    }
                    
                }
            }
        }

        return empty($this->errors);
    }
    
    /**
     * Summary of addErrorForRule
     * 
     * Used to add errors based on the defined rules.
     *
     * @param  string $attribute
     * @param  string $rule
     * @param  array  $params
     * 
     * @return void
     */
    private function addErrorForRule(string $attribute, string $rule, array $params = []): void
    {
        $message = $this->errorMessages()[$rule] ?? "";

        // Example: $key = 'min' /{$key} = 'min', {{$key}} = '{min}'/; $value = 8
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }
    
    /**
     * Summary of addError
     * 
     * Used to add errors with custom messages.
     * 
     * @param string $attribute
     * @param string $message
     * @return void
     */
    public function addError(string $attribute, string $message): void
    {
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
