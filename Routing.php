<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/UserController.php';
require_once 'src/controllers/TaskController.php';
require_once 'src/controllers/LessonController.php';
require_once 'src/models/User.php';
require_once 'src/repository/UserRepository.php';
require_once 'Route.php';

class Routing {
    public const ROLE_ADMIN = 2;
    public const ROLE_USER = 1;
    public const ROLE_ANONYM = 0;

    public static array $routes;

    public static function get(string $url, string $view, int $role = self::ROLE_ANONYM): void {
        self::$routes[$url] = new Route($url, $view, $role);
    }

    public static function post(string $url, string $view, int $role = self::ROLE_ANONYM): void {
        self::get($url, $view, $role);
    }

    public static function run(string $url): void {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];
        $id = $urlParts[1] ?? '';
        $route = self::getRoute($action);
        $user = new User("", "", "");

        if (!$route) {
            $route = self::getRoute("");
            $action = "";
        }

        if (session_status() === PHP_SESSION_ACTIVE && !empty($_SESSION['user_email'])) {
            $repository = new UserRepository();
            $user = $repository->getUserByEmail($_SESSION['user_email']);
        }

        if ($route->getRole() > $user->getIdRole()) {
            $action = "";
        }

        $controller = $route->getView();
        if ($action) {
            $object = new $controller;
            $object->$action($id);
        } else {
            if ($user->getIdRole() > self::ROLE_ANONYM) {
                (new TaskController())->tasks();
            } else {
                (new DefaultController())->login();
            }
        }
    }

    public static function getRoute(string $url): ?Route {
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
