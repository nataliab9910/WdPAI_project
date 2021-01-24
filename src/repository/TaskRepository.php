<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Task.php';

class TaskRepository extends Repository {

    public function getTask(int $id): ?Task {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.tasks WHERE id = :id
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
            SELECT * FROM tasks
        ');
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
           INSERT INTO public.tasks (id_user, title, created_at) VALUES (?, ?, ?)
        ');

        // TODO get this from user session
        $assignedById = 1;

        $stmt->execute([
            $assignedById,
            $task->getTitle(),
            $date->format('Y-m-d')
        ]);
    }
}