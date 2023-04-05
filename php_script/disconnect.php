<?php
$_SESSION = [];
session_unset();
session_abort();
$_COOKIE = [];
header('Location:../index.php'); 
?>