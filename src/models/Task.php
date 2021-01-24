<?php


class Task {

    private $title;
    private $completed;

    public function __construct($title, $completed) {
        $this->title = $title;
        $this->completed = $completed;
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
}