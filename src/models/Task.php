<?php


class Task {
    private string $title;
    private bool $completed;
    private ?int $id;

    public function __construct(string $title, bool $completed = false, ?int $id = null) {
        $this->title = $title;
        $this->completed = $completed;
        $this->id = $id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getCompleted(): bool {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void {
        $this->completed = $completed;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
}