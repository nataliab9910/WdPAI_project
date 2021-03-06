<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository {

    public function addUser(User $user): bool {
        // check if user with this email already exists in database
        if ($this->getUserByEmail($user->getEmail())) {
            return false;
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_details (name, surname, photo)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhoto()
        ]);

        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details, created_at)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user),
            $date->format('Y-m-d')
        ]);
        return true;
    }

    public function changePassword(User $user, string $password): void {
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET password = :password WHERE email = :email
        ');
        $email = $user->getEmail();
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function changePhoto(User $user, string $photo): void {
        $stmt = $this->database->connect()->prepare('
            UPDATE user_details SET photo = :photo WHERE id = :id
        ');
        $id = $user->getIdUserDetails();
        $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteUser(int $id): void {
        $user = $this->getUserById($id);
        $stmt = $this->database->connect()->prepare('
            DELETE FROM users WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $this->database->connect()->prepare('
            DELETE FROM user_details WHERE id = :user_details_id
        ');
        $user_details_id = $user->getIdUserDetails();
        $stmt->bindParam(':user_details_id', $user_details_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deletePhoto(int $id): void {
        $user = $this->getUserById($id);
        $this->changePhoto($user, UserController::DEFAULT_PHOTO);
    }

    public function giveRole(int $id, string $role): void {
        $stmt = $this->database->connect()->prepare('
            SELECT id FROM roles WHERE role = :role
        ');
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        $role_id = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['id'];

        if (!isset($role_id)) {
            return;
        }

        $user = $this->getUserById($id);
        if ($user->getIdRole() === $role_id) {
            return;
        }

        $stmt = $this->database->connect()->prepare('
            UPDATE users SET id_role = :role_id WHERE id = :id
        ');
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function addToLogs(): void {
        if (empty($_SESSION['user_email'])) {
            return;
        }

        $stmt = $this->database->connect()->prepare('
            SELECT name, email FROM view_user_info WHERE email = :email
        ');
        $stmt->bindParam(':email', $_SESSION['user_email'], PDO::PARAM_STR);
        $stmt->execute();

        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO logs (name, surname, email, datetime, host, agent)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $name = explode(' ', $userData[0]['name']);
        $stmt->execute([
            $name[0],
            $name[1],
            $userData[0]['email'],
            $date->format('Y-m-d H:i:s.u'),
            $_SERVER['HTTP_HOST'],
            $_SERVER['HTTP_USER_AGENT']
        ]);
    }

    public function getUserByEmail(string $email): ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM view_all_user_details
            WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['name'],
            $user['surname'],
            $user['email'],
            $user['password'],
            $user['photo'],
            $user['id'],
            $user['id_role'],
            $user['id_user_details']
        );
    }

    public function getUsersInfo(): array {
        // used in admin page to show all users with their emails, roles and photos
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM view_user_info
        ');
        $stmt->execute();
        $users_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users_info as $user_info) {

            $user = new User(
                explode(' ', $user_info['name'])[0],
                explode(' ', $user_info['name'])[1],
                $user_info['email'],
                '',
                $user_info["photo"],
                $user_info["id"],
                $user_info['id_role']
            );
            $result[] = $user;
        }

        return $result;
    }

    public function getUserByName(string $searchString) {
        // user in admin page to search in users
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM view_user_info WHERE LOWER(name) LIKE :search OR LOWER(email) LIKE :search OR LOWER(role) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getUserDetailsId(User $user): int {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_details WHERE name = :name AND surname = :surname
        ');
        $name = $user->getName();
        $surname = $user->getSurname();
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    private function getUserById(int $id): User {
        $stmt = $this->database->connect()->prepare('
            SELECT email FROM users WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $email = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->getUserByEmail($email[0]['email']);
    }
}