<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/menubars.css">
    <link rel="stylesheet" type="text/css" href="public/css/to-do.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <title>TO-DO LISTS</title>
</head>
<body>
<div class="container">
    <div class="task-list">
        <div class="header">
            FUTURE TASKS
        </div>
        <div class="task" draggable="true">
            LEARN PHP
        </div>
        <button class="add-task"><i class="fas fa-plus-circle"></i></button>
    </div>
    <div class="task-list">
        <div class="header">
            ACTUAL TASKS
        </div>
        <div class="task" draggable="true">
            LEARN PHP
        </div>
        <button class="add-task"><i class="fas fa-plus-circle"></i></button>
    </div>
    <div class="task-list">
        <div class="header">
            DOING TASKS
        </div>
        <div class="task" draggable="true">
            LEARN PHP
        </div>
        <button class="add-task"><i class="fas fa-plus-circle"></i></button>
    </div>
    <div class="task-list">
        <div class="header">
            DONE TASKS
        </div>
        <div class="task" draggable="true">
            LEARN PHP
        </div>
        <button class="add-task"><i class="fas fa-plus-circle"></i></button>
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
            <button class="add-co-worker"><i class="fas fa-plus-circle"></i></button>
        </div>
    </div>

</div>
<div class="bars">
    <div class="menubar">
        <div class="options-list">
            <ul>
                <li>
                    <a href="welcome">
                        <span class="menu-icon"><i class="fas fa-play"></i></span>
                        <span class="title">START</span>
                    </a>
                </li>
                <li>
                    <a href="timetable">
                        <span class="menu-icon"><i class="fas fa-calendar-day"></i></span>
                        <span class="title">TIMETABLE</span>
                    </a>
                </li>
                <li>
                    <a href="notes">
                        <span class="menu-icon"><i class="fas fa-sticky-note"></i></span>
                        <span class="title">NOTES</span>
                    </a>
                </li>
                <li>
                    <a href="to_do" class="active">
                        <span class="menu-icon"><i class="fas fa-tasks"></i></span>
                        <span class="title">TO-DO LISTS</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="goodbye-list">
            <ul>
                <li>
                    <a href="login">
                        <span class="menu-icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="title">LOGOUT</span>
                    </a>
                </li>
                <li>
                    <a href="#mail">
                        <span class="menu-icon"><i class="far fa-envelope"></i></span>
                        <span class="title">CONTACT US</span>
                    </a>
                </li>
                <li>
                    <div class="social-buttons">
                        <a href="#instagram">
                            <span class="menu-icon"><i class="fab fa-instagram-square"></i></span>
                        </a>
                        <a href="#facebook">
                            <span class="menu-icon"><i class="fab fa-facebook-square"></i></span>
                        </a>
                        <a href="#twitter">
                            <span class="menu-icon"><i class="fab fa-twitter-square"></i></span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="navbar">
        <a href="#menu" onclick="toggleMenu()"><i class="fas fa-bars"></i>
        </a> <!TODO: change href?>
        <a href="welcome"><img src="public/img/logo.svg">
        </a>
        <a href="#account"><i class="fas fa-user"></i>
        </a>
    </div>
    <script type="text/javascript">
        function toggleMenu() {
            let menubar = document.querySelector('.menubar');
            menubar.classList.toggle('active');
        }
    </script>
</div>
</body>
</html>