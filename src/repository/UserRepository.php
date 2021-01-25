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
            $user['email'], $user['password'], $user['name'], $user['surname']
        );
    }

    public function addUser(User $user)
    {
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

        $stmt = $stmt = $this->database->connect()->prepare("
            SELECT id FROM roles WHERE role = 'user'
        ");
        $stmt->execute();
        $id_role = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details, id_role, created_at)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user),
            $id_role,
            $date->format('Y-m-d')
        ]);

        return true;
    }

    public function getUserDetailsId(User $user): int
    {
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

}