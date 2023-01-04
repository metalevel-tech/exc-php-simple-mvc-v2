<?php

/**
 * Class Database
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core\db
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core\db;
use app\core\Application;

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

        // The data of these variables will be extracted from the .env file
        $this->pdo = new \PDO($dsn, $user, $password);

        // Output the error messages if any
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $files = scandir(Application::$ROOT_DIR . "/migrations");
        $migrationsToApply = array_diff($files, $appliedMigrations);
        $newMigrations = [];

        foreach ($migrationsToApply as $migration) {
            if ($migration === "." || $migration === "..") {
                continue;
            }

            require_once Application::$ROOT_DIR . "/migrations/$migration";

            // In this case pathinfo() will return the filename without the extension.
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();

            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied! migration $migration");

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are already applied!");
        }
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
     * Return single dimensional array with the entries 
     * of the migration column from the migrations table.
     * @return array
     */
    public function getAppliedMigrations(): array
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Summary of saveMigrations
     * @param array $migrations
     * @return void
     */
    public function saveMigrations(array $migrations): void
    {
        // Here we will save data only to the 'migration' column,
        // because the 'created_at' and 'id' will be automatically taken
        // for this table - see the `createMigrationsTable()` method above.
        
        $migrations = array_map(fn($migration) => "('$migration')", $migrations);
        $migrations = implode(",", $migrations);

        // $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $migrations");
        $statement = $this->prepare("INSERT INTO migrations (migration) VALUES $migrations");

        $statement->execute();
    }

    /**
     * Summary of prepare
     * @param string $sql
     * @return \PDOStatement
     */
    public function prepare(string $sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }

    protected function log(string $message): void
    {
        echo "[" . date("Y-m-d H:i:s") . "] - $message" . PHP_EOL;
    }
}