<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['usertype']);
unset($_SESSION['user_id']);
session_destroy();
header('Location:index.php');
?>