<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="public/scripts/validation.js" defer></script>
    <title>SIGN UP</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="public/img/logo.svg">
    </div>
    <div class="base-container">
        <form class="login valid" action="signup" method="POST">
            <div class="message">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <h1>SIGN UP</h1>
            <div class="input-icon">
                <i class="fas fa-user icon"></i>
                <input name="name" type="text" placeholder="name">
            </div>
            <div class="input-icon">
                <i class="fas fa-user-tie icon"></i></i>
                <input name="surname" type="text" placeholder="surname">
            </div>
            <div class="input-icon">
                <i class="fas fa-envelope-open icon"></i>
                <input name="email" type="text" placeholder="email address">
            </div>
            <div class="input-icon">
                <i class="fas fa-unlock-alt icon"></i>
                <input name="password" type="password" placeholder="password">
            </div>
            <div class="input-icon">
                <i class="fas fa-lock icon"></i>
                <input name="confirmedPassword" type="password" placeholder="confirm password">
            </div>
            <div class="submit-button">
                <button>Create Account</button>
            </div>
        </form>
    </div>
    <div class="motto">
        <p>for the worthiest life</p>
    </div>
</div>
</body>