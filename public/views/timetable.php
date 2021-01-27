<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/timetable.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/scripts/popup.js" defer></script>
    <script type="text/javascript" src="./public/scripts/lesson-delete.js" defer></script>
    <title>TIMETABLE</title>
</head>
<body>
<div class="container">
    <div class="base-container">
        <?php
        if(isset($messages)) {
            foreach ($messages as $message) {
                echo $message;
            }
        }
        ?>
        <h2>Monday</h2>
        <?php foreach ($monday as $lesson): ?>
        <div class="lesson" id="<?= $lesson->getId(); ?>">
            <?= $lesson->getName(); ?><br>
            <?= $lesson->getDescription(); ?>
            <button class="function-button" ><i class="fas fa-times-circle"></i></button>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="base-container">
        <h2>Tuesday</h2>
        <?php foreach ($tuesday as $lesson): ?>
            <div class="lesson" id="<?= $lesson->getId(); ?>">
                <?= $lesson->getName(); ?><br>
                <?= $lesson->getDescription(); ?>
                <button class="function-button" ><i class="fas fa-times-circle"></i></button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="base-container">
        <h2>Wednesday</h2>
        <?php foreach ($wednesday as $lesson): ?>
            <div class="lesson" id="<?= $lesson->getId(); ?>">
                <?= $lesson->getName(); ?><br>
                <?= $lesson->getDescription(); ?>
                <button class="function-button" ><i class="fas fa-times-circle"></i></button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="base-container">
        <h2>Thursday</h2>
        <?php foreach ($thursday as $lesson): ?>
            <div class="lesson" id="<?= $lesson->getId(); ?>">
                <?= $lesson->getName(); ?><br>
                <?= $lesson->getDescription(); ?>
                <button class="function-button" ><i class="fas fa-times-circle"></i></button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="base-container">
        <h2>Friday</h2>
        <?php foreach ($friday as $lesson): ?>
            <div class="lesson" id="<?= $lesson->getId(); ?>">
                <?= $lesson->getName(); ?><br>
                <?= $lesson->getDescription(); ?>
                <button class="function-button" ><i class="fas fa-times-circle"></i></button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="base-container">
        <h2>Saturday</h2>
        <?php foreach ($saturday as $lesson): ?>
            <div class="lesson" id="<?= $lesson->getId(); ?>">
                <?= $lesson->getName(); ?><br>
                <?= $lesson->getDescription(); ?>
                <button class="function-button" ><i class="fas fa-times-circle"></i></button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="base-container">
        <h2>Sunday</h2>
        <?php foreach ($sunday as $lesson): ?>
            <div class="lesson" id="<?= $lesson->getId(); ?>">
                <?= $lesson->getName(); ?><br>
                <?= $lesson->getDescription(); ?>
                <button class="function-button" ><i class="fas fa-times-circle"></i></button>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="open-button" onclick="openForm()">Add lesson</button>
    <div class="form-popup" id="myForm">
        <form action="addLesson" method="POST" class="form-container">
            <h2>Lesson</h2>
            <label for="name">Name</label>
            <input type="text" placeholder="name" name="name">

            <label for="description">Description</label>
            <input type="text" placeholder="description" name="description">

            <label for="day">Day name</label>
            <input type="text" placeholder="day name" name="day">

            <button type="submit" class="btn">Add</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>
</div>
<?php include 'menubars.php' ?>
</body>
</html>