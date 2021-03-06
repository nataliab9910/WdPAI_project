<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <title>LOGIN</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="public/img/logo.svg">
    </div>
    <div class="base-container">
        <form class="login" action="login" method="POST">
            <div class="message">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <div class="input-icon">
                <i class="fas fa-user icon"></i>
                <input name="email" type="text" placeholder="email">
            </div>
            <div class="input-icon">
                <i class="fas fa-unlock-alt icon"></i>
                <input name="password" type="password" placeholder="password">
            </div>
            <div class="submit-button">
                <button type="submit">LOGIN</button>
            </div>
        </form>
        <p>or</p>
        <form class="sign-up" action="sign_up">
            <div class="sign-up-button submit-button">
                <button>SIGN UP</button>
            </div>
        </form>
    </div>
    <div class="motto">
        <p>for the worthiest life</p>
    </div>
</div>
</body>