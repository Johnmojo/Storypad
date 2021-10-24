<?php

//Include db handler
include('../includes/dbh.php');

session_start();

if (isset($_SESSION['usersUid'])) {
    header("Location: ./dashboard.php");
}

//Error indicator
$errorRegister = false;

if (isset($_POST['submitSignUp'])) {
    //Get user id field
    $usersUid = $_POST['usersUid'];

    //String for user & table
    $usersUidTable = 'users_' . $usersUid;

    // Gather userID pool
    $stmt0 = $pdo->prepare("SELECT * FROM users WHERE usersUid =?");
    $stmt0->execute([$_POST['usersUid']]);
    $user = $stmt0->fetch();

    //Check if return true or false
    if ($user) {
        $errorRegister = true;
    } else {
        //Proceed with registration, hash the password
        $hashed_usersPwd = password_hash($_POST['usersPwd'], PASSWORD_DEFAULT);

        //Prepare username & password
        $stmt1 = $pdo->prepare("INSERT INTO users (usersUid,hashed_usersPwd) VALUES (?,?); CREATE TABLE $usersUidTable (idContent INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT, usersContent varchar(255) NOT NULL);");

        //Insertion
        $stmt1->execute([$usersUid, $hashed_usersPwd]);

        //Redirect
        header("Location: ./registered.php");
    }
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
            <?php
            if ($errorRegister) {
                echo "<div class='register__parent__action__error'>User name taken. Perhaps try another name?</div>";
            }
            ?>
            <form class="signup_parent__action__form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
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