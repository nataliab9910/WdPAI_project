<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/admin-page.css">
    <script src="https://kit.fontawesome.com/74a1017984.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/scripts/search.js" defer></script>
    <title>ADMIN</title>
</head>
<body>
<div class="container">
    <div class="search-bar base-container">
        <input placeholder="search user">
    </div>
    <section class="users">
        <?php foreach ($users as $user): ?>
            <div class="base-container user-container" id="user1">
                <img class="photo" src="public/img/user.png">
                <h3 class="name"><?= $user->getName().' '.$user->getSurname(); ?></h3>
                <h3 class="email"><?= $user->getEmail(); ?></h3>
                <h3 class="role"><?php if($user->getIdRole() === 1) : ?>user<?php else : ?> admin <?php endif; ?></h3>
                <button>Delete user</button>
                <button>Delete photo</button>
                <button>Give admin role</button>
                <button>Give user role</button>
            </div>
        <?php endforeach; ?>
    </section>

</div>
<?php include 'menubars.php' ?>
</body>

<template id="user-template">
    <div class="base-container user-container" id="">
<!--        TODO update photo-->
        <img class="photo" src="public/img/user.png">
        <h3 class="name">name</h3>
        <h3 class="email">email</h3>
        <h3 class="role">role</h3>
        <button>Delete user</button>
        <button>Delete photo</button>
        <button>Give admin role</button>
        <button>Give user role</button>
    </div>
</template>

</html>
