<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Task.php';

class TaskRepository extends Repository {

    public function getTasks(): array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM tasks WHERE id_user = :id_user
        ');
        $stmt->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tasks as $task) {
            $result[] = new Task(
                $task['title'],
                $task['completed'],
                $task['id']
            );
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

    public function check(int $id): void {
        $stmt = $this->database->connect()->prepare('
            UPDATE tasks SET completed = CASE WHEN completed = true THEN false ELSE true END WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete(int $id): void {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM tasks WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}