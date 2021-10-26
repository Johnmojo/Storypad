<!--When user click log out, redirect to this page and finally to index.php-->
<?php

//Start session
session_start();

//Unset session
session_unset();

//Redirect to Index.php
header("Location: ../index.php");