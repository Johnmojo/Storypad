<?php

//Include db handler
include('../includes/dbh.php');

if (isset($_POST['submitSignUp'])) {
    //Get user id field
    $usersUid = $_POST['usersUid'];

    //String for user & table
    $usersUidTable = 'users_' . $usersUid;

    // Gather userID pool
    $stmt0 = $pdo->prepare("SELECT * FROM users WHERE usersUid =?");
    $stmt0->execute([$_POST['usersUid']]);
    $user = $stmt0->fetch();

    if ($user) {
        echo "Match, fail to register";
        $lol = true;
    } else {
    //Hash the password
    $hashed_usersPwd = password_hash($_POST['usersPwd'], PASSWORD_DEFAULT);

    //Prepare username & password
    $stmt1 = $pdo->prepare("INSERT INTO users (usersUid,hashed_usersPwd) VALUES (?,?); CREATE TABLE $usersUidTable (idContent INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT, usersContent varchar(255) NOT NULL);");

    echo "No match, registered.";
    //header("Location: ./registered.php");

    //Insertion
    //$stmt1->execute([$usersUid, $hashed_usersPwd]);
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
    <div class="index__parent">
        <div class="signup__parent__header">
            <a href="../index.php">Home</a>
            <a href="./login.php">Log in</a>
        </div>
        <h1>Thank You</h1>
        <h2>Registration success. You may sign in.</h2>
    </div>

</body>

</html>