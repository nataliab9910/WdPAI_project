<?php

require_once  'src/controllers/DefaultController.php';
require_once  'src/controllers/SecurityController.php';
require_once  'src/controllers/UserController.php';
require_once  'src/controllers/TaskController.php';
require_once  'src/models/User.php';
require_once  'src/repository/UserRepository.php';
require_once  'Route.php';

class Routing {
    public const ROLE_ADMIN  = 2;
    public const ROLE_USER   = 1;
    public const ROLE_ANONYM = 0;

    public static $routes;

    public static function get($url, $view, $role = self::ROLE_ANONYM) {
        self::$routes[$url] = new Route($url, $view, $role);
    }

    public static function post($url, $view, $role = self::ROLE_ANONYM) {
        self::get($url, $view, $role);
    }

    public static function run($url) {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];
        $id = $urlParts[1] ?? ''; // TODO walidacja czy to int i czy na pewno możemy przekazać do kontrolera
        $route = self::getRoute($action);
        $user = new User("", "", "", "", self::ROLE_ANONYM);

        if (!$route) {
            die("Wrong url");
        }

        if ($_SESSION && !empty($_SESSION['user_email'])) {
            $repository = new UserRepository();
            $user = $repository->getUser($_SESSION['user_email']);
        }

        if ($route->getRole() > $user->getRole()) {
            die("Access denied");
        }

        $controller = $route->getView();
        if ($action) {
            $object = new $controller;
            $object->$action($id);
        } else {
            if ($user->getRole() > self::ROLE_ANONYM) {
                (new TaskController())->tasks();
            } else {
                (new DefaultController())->login();
            }
        }
    }

    public static function getRoute($url): ?Route {
        $route = array_filter(self::$routes, function (Route $a) use ($url) {
            if ($a->getUrl() === $url) {
                return true;
            }
            return false;
        });

        if ($route) {
            return array_pop($route);
        }

        return null;
    }

}
