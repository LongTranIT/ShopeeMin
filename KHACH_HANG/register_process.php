<?php

//Nhúng file kết nối với database
include('connection.php');
session_start();

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Lấy dữ liệu từ file dangky.php
$hotenkh   = addslashes($_POST['hotenkh']);
$password = addslashes($_POST['password']);
$password_again = addslashes($_POST['password_again']);

//Kiểm tra pass và xác nhận pass có trùng nhau ko
if (!($password === $password_again)) {
    echo "Password không trùng nhau, vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Mã khóa mật khẩu
$password = md5($password);


//Kiểm tra tên đăng nhập đã có người dùng chưa
if (mysqli_num_rows(mysqli_query($connection, "SELECT hotenkh FROM khachhang WHERE hotenkh='$hotenkh'")) > 0) {
    echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

//Lưu thông tin thành viên vào bảng
$query = "
    INSERT INTO khachhang (hotenkh, password) VALUE (
        '{$hotenkh}',
        '{$password}'
    )";
@$addmember = mysqli_query($connection, $query);

//Thông báo quá trình lưu
if ($addmember) {
    $username = $hotenkh;
    //Lưu tên đăng nhập
    $_SESSION['username'] = $username;
    $sql = 'select mskh from khachhang where hotenkh="' . $hotenkh.'"';
    $query = $connection->query($sql) or die($connection->error);
    while ($row = $query->fetch_assoc()) {
        $_SESSION['mskh'] = $row['mskh'];
    }
    header("Location: ./index.php?register=true");
} else
    echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='register.php'>Thử lại</a>";
