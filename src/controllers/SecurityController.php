<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController {

    const MIN_PASSWORD_LENGTH = 5;
    const VALID_MESSAGE = 'OK';

    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login() {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User doesn\'t exist!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email doesn\'t exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION['user_email'] = $user->getEmail();
        $_SESSION['user_id'] = $user->getId();
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/tasks");
    }

    public function signup() {
        if (!$this->isPost()) {
            return $this->render('sign-up');
        }

        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        if ($name === "" || $surname === "" || $email === "" || $password === "" || $confirmedPassword === "") {
            return $this->render('sign-up', ['messages' => ['Please fill all fields.']]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('sign-up', ['messages' => ['Email address is not valid.']]);
        }

        $message = $this->passwordValidation($password, $confirmedPassword);
        if (strcmp($message, self::VALID_MESSAGE) != 0) {
            return $this->render('sign-up', ['messages' => [$message]]);
        }

        $user = new User($name, $surname, $email, password_hash($password, PASSWORD_BCRYPT));

        if (!$this->userRepository->addUser($user)) {
            return $this->render('login', ['messages' => ['User with this email already exists!']]);
        }

        return $this->render('login', ['messages' => ['Registration successful!']]);
    }

    public function changePassword() {
        if (!$this->isPost()) {
            return $this->render('user-account');
        }

        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        $message = $this->passwordValidation($newPassword, $confirmedPassword);
        if (strcmp($message, self::VALID_MESSAGE) != 0) {
            return $this->render('user-account', ['passmessages' => [$message]]);
        }

        if (!isset($_SESSION['user_email'])) {
            return $this->render('login', ['passmessages' => ['Something went wrong.']]);
        }

        $user = $this->userRepository->getUserByEmail($_SESSION['user_email']);
        if (!password_verify($currentPassword, $user->getPassword())) {
            return $this->render('user-account', ['passmessages' => ['Wrong password!']]);
        }

        if ($currentPassword === $newPassword) {
            return $this->render('user-account', ['passmessages' => ["New password can't be the same as old."]]);
        }

        $this->userRepository->changePassword($user, password_hash($newPassword, PASSWORD_BCRYPT));
        return $this->render('user-account', ['passmessages' => ["Password changed!"]]);
    }

    public function logout() {
        if (!empty($_SESSION['user_email']) || !empty($_SESSION['user_id'])) {
            $this->userRepository->addToLogs();
        }

        unset($_SESSION['user_email']);
        unset($_SESSION['user_id']);
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

    private function passwordValidation($password, $confirmedPassword): string {
        if (strlen($password) < self::MIN_PASSWORD_LENGTH) {
            return 'Password minimum length is ' . self::MIN_PASSWORD_LENGTH . ' characters.';
        }

        if (strpos($password, " ") || !preg_match('~[0-9]+~', $password)) {
            return 'Password should contain number and no spaces.';
        }

        if ($password !== $confirmedPassword) {
            return 'Passwords does not match.';
        }

        return self::VALID_MESSAGE;
    }
}