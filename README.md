# PHP Model View Controller (MVC)

Sample example of PHP MVC. It is like a tutorial and follows the guide ["Build PHP MVC Framework from Scratch"](https://www.youtube.com/watch?v=WKy-N0q3WRo&list=PLLQuc_7jk__Uk_QnJMPndbdKECcTEwTA1) course provided by The Codeholic at YouTube. The full course is about 6 hours and 30 minutes long.

## References

* The Codeholic at YouTube: ["Build PHP MVC Framework from Scratch"](https://www.youtube.com/playlist?list=PLLQuc_7jk__Uk_QnJMPndbdKECcTEwTA1)
* The Codeholic at GitHub: ["Build PHP MVC Framework from Scratch"](https://github.com/thecodeholic/php-mvc-framework)
* MLT Wiki: [Git CLI hints](https://wiki.metalevel.tech/wiki/Git_CLI_hints)
* Free Code Camp: [Push a new local branch to a remote Git repository and track it too](https://forum.freecodecamp.org/t/push-a-new-local-branch-to-a-remote-git-repository-and-track-it-too/13222)
* Bootstrap: [Bootstrap 5.2 download](https://getbootstrap.com/docs/5.2/getting-started/download/)
* PHP: [Typed properties (v.7.4+)](https://www.php.net/manual/en/migration74.new-features.php)
* Kinsta: [What’s New in PHP 8.1: Features, Changes, Improvements, and More](https://kinsta.com/blog/php-8-1/#firstclass-callable-syntax)
* Lindevs: [Calling Non-Static Class Methods Statically Produces Fatal Error in PHP 8.0](https://lindevs.com/calling-non-static-class-methods-statically-produces-fatal-error-in-php-8-0) in relation with [this part](https://youtu.be/GTESlsYTUns?t=3301) ot the main guide.
* CreatifWerks: [Difference between `printf` and `sprintf` PHP](https://www.creatifwerks.com/2020/06/18/difference-between-printf-and-sprintf-php/)
* Jakub Míšek at YouTube: [Profiling PHP in Visual Studio Code](https://youtu.be/VQB6pdDhGWs)
* [PHP dotenv at GitHub](https://github.com/vlucas/phpdotenv) | [PHP dotenv instructions from the main guide](https://youtu.be/Fnc-KUXjNFU?t=660)

## Stages

### Stage 1

Covered topics:

* Routing
* Controllers
* Views
* Layouts
* Project Structure
* Composer initialize and autoload

Related lessons and resources:

* [Routing, Controllers, Views - Part 1 | PHP MVC Framework from Scratch](https://youtu.be/GTESlsYTUns)
* [Introduction to Composer - How to use Composer For Beginners](https://www.youtube.com/watch?v=I6wm15OWyqg)

### Stage 2

Covered topics:

* Registration and login forms
* Modules
* Forms
* Validation

Related lessons and resources:

* [Models, Forms, Validation - Part 2 | PHP MVC Framework from Scratch](https://youtu.be/GTESlsYTUns) (the last 20 minutes)
* [Models, Forms, Validation - Part 2 | PHP MVC Framework from Scratch](https://youtu.be/ZSYhQkM5VIM)

### Stage 3

Covered topics:

* Database connection
* Migrations - [migration](https://youtu.be/Fnc-KUXjNFU?t=60) is a file which contains the change of the database.

Related lessons and resources:

* [Database connection & Migrations - Part 3 | PHP MVC Framework from Scratch](https://youtu.be/Fnc-KUXjNFU)
* [PHP dotenv at GitHub](https://github.com/vlucas/phpdotenv) | [PHP dotenv instructions from the main guide](https://youtu.be/Fnc-KUXjNFU?t=660)
* [Create MySQL database](#create-mysql-database)

## PHP Hints

You can run the PHP built-in web server by `php -S localhost:8000`.

Dup variables in PHP:

```php
echo '<pre>'; var_dump($position); echo '</pre>'; exit;
```

## Autoload classes by the help of Composer

Initialize the project by `composer init` which will create a `composer.json` file. Then setup the [autoload](https://youtu.be/GTESlsYTUns?t=540) option. Another way is to use the [`spl_autoload_register()`](https://github.com/metalevel-tech/php-simple-mvc-v1/blob/master/index.php#L5) function.

## Create MySQL database

In the directory [`scripts/sql`](scripts/sql/) are available two manual like SQL files. We can suppress the comments and use them as SQL scrips to create or remove the `php_mvc_db` and `php_mvc_admin` MySQL database and user used in this tutorial.

```bash
sed -r \
-e '/^(-- |$)/d' \
-e 's/php_mvc_db/php_mvc_db/g' \
-e 's/php_mvc_admin/php_mvc_admin/g' \
-e 's/strong-password/strong-password/g' \
scripts/sql/php_mvc_db_create.sql | sudo mysql
```

```bash
sed -r \
-e '/^(-- |$)/d' \
-e 's/php_mvc_db/php_mvc_db/g' \
-e 's/php_mvc_admin/php_mvc_admin/g' \
scripts/sql/php_mvc_db_remove.sql | sudo mysql
```

* According to the documentation these comments shouldn't make a problem, but in my case they do. So I have to remove them by the first `sed` expression.
* The second `sed` expression could be used to replace the database name.
* The third `sed` expression could be used to replace the database user name.
* The fourth `sed` expression (in the first command) could be used to replace the database user password.

### References about MySQL

* [MySQL Documentation](https://dev.mysql.com/doc/)
* MySQL 8.0 Reference Manual: [Creating and Using a Database](https://dev.mysql.com/doc/refman/8.0/en/database-use.html)
* MySQL 8.0 Reference Manual: [Data Types](https://dev.mysql.com/doc/refman/8.0/en/data-types.html)
* Learn SQL: [An Overview of MySQL Data Types](https://learnsql.com/blog/mysql-data-types/)
* Stack Overflow: [How much UTF-8 text fits in a MySQL "Text" field?](https://stackoverflow.com/a/4420195/6543935)