<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController {

    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login() {

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User doesn\'t exist!']]);
        }

        // TODO delete this function?
        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email doesn\'t exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $user->setRole($this->userRepository->getRole($user->getEmail()));

        $_SESSION['user_email'] = $user->getEmail();
        $_SESSION['user_id'] = $this->userRepository->getUserID($user->getEmail());
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/tasks");
    }

    public function signup() {

        if (!$this->isPost()) {
            return $this->render('sign-up');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        if ($password !== $confirmedPassword) {
            return $this->render('sign-up', ['messages' => ['Passwords does not match.']]);
        }

        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $name, $surname);

        if (!$this->userRepository->addUser($user)) {
            return $this->render('login', ['messages' => ['User with this email already exists!']]);
        }

        return $this->render('login', ['messages' => ['Registration successful!']]);

    }

    public function logout() {

        if (!empty($_SESSION['user_email']) || !empty($_SESSION['user_id'])) {
            $this->userRepository->addToLogs();
            $_SESSION['user_email'] = "";
            $_SESSION['user_id'] = "";
        }

        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

}