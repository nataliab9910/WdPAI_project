<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository {

    public function getUser(string $email): ?User {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN user_details ud 
            ON u.id_user_details = ud.id WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            // TODO change null to exception
            return null;
        }

        return new User(
            $user['email'], $user['password'], $user['name'], $user['surname'], $user['id_role']
        );
    }

    public function getUserID(string $email) {

        $stmt = $this->database->connect()->prepare('
            SELECT id FROM users u WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $userId = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userId == false) {
            // TODO change null to exception
            return null;
        }

        return $userId['id'];
    }

    public function getRole(string $email) {

        $stmt = $this->database->connect()->prepare('
            SELECT id_role FROM users WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($role == false) {
            // TODO change null to exception
            return null;
        }

        return $role['id_role'];
    }

    public function getUsersInfo(): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_info
        ');
        $stmt->execute();
        $users_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users_info as $user_info) {

            $user = new User(
                $user_info['email'],
                '',
                explode(' ', $user_info['name'])[0],
                explode(' ', $user_info['name'])[1]
            );
            $user->setImage('$user_info["photo"]');
            $user->setRole($user_info['role']);
            $result[] = $user;
        }

        return $result;
    }

    public function addUser(User $user) {
        if ($this->getUser($user->getEmail())) {
            // TODO exception
            return false;
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_details (name, surname)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname()
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

    public function getUserDetailsId(User $user): int {
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

    public function getUserByName(string $searchString) {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_info WHERE LOWER(name) LIKE :search OR LOWER(email) LIKE :search OR LOWER(role) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToLogs() {

        if (empty($_SESSION['user_email'])) {
            return;
        }

        $stmt = $this->database->connect()->prepare('
            SELECT name, email FROM user_info WHERE email = :email
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

}