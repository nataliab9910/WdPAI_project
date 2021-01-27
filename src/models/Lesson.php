<?php


class Lesson {
    private string $name;
    private string $dayName;
    private string $description;
    private ?int $id;
    private ?int $idOwner;

    public function __construct(string $name, string $dayName, string $description = "", ?int $id = null, ?int $idOwner = null) {
        $this->name = $name;
        $this->dayName = $dayName;
        $this->description = $description;
        $this->id = $id;
        $this->idOwner = $idOwner;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getDayName(): string {
        return $this->dayName;
    }

    public function setDayName(string $dayName): void {
        $this->dayName = $dayName;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getIdOwner(): int {
        return $this->idOwner;
    }

    public function setIdOwner(int $idOwner): void {
        $this->idOwner = $idOwner;
    }
}