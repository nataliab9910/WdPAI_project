<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class UserController extends AppController {

    const MAX_FILE_SIZE = 1024 * 1024; # 1024 kb
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function admin() {
        $users = $this->userRepository->getUsersInfo();
        $this->render('admin-page', ['users' => $users]);
    }

    public function user_account() {
        $user = $this->userRepository->getUserByEmail($_SESSION['user_email']);
        $this->render('user-account', ['user_photo' => $user->getPhoto()]);
    }

    public function search() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);

            echo json_encode($this->userRepository->getUserByName($decoded['search']));
        }
    }

    public function changePassword() {
        if (!$this->isPost()) {
            return $this->render('user-account');
        }

        $currentPassword = $_POST['current-password'];
        $newPassword = $_POST['new-password'];
        $confirmedPassword = $_POST['new-password-confirm'];

        if ($newPassword !== $confirmedPassword) {
            return $this->render('user-account', ['passmessages' => ['Passwords does not match.']]);
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

    public function changePhoto() {
        if (!($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))) {
            return $this->render('user-account', ['messages' => ['Problem with uploaded photo.']]);
        }

        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
        );

        $photo = substr(self::UPLOAD_DIRECTORY, 4).$_FILES['file']['name'];
        $user = $this->userRepository->getUserByEmail($_SESSION['user_email']);
        $this->userRepository->changePhoto($user, $photo);
        // TODO: change user image

        return $this->render('user-account', ['Changed user photo.' => $this->messages, 'user_photo' => $photo]);
    }

    private function validate(array $file): bool {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is to large!';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported.';
            return false;
        }

        return true;
    }

}