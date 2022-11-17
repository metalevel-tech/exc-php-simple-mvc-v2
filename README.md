# PHP Model View Controller (MVC)

Sample example of PHP MVC. It is like a tutorial and follows the guide ["Build PHP MVC Framework from Scratch"](https://www.youtube.com/watch?v=WKy-N0q3WRo&list=PLLQuc_7jk__Uk_QnJMPndbdKECcTEwTA1) course provided by The Codeholic at YouTube. The full course is about 6 hours and 30 minutes long.

## References

* The Codeholic at YouTube: ["Build PHP MVC Framework from Scratch"](https://www.youtube.com/watch?v=WKy-N0q3WRo&list=PLLQuc_7jk__Uk_QnJMPndbdKECcTEwTA1)
* The Codeholic at GitHub: ["Build PHP MVC Framework from Scratch"](https://github.com/thecodeholic/php-mvc-framework)
* MLT Wiki: [Git CLI hints](https://wiki.metalevel.tech/wiki/Git_CLI_hints)
* Free Code Camp: [Push a new local branch to a remote Git repository and track it too](https://forum.freecodecamp.org/t/push-a-new-local-branch-to-a-remote-git-repository-and-track-it-too/13222)
* Bootstrap: [Bootstrap 5.2 download](https://getbootstrap.com/docs/5.2/getting-started/download/)

## Stages

### Stage 1

* Custom Routing
* Controllers
* Views
* Layouts
* Project Structure
* The project as a Composer package

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
