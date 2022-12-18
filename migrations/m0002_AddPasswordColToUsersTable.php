<?php 

/**
 * Class m0002_AddPasswordColToUsersTable
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

class m0002_AddPasswordColToUsersTable {
    public function up(): void
    {
        $db = \app\core\Application::$app->db;
        $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;";
        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = \app\core\Application::$app->db;
        $sql = "ALTER TABLE users DROP COLUMN password;";
        $db->pdo->exec($sql);
    }

}