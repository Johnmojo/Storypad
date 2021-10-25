<?php

session_start();

if (isset($_SESSION['usersUid'])) {
    header("Location: ./includes/dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Quick Note</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/29e756bbd4.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="index__parent">
        <img src="img/icon.png" alt="Icon">
        <h2>A tiny platform to write & manage your epic stories.</h2>
        <h3><i class="far fa-check-circle"></i> Simple</h3>
        <h3><i class="far fa-check-circle"></i> No email required</h3>
        <div class="index__parent__action">
            <a href="includes/register.php">Sign Up</a>
            <a href="includes/login.php">Log in</a>
        </div>
    </div>

</body>

</html>