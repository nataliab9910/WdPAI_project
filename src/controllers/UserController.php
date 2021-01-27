<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class UserController extends AppController {

    const MAX_FILE_SIZE = 1024 * 1024; # 1024 kb
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    const DEFAULT_PHOTO = '/public/img/user.png';

    private array $messages = [];
    private UserRepository $userRepository;

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
        $this->render('user-account');
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
        $user->setPhoto($photo);
        $this->userRepository->changePhoto($user, $photo);

        return $this->render('user-account');
    }

    public function deleteUser(int $id) {
        $this->userRepository->deleteUser($id);
        http_response_code(200);
    }

    public function deletePhoto(int $id) {
        $this->userRepository->deletePhoto($id);
        http_response_code(200);
    }

    public function giveUser(int $id) {
        $this->userRepository->giveRole($id, 'user');
        http_response_code(200);
    }

    public function giveAdmin(int $id) {
        $this->userRepository->giveRole($id, 'admin');
        http_response_code(200);
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