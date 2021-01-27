<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../repository/LessonRepository.php';

class LessonController extends AppController {

    const DAY_NAMES = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    private array $messages = [];
    private LessonRepository $lessonRepository;

    public function __construct() {
        parent::__construct();
        $this->lessonRepository = new LessonRepository();
    }

    public function timetable() {
        $monday = $this->lessonRepository->getLessons('Monday');
        $tuesday = $this->lessonRepository->getLessons('Tuesday');
        $wednesday = $this->lessonRepository->getLessons('Wednesday');
        $thursday = $this->lessonRepository->getLessons('Thursday');
        $friday = $this->lessonRepository->getLessons('Friday');
        $saturday = $this->lessonRepository->getLessons('Saturday');
        $sunday = $this->lessonRepository->getLessons('Sunday');
        $this->render('timetable', [
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            'sunday' => $sunday
        ]);
    }

    public function addLesson() {
        if (!$this->isPost()) {
            return $this->timetable();
        }

        $dayName = ucfirst($_POST['day']);
        if (!in_array($dayName, self::DAY_NAMES)) {
            return $this->timetable();
        }

        $lesson = new Lesson(
            $_POST['name'],
            ucfirst($_POST['day']),
            $_POST['description']
        );
        $this->lessonRepository->addLesson($lesson);

        return $this->timetable();
    }

    public function deleteLesson(int $id) {
        $this->lessonRepository->delete($id);
        http_response_code(200);
    }
}