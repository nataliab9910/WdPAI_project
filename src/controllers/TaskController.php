<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../repository/TaskRepository.php';

class TaskController extends AppController {

    private $messages = [];
    private $taskRepository;

    public function __construct() {
        parent::__construct();
        $this->taskRepository = new TaskRepository();
    }

    public function addTask() {
        if ($this->isPost()) {
            $task = new Task($_POST['title'], false);
            $this->taskRepository->addTask($task);

            return $this->render('welcome', [
                'tasks' => $this->taskRepository->getTasks(),
                'messages' => $this->messages]);
        }

        return $this->render('welcome', ['messages' => $this->messages]);
    }

    public function tasks() {

        $tasks = $this->taskRepository->getTasks();

        $this->render('welcome', ['tasks' => $tasks]);
    }
}