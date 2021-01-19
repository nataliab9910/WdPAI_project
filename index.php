<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('notes', 'DefaultController');
Routing::get('sign_up', 'DefaultController');
Routing::get('timetable', 'DefaultController');
Routing::get('to_do', 'DefaultController');
Routing::get('user_account', 'DefaultController');
Routing::get('welcome', 'DefaultController');

Routing::post('login', 'SecurityController');

Routing::run($path);

//echo 'Hello there! 👋';
