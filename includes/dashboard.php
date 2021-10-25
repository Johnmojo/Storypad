<?php

//Include db handler
include('../includes/dbh.php');

session_start();

//Check session
if (!isset($_SESSION['usersUid'])) {
    header("Location: ./login.php");
}

//Current session
$usersUidSession = $_SESSION['usersUid'];

//String for user & table
$usersUidTable = 'users_' . $usersUidSession;

$yay = "false";

if (isset($_POST['submitContent'])) {
    $stmt1 = $pdo->prepare("INSERT INTO $usersUidTable (usersContent) VALUES (?)");
    $stmt1->execute([$_POST['usersContent']]);
}

if (isset($_POST['submitContentUpdate'])) {
    $stmt3 = $pdo->prepare("UPDATE $usersUidTable SET usersContent=? WHERE idContent=(?)");
    $stmt3->execute([$_POST['usersContentUpdate'], $_POST['idContentUpdate']]);
}

if (isset($_GET['delete'])) {
    $stmt2 = $pdo->prepare("DELETE FROM $usersUidTable WHERE idContent=(?)");
    $stmt2->execute([$_GET['delete']]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title>Dashboard | Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
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
                    echo "<form id='clickContentBox' method='POST' action='dashboard.php' class='dashboard__parent__journal__card'>" . "<div id='clickContentAction' class='dashboard__parent__journal__card__action' style='opacity:0.25; transition:0.5s;'><a class='dashboard__parent__journal__card__action__delete'  href=" . $_SERVER['PHP_SELF'] . "?delete=" . $queryUsersContent['idContent'] . "><i class='far fa-trash-alt'></i></a>" . "<input type='hidden' value=" . $queryUsersContent['idContent'] . " name='idContentUpdate'>" . "<input class='dashboard__parent__journal__card__action__update' name='submitContentUpdate' type='submit' value='Update'></div>" . "<textarea required id='clickContentTextarea' name='usersContentUpdate' class='dashboard__parent__action__content'>" . $queryUsersContent['usersContent'] . "</textarea>" . "</form>";
                }
            }

            ?>
        </div>
    </div>
</body>

</html>