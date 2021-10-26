<!--Font Awesome icon kit-->
<script src="https://kit.fontawesome.com/29e756bbd4.js" crossorigin="anonymous"></script>
<!--Script to prevent PHP reload - resubmission -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php
//Credential for database
$servername = 'localhost';
$username = 'admin';
$password = 'admin';
$dbname = "quicknotedb";
$charset = 'utf8mb4';

//Connect to database
$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";
$pdo = new PDO($dsn, $username, $password);
