<?php


class Task {

    private $title;
    private $completed;
    private $id;

    public function __construct($title, $completed = false, $id = null) {
        $this->title = $title;
        $this->completed = $completed;
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function getCompleted() {
        return $this->completed;
    }

    public function setCompleted($completed): void {
        $this->completed = $completed;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

}