<?php

session_start();
//Destroy all session and logout.
session_destroy();
header("location:login.php");

?>