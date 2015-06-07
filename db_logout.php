<?php
session_start();
session_unset();
session_destroy();
header("location: db_login.php");
?>
