<?php
//Khai báo sử dụng session
session_start();
include('connection.php');
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
include('header.php');
if(isset($_POST['HoTenKH'])){
    $sql='update khachhang set
    hotenkh="'.$_POST['HoTenKH'].'",
    tencongty="'.$_POST['TenCongTy'].'",
    sodienthoai="'.$_POST['SoDienThoai'].'",
    sofax="'.$_POST['SoFax'].'"
    where mskh='.$_SESSION['mskh'];
    if ($connection->query($sql) === TRUE) {
        echo '<script>alert("update success!")</script>';
    }
    else
        echo "Error: " . $sql . "<br>" . $connection->error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <form class="grid" action='profile.php' method="post">
        <div class="my-profile__title">
            THÔNG TIN CÁ NHÂN
        </div>
        <?php
        $sql = 'select * from khachhang where mskh=' . $_SESSION['mskh'];
        $query = $connection->query($sql);
        while ($row = $query->fetch_assoc()) {
            echo '

            
        <img src="../assets/img/avatar.jpg" alt="" class="profile-img">
        <div class="username">' . $_SESSION['username'] . '</div>
        <div class="grid__row">

            <div class="profile-item">
                <span class="profile-item__text">MSKH: </span>
                <input type="text" name="MSKH" value="' . $row['MSKH'] . '" disabled>
            </div>
            <div class="profile-item">
                <span class="profile-item__text">Họ Tên Khách Hàng: </span>
                <input type="text" name="HoTenKH" placeholder="Nhập họ tên" value="' . $row['HoTenKH'] . '">
            </div>
            <div class="profile-item">
                <span class="profile-item__text">Tên Công Ty: </span>
                <input type="text" name="TenCongTy" placeholder="Nhập tên công ty" value="' . $row['TenCongTy'] . '">
            </div>
            <div class="profile-item">
                <span class="profile-item__text">Số Điện Thoại: </span>
                <input type="text" name="SoDienThoai" placeholder="Nhập số điện thoại" value="' . $row['SoDienThoai'] . '">
            </div>
            <div class="profile-item">
                <span class="profile-item__text">Số Fax: </span>
                <input type="text" name="SoFax" value="' . $row['SoFax'] . '" >
            </div>
            ';
        }
        ?> <button class="btn btn--primary profile__update-btn">Cập nhật</button>
        </button>
    </form>

    <?php
    include('footer.php');
    ?>
</body>

</html>