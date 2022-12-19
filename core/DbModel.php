<?php

/**
 * Class DbModel
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

use PDOStatement;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    // Much proper way is to create a Schema table 
    // and read the properties from there... https://youtu.be/nikoPDqTvKI?t=293
    // Here is used the easiest way :) So this method should return all database's colum names.
    abstract public function attributes(): array;

    public function save(): bool
    {
        try {
            $tableName = $this->tableName();
            $attributes = $this->attributes();

            // https://youtu.be/nikoPDqTvKI?t=754
            $params = array_map(fn($attribute) => ":$attribute", $attributes);

            $statement = self::prepare("
                INSERT INTO $tableName (" . implode(",", $attributes) . ")
                VALUES (" . implode(",", $params) . ")
            ");

            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();

            return true;
        } catch (\PDOException $err) {
            echo $err->getMessage();
            return false;
        }
    }

    public static function prepare($sql): PDOStatement|false
    {
        // return Application::$app->db->pdo->prepare($sql);
        return Application::$app->db->prepare($sql);
    }

    /**
     * Summary of findOne
     * 
     * Find does an user exists in the database.
     * 
     * @param array $where          // ["email" => "user@domain.com", "firstName" => "UsersName"];
     * 
     * // 
     * @var string  $tableName      // 'users';
     * @var array   $attributes     // ["email", "firstName"];
     * @var array   $attrsMapped    // ["email = :email", "firstName = :firstName"];
     * @var string  $sql            // "SELECT * FROM $tableName WHERE email = :email AND firstName = :firstName";
     * @var PDOStatement $statement
     *
     * @return static::class        // return an instance of the correspondent class where the method is called.
     */
    public static function findOne(array $where): static
    {
        // In this case static::method() corresponds to 
        // the actual class where the method is defined. 
        // Note "tableName()" is defined as an abstract 
        // method in the current abstract class.
        /**
        * Unfortunately PHP 8+: Non-static method app\models\User::tableName() cannot be called statically,
        * and we can't define it as static, otherwise we must refactoring the rest code where it is used...
        * so we need to create an instance ot the User class and call the method.
        $tableName = static::tableName();
        */
        // See the comments under the Part 5 video lesson: https://youtu.be/mtBIu9dfclY
        // In this case we are creating an instance of the relevant (User) class...
        $tableName = (new static ())->tableName();

        $attributes = array_keys($where);
        $attrsMapped = array_map(fn($attr) => "$attr = :$attr", $attributes);
        $sql = "SELECT * FROM $tableName WHERE " . implode("AND ", $attrsMapped);
        $statement = self::prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->fetchObject(static::class);
    }
}