<?php

require 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('notes', 'DefaultController', Routing::ROLE_USER);
Routing::get('sign_up', 'DefaultController');
Routing::get('timetable', 'DefaultController', Routing::ROLE_USER);
Routing::get('to_do', 'DefaultController', Routing::ROLE_USER);
Routing::get('user_account', 'UserController', Routing::ROLE_USER);
Routing::get('tasks', 'TaskController', Routing::ROLE_USER);
Routing::get('admin', 'UserController', Routing::ROLE_ADMIN);
Routing::get('logout', 'SecurityController', Routing::ROLE_USER);
Routing::get('checkTask', 'TaskController', Routing::ROLE_USER);
Routing::get('deleteTask', 'TaskController', Routing::ROLE_USER);
Routing::get('deleteUser', 'UserController', Routing::ROLE_ADMIN);
Routing::get('deletePhoto', 'UserController', Routing::ROLE_ADMIN);
Routing::get('giveUser', 'UserController', Routing::ROLE_ADMIN);
Routing::get('giveAdmin', 'UserController', Routing::ROLE_ADMIN);

Routing::post('login', 'SecurityController');
Routing::post('signup', 'SecurityController');
Routing::post('changePassword', 'SecurityController');
Routing::post('changePhoto', 'UserController', Routing::ROLE_USER);
Routing::post('search', 'UserController', Routing::ROLE_ADMIN);
Routing::post('addTask', 'TaskController', Routing::ROLE_USER);
Routing::post('google', 'DefaultController', Routing::ROLE_USER);

Routing::run($path);
