<?php

/**
 * Class Application
 * 
 * @author  Spas Z. Spasov <spas.z.spasov@metalevel.tech>
 * @package app\core
 * 
 * PHP MVC Framework, based on https://github.com/thecodeholic/php-mvc-framework
 */

namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public Session $session;
    public Database $db;
    public ? DbModel $user = null;

    /**
     * Summary of __construct
     * @param string $rootPath
     * @param array $config (could contains much more config data than just the database)
     * @return Application
     */
    public function __construct(string $rootPath, array $config)
    {
        // Actually here we need to call something like: User::findOne();
        // But (as good practice) we should never use any class which is outside the core/ inside it.
        // Because the idea of the core/ is that - it is the same of the every installation...
        // and the rest of the files can be changed. So we will pass this class as $config parameter.
        $this->userClass = $config["userClass"];

        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();

        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config["db"]);


        // With the following approach we should be able to fetch the user when navigating between the pages.
        $primaryValue = $this->session->get("user");

        if ($primaryValue) {
            // $primaryKey = (new $this->userClass())->primaryKey(); // for non-static method
            $primaryKey = $this->userClass::primaryKey(); 
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            // This is not needed because the default value in the declaration above,
            // however it is leaved as it is in the lesson: https://youtu.be/mtBIu9dfclY?t=1763
            $this->user = null;
        }
    }

    /**
     * Summary of run
     * @return void
     */
    public function run(): void
    {
        echo $this->router->resolve();
    }

    /**
     * Summary of getController
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * Summary of setController
     * @param  Controller $controller
     * @return void
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * Summary of login
     * 
     * Save the user's identifier ('id' in this case) in a Session.
     * 
     * @param DbModel $user
     * 
     * @return bool
     */
    public function login(DbModel $user): bool
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set("user", $primaryValue);
        return true;
    }

    public function logout(): void
    {
        $this->user = null;
        $this->session->remove("user");
    }
}