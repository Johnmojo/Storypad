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
</head>

<body>
    <div class="index__parent">
        <h1>Quick Note</h1>
        <h2>A quick note-taking platform for people who writes.</h2>
        <div class="index__parent__action">
            <a href="includes/register.php">Sign Up</a>
            <a href="includes/login.php">Log in</a>
        </div>
    </div>

</body>

</html>