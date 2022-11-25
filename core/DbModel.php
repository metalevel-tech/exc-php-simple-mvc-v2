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
    abstract public function attributes(): array;

    public function save(): bool
    {
        try {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":$attr", $attributes);
    
            $statement = self::prepare("
                INSERT INTO $tableName (" . implode(",", $attributes) . ")
                VALUES (" . implode(",", $params) . ")
            ");
    
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
    
            $statement->execute();
    
            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function prepare($sql): PDOStatement|false
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
