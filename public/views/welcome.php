<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/menubars.css">
    <link rel="stylesheet" type="text/css" href="public/css/welcome.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <title>WELCOME</title>
</head>
<body>
<div class="container">
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
    <div class="search-container">
        <form class="search-bar">
            <button><i class="fas fa-search icon"></i></button>
            <input name="search" type="text" placeholder="Google search...">
        </form>
    </div>
    <div class="welcome-text">
        <div class="header-text">
            Hi!
            How are you today?
        </div>
    </div>
    <div class="tasks">
        <div class="header-text">
            Your tasks for today:
        </div>
        <div class="task">
            <input type="checkbox" id="coding" name="interest" value="coding">
            <label for="coding">do dishes</label>
        </div>
        <button>
            <i class="fas fa-plus-circle"></i>
        </button>

    </div>
</div>
<script type="text/javascript" src="public/scripts/calendar.js"></script>
<div class="bars">
    <div class="menubar">
        <div class="options-list">
            <ul>
                <li>
                    <a href="welcome" class="active">
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