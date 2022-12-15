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
        return Application::$app->db->pdo->prepare($sql);
    }
}
