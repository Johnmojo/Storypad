<?php

//Include db handler
include('../includes/dbh.php');

session_start();

//Check session
if (isset($_SESSION['usersUid'])) {
    header("Location: ./dashboard.php");
}

//Error indicator
$indicateError = false;

if (isset($_POST['submitLogIn'])) {
    //Establish PDO
    $stmt = $pdo->prepare("SELECT * FROM users WHERE usersUid=?");
    $stmt->execute([$_POST['usersUid']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['usersPwd'], $user['hashed_usersPwd'])) {
        session_start();
        $_SESSION['usersUid'] = $user['usersUid'];
        header("Location: ./dashboard.php");
        exit;
    } else {
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
    <title>Quick Note | Log In</title>
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
                <input type="text" name="usersPwd" minlength="8" required>
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