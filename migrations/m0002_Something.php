<?php 

/**
 * Class m0002_Something
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

class m0002_Something {
    public function up(): void
    {
        echo "Applying migration";
    }

    public function down(): void
    {
        echo "Reverting migration";
    }

}