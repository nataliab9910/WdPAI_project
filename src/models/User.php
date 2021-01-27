<?php

class User {

    private $name;
    private $surname;
    private $email;
    private $password;
    private $photo;
    private $id;
    private $id_role;
    private $id_user_details;

    // TODO user photo

    public function __construct(string $name, string $surname, string $email, string $password = '',
                                string $photo = '/public/img/user.png', int $id = null,
                                int $id_role = Routing::ROLE_ANONYM, int $id_user_details = null) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->photo = $photo;
        $this->id = $id;
        $this->id_role = $id_role;
        $this->id_user_details = $id_user_details;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getPhoto(): string {
        return $this->photo;
    }

    public function setPhoto(string $photo): void {
        $this->photo = $photo;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getIdRole(): int {
        return $this->id_role;
    }

    public function setIdRole(int $id_role): void {
        $this->id_role = $id_role;
    }

    public function getIdUserDetails(): int {
        return $this->id_user_details;
    }

    public function setIdUserDetails(int $id_user_details): void {
        $this->id_user_details = $id_user_details;
    }
}