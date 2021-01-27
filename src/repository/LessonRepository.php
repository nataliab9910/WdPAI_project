<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Lesson.php';


class LessonRepository extends Repository {

    public function getLessons(string $dayName): array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM lessons WHERE id_user = :id_user AND day_name = :day_name
        ');
        $stmt->bindParam(':day_name', $dayName, PDO::PARAM_STR);
        $stmt->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lessons as $lesson) {
            $result[] = new Lesson(
                $lesson['name'],
                $lesson['day_name'],
                $lesson['description'],
                $lesson['id']
            );
        }
        return $result;
    }

    public function addLesson(Lesson $lesson): void {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
           INSERT INTO lessons (id_user, name, description, day_name, created_at) VALUES (?, ?, ?, ?, ?)
        ');

        $assignedById = $_SESSION['user_id'];

        $stmt->execute([
            $assignedById,
            $lesson->getName(),
            $lesson->getDescription(),
            $lesson->getDayName(),
            $date->format('Y-m-d')
        ]);
    }

    public function delete(int $id): void {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM lessons WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}