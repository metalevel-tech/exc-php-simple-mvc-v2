<?php 

/**
 * Class m0001_CreateUsersTable
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

class m0001_CreateUsersTable {
    public function up(): void
    {
        $db = \app\core\Application::$app->db;

        $SQL = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstName VARCHAR(255) NOT NULL,
            lastName VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL);
    }

    public function down(): void
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }

}