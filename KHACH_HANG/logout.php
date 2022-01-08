<?php session_start(); 
 
if (isset($_SESSION['username'])){
    unset($_SESSION['username']); // xóa session login
    unset($_SESSION['mskh']); // xóa session login
    unset($_SESSION['cart']); // xóa session giỏ hàng
}
header('Location: ./index.php?logout=true');
?>