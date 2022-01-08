<?php session_start(); 
 
if (isset($_SESSION['usernameadmin'])){
    unset($_SESSION['usernameadmin']); // xóa session login
    unset($_SESSION['msnv']); // xóa session login
}
header('Location: ./login.php');
?>