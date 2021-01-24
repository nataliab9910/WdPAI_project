<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/welcome.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <title>WELCOME</title>
</head>
<body>
<div class="container">
    <div class="welcome-text">
        <h1>Hi!</h1>
        <h1>How are you today?</h1>
    </div>
    <form class="search-bar base-container">
        <button><i class="fas fa-search icon"></i></button>
        <input name="search" type="text" placeholder="Google search...">
    </form>
    <div class="calendar">
        <div class="header">
            <i class="fas fa-chevron-left" onclick="showPrev()"></i>
            <div class="month">
                <h1>feb</h1>
                <p>2021</p>
            </div>
            <i class="fas fa-chevron-right" onclick="showNext()"></i>
        </div>
        <div class="weekdays">
            <div>M</div>
            <div>T</div>
            <div>W</div>
            <div>T</div>
            <div>F</div>
            <div>S</div>
            <div>S</div>
        </div>
        <div class="days">
        </div>
    </div>
    <h1 class="tasks-navbar">Your tasks for today:</h1>
    <div class="tasks">
        <?php foreach ($tasks as $task): ?>
        <div class="task">
            <? if ($task->getCompleted()): ?>
            <input class="checkbox" type="checkbox" id="check-task" name="interest" value="coding" checked>
            <? else: ?>
            <input class="checkbox" type="checkbox" id="check-task" name="interest" value="coding">
            <? endif; ?>
            <h3><?= $task->getTitle(); ?></h3>
            <button class="function-button"><i class="fas fa-times-circle"></i></button>
        </div>
        <?php endforeach; ?>
        <div class="add-task task">
            <form class="add-task" action="addTask" method="POST" enctype="multipart/form-data">
                <?php
                if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
                <input name="title" type="text" placeholder="Add task...">
                <button class="function-button"><i class="fas fa-plus-circle"></i></button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="public/scripts/calendar.js"></script>
<?php include 'menubars.php' ?>
</body>
</html>