<!--Login area, redirect to dashboard.php once done-->
<?php

//Include db handler
include('../includes/dbh.php');

//Start the session
session_start();

//If session exist and matched, redirect to dashboard.php
if (isset($_SESSION['usersUid'])) {
    header("Location: ./dashboard.php");
}

//Error indicator
$indicateError = false;

//Check if POST return something
if (isset($_POST['submitLogIn'])) {
    //Prepare query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE usersUid=?");
    $stmt->execute([$_POST['usersUid']]);
    $user = $stmt->fetch();

    //Check if POST return something
    if ($user && password_verify($_POST['usersPwd'], $user['hashed_usersPwd'])) {
        //Start the session
        session_start();
        //Asign session following user id
        $_SESSION['usersUid'] = $user['usersUid'];
        //Redirect to dashboard.php
        header("Location: ./dashboard.php");
        exit;
    } else {
        //If register fail, show error
        $indicateError = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Log In | StoryPad</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="login__parent">
        <div class="login__parent__header">
            <a href="../index.php">Home</a>
            <a href="./register.php">Sign Up</a>
        </div>
        <h1>Log In</h1>
        <div class="login__parent__action">
            <form class="login_parent__action__form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <label>Username</label>
                <input type="text" name="usersUid" minlength="8" required>
                <label>Password</label>
                <input type="password" name="usersPwd" minlength="8" required>
                <input type="submit" name="submitLogIn" value="Log In">
            </form>
            <?php
            if ($indicateError) {
                echo "<div class='login__parent__action__error'>Wrong user name or password. Please try again.</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>