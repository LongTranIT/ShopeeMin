<?php
    $username='root';
    $password='';
    $host='localhost';
    $database='quanlydathang';
    $connection=mysqli_connect($host,$username,$password,$database)or die ('Lỗi kết nối'); 
    mysqli_set_charset($connection, 'UTF8');
?>