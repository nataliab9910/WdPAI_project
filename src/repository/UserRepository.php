<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository {

    public function getUserByEmail(string $email): ?User {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM view_all_user_details
            WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            // TODO change null to exception
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

    // TODO
    //public function getUserID(string $email) {
    //
    //    $stmt = $this->database->connect()->prepare('
    //        SELECT id FROM users u WHERE email = :email
    //    ');
    //
    //    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    //    $stmt->execute();
    //
    //    $userId = $stmt->fetch(PDO::FETCH_ASSOC);
    //
    //    if ($userId == false) {
    //        // TODO change null to exception
    //        return null;
    //    }
    //
    //    return $userId['id'];
    //}

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

    public function addUser(User $user) {
        // check if user with this email already exists in database
        if ($this->getUserByEmail($user->getEmail())) {
            // TODO exception
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
        // user in admin page to search in users
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM view_user_info WHERE LOWER(name) LIKE :search OR LOWER(email) LIKE :search OR LOWER(role) LIKE :search
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

}