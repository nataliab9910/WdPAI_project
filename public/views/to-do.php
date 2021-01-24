<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/to-do.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <title>TO-DO LISTS</title>
</head>
<body>
<div class="container">
    <div class="task-list">
        <h2>
            FUTURE TASKS
        </h2>
        <div class="task" draggable="true">
            <h3>Learn PHP</h3>
            <button class="function-button"><i class="fas fa-times-circle"></i></button>
        </div>
        <div class="add-task task">
            <form class="add-task">
                <input name="title" type="text" placeholder="Add task...">
                <button class="function-button"><i class="fas fa-plus-circle"></i></button>
            </form>
        </div>
    </div>
    <div class="task-list">
        <h2 class="header">
            ACTUAL TASKS
        </h2>
        <div class="task" draggable="true">
            <h3>Learn PHP</h3>
            <button class="function-button"><i class="fas fa-times-circle"></i></button>
        </div>
        <div class="add-task task">
            <form class="add-task">
                <input name="title" type="text" placeholder="Add task...">
                <button class="function-button"><i class="fas fa-plus-circle"></i></button>
            </form>
        </div>
    </div>
    <div class="task-list">
        <h2 class="header">
            DOING TASKS
        </h2>
        <div class="task" draggable="true">
            <h3>Learn PHP</h3>
            <button class="function-button"><i class="fas fa-times-circle"></i></button>
        </div>
        <div class="add-task task">
            <form class="add-task">
                <input name="title" type="text" placeholder="Add task...">
                <button class="function-button"><i class="fas fa-plus-circle"></i></button>
            </form>
        </div>
    </div>
    <div class="task-list">
        <h2 class="header">
            DONE TASKS
        </h2>
        <div class="task" draggable="true">
            <h3>Learn PHP</h3>
            <button class="function-button"><i class="fas fa-times-circle"></i></button>
        </div>
        <div class="add-task task">
            <form class="add-task">
                <input name="title" type="text" placeholder="Add task...">
                <button class="function-button"><i class="fas fa-plus-circle"></i></button>
            </form>
        </div>
    </div>
    <div class="bottom-bar">
        <div class="select-list">
            <select>
                <option>a</option>
                <option>b</option>
                <option>c</option>
                <option>d</option>
                <option>e</option>
                <option>Add new list...</option>
            </select>
        </div>
        <div class="co-workers">
            <div class="person">
                <div class="photo"> tu będzie foto</div>
                Anna Kowlska
            </div>
            <div class="person">
                <div class="photo"> tu będzie foto</div>
                Anna Kowlska
            </div>
            <div class="person">
                <div class="photo"> tu będzie foto</div>
                Anna Kowlska
            </div>
            <button class="function-button"><i class="fas fa-plus-circle"></i></button>
        </div>
    </div>

</div>
<?php include 'menubars.php' ?>
</body>
</html>