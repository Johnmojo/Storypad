<?php

//Include db handler
include('../includes/dbh.php');

session_start();

if (isset($_SESSION['usersUid'])) {
    header("Location: ./dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Quick Note | Sign Up</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="signup__parent">
        <div class="signup__parent__header">
            <a href="../index.php">Home</a>
            <a href="./login.php">Log in</a>
        </div>
        <h1>Sign Up</h1>
        <h2>It's quick and easy.</h2>
        <div class="signup__parent__action">
            <form class="signup_parent__action__form" action="./registered.php" method="POST">
                <label>Username</label>
                <input type="text" name="usersUid" minlength="8" required>
                <label>Password</label>
                <input type="text" name="usersPwd" minlength="8" required>
                <input type="submit" name="submitSignUp" value="Sign Up">
            </form>

        </div>
    </div>

</body>

</html>