<?php

//Include db handler
include('../includes/dbh.php');

session_start();

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
    echo "updateed";
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
        <div class="dashboard__parent__journal">
            <?php

            //Query content
            $queryUsersContents = $pdo->query("SELECT usersContent,idContent from $usersUidTable")->fetchAll();

            if (empty($queryUsersContents)) {
                echo "<div class='dashboard__parent__action__empty'>Add your first journal.</div>";
            } else {
                foreach ($queryUsersContents as $queryUsersContent) {
                    echo "<form method='POST' action='dashboard.php' class='dashboard__parent__journal__card'>" . "<div class='dashboard__parent__journal__card__action'><a href=" . $_SERVER['PHP_SELF'] . "?delete=" . $queryUsersContent['idContent'] . ">Delete</a>" . "<input type='hidden' value=" . $queryUsersContent['idContent'] . " name='idContentUpdate'></input>" . "<input name='submitContentUpdate' type='submit' value='Update' href=" . "></input></div>" . "<textarea name='usersContentUpdate' class='dashboard__parent__action__content'>" . $queryUsersContent['usersContent'] . "</textarea>" . "</form>";
                }
            }

            ?>
        </div>
        <div class="dashboard__parent__action">
            <form class="dashboard__parent__action__form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <textarea required type="text" name="usersContent" maxlength="1000" style="color:wheat"></textarea>
                <input type="submit" class="dashboard__parent__action--submit" name="submitContent" value="Submit">
            </form>
        </div>
    </div>

</body>

</html>