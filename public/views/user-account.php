<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/user-account.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <title>ACCOUNT</title>
</head>
<body>
<div class="container">
    <div class="base-container name-container">
        <h1>Anna Kowalska</h1>
        <h2>anna@kowalska.com</h2>
    </div>
    <div class="base-container photo-container">
        <img class="photo" src="public/img/user.png">
        <form action="changePhoto" method="POST" enctype="multipart/form-data">
            <?php
            if(isset($messages)) {
                foreach ($messages as $message) {
                    echo $message;
                }
            }
            ?>
            <input type="file" name="file">
            <div class="submit-button"><button type="submit">Change photo</button></div>
        </form>
    </div>
    <div class="base-container password-container">
        <h2>Change password</h2>
        <form class="password">
            <div class="input-icon">
                <i class="fas fa-user icon"></i>
                <input name="actual-password" type="text" placeholder="Current password">
            </div>
            <div class="input-icon">
                <i class="fas fa-unlock-alt icon"></i>
                <input name="new-password" type="password" placeholder="New password">
            </div>
            <div class="input-icon">
                <i class="fas fa-unlock-alt icon"></i>
                <input name="new-password-repeat" type="password" placeholder="Repeat new password">
            </div>
            <div class="submit-button">
                <button class="submit-button" type="submit">Confirm</button>
            </div>
        </form>
    </div>
</div>
<?php include 'menubars.php' ?>
</body>
</html>
