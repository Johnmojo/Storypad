<!--Dashboard area, user can log out once done-->
<?php

//Include db handler
include('../includes/dbh.php');

//Start the session
session_start();

//If NOT in session, redirect to login.php
if (!isset($_SESSION['usersUid'])) {
    header("Location: ./login.php");
}

//Get current session
$usersUidSession = $_SESSION['usersUid'];

//String for user & table combined
$usersUidTable = 'users_' . $usersUidSession;

//Check if POST return something
if (isset($_POST['submitContent'])) {
    //Prepare query for content submission
    $stmt1 = $pdo->prepare("INSERT INTO $usersUidTable (usersContent) VALUES (?)");
    //Execute query
    $stmt1->execute([$_POST['usersContent']]);
}

//Check if POST return something
if (isset($_POST['submitContentUpdate'])) {
    //Prepare query for content submission
    $stmt3 = $pdo->prepare("UPDATE $usersUidTable SET usersContent=? WHERE idContent=(?)");
    //Execute query
    $stmt3->execute([$_POST['usersContentUpdate'], $_POST['idContentUpdate']]);
}

//Check if GET return something
if (isset($_GET['delete'])) {
    //Prepare query for content submission
    $stmt2 = $pdo->prepare("DELETE FROM $usersUidTable WHERE idContent=(?)");
    //Execute query
    $stmt2->execute([$_GET['delete']]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Dashboard | StoryPad</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard__parent">
        <div class="dashboard__parent__header">
            <a href="./logout.php">Log Out</a>
        </div>
        <h1>Welcome, <?php echo htmlspecialchars($usersUidSession) ?></h1>
        <div class="dashboard__parent__action">
            <form class="dashboard__parent__action__form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <textarea required type="text" name="usersContent" maxlength="1000" placeholder="Write something..."></textarea>
                <input type="submit" class="dashboard__parent__action--submit" name="submitContent" value="Submit">
            </form>
        </div>
        <div class="dashboard__parent__journal">
            <?php

            //Query content
            $queryUsersContents = $pdo->query("SELECT usersContent,idContent from $usersUidTable")->fetchAll();

            if (empty($queryUsersContents)) {
                echo "<h2 class='dashboard__parent__action__empty'>Note you add appear here</h2>";
            } else {
                foreach ($queryUsersContents as $queryUsersContent) {
                    echo "<form id='clickContentBox' method='POST' action='dashboard.php' class='dashboard__parent__journal__card'>" . "<div id='clickContentAction' class='dashboard__parent__journal__card__action'><a class='dashboard__parent__journal__card__action__delete'  href=" . $_SERVER['PHP_SELF'] . "?delete=" . $queryUsersContent['idContent'] . "><i class='far fa-trash-alt'></i></a>" . "<input type='hidden' value=" . $queryUsersContent['idContent'] . " name='idContentUpdate'>" . "<input class='dashboard__parent__journal__card__action__update' name='submitContentUpdate' type='submit' value='Update'></div>" . "<textarea required id='clickContentTextarea' name='usersContentUpdate' class='dashboard__parent__action__content'>" . $queryUsersContent['usersContent'] . "</textarea>" . "</form>";
                }
            }

            ?>
        </div>
    </div>
</body>

</html>