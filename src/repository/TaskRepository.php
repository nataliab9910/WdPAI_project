<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Task.php';

class TaskRepository extends Repository {

    public function getTask(int $id): ?Task {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM tasks WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

       $task = $stmt->fetch(PDO::FETCH_ASSOC);

       if ($task == false) {
           // TODO change null to exception
           return null;
       }

       return new Task(
           $task['title'], $task['completed']
       );
    }

    public function getTasks(): array {

        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM tasks WHERE id_user = :id_user
        ');
        $stmt->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tasks as $task) {
            $result[] = new Task($task['title'], $task['completed']);
        }

        return $result;
    }

    public function addTask(Task $task): void {

        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
           INSERT INTO tasks (id_user, title, created_at) VALUES (?, ?, ?)
        ');

        $assignedById = $_SESSION['user_id'];

        $stmt->execute([
            $assignedById,
            $task->getTitle(),
            $date->format('Y-m-d')
        ]);
    }
}