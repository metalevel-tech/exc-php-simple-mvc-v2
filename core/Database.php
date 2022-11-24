<?php

/**
 * Class Database
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

class Database
{
    public \PDO $pdo;

    /**
     * Summary of __construct
     * @param array $config
     * @return Database
     */
    public function __construct(array $config)
    {
        // The $config array is passed from the Application class
        // and it is parsed by PHP dotenv from the .env file.
        // DSN stands for Domain Service Name.
        $dsn = $config["dsn"] ?? "";
        $user = $config["user"] ?? "";
        $password = $config["password"] ?? "";

        echo "dsn: $dsn,<br> user: $user,<br> password: $password";

        // The data of these variables will be extracted from the .env file
        $this->pdo = new \PDO($dsn, $user, $password);

        // Output the error messages if any
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
    }

    public function createMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    /**
     * Summary of getAppliedMigrations
     * Return single dimensional array with the entries of the migration column from the migrations table
     * @return array
     */
    public function getAppliedMigrations(): array
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
}