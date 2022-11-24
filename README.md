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

## Stages

### Stage 1

* Routing
* Controllers
* Views
* Layouts
* Project Structure
* Composer initialize and autoload

### Stage 2

* Registration and login forms
* Modules
* Forms
* Validation

### Stage 3

* Database connection
* Migration

## PHP Hints

You can run the PHP built-in web server by `php -S localhost:8000`.

Dup variables in PHP:

```php
echo '<pre>';
var_dump($position);
echo '</pre>';
exit;
```

## Autoload classes by the help of Composer

Initialize the project by `composer init` which will create a `composer.json` file. Then setup the [autoload](https://youtu.be/GTESlsYTUns?t=540) option. Another way is to use the [`spl_autoload_register()`](https://github.com/metalevel-tech/php-simple-mvc-v1/blob/master/index.php#L5) function.
