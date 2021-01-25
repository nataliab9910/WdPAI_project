<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/menubars.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="bars">
    <div class="menubar">
        <div class="options-list">
            <ul>
                <li>
                    <a href="tasks" class="active">
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
                    <a href="to_do">
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
        <a onclick="toggleMenu()"><i class="fas fa-bars"></i>
        </a> <!TODO: change href?>
        <a href="welcome"><img src="public/img/logo.svg">
        </a>
        <a href="user_account"><i class="fas fa-user"></i>
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