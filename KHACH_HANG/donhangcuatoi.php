<?php
//Khai báo sử dụng session
session_start();
include('connection.php');
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Reset CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/thanhtoan.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
    include('header.php');
     ?>
    <div class="grid">
        <div class="grid__row">
            <div class="my-oder__titile">
                ĐƠN HÀNG CỦA TÔI
            </div>
        </div>
        <?php 
            $sql = 'select * from chitietdathang join hanghoa on chitietdathang.mshh=hanghoa.mshh join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh join dathang on dathang.sodondh=chitietdathang.sodondh  where mskh='.$_SESSION['mskh'].' order by dathang.SoDonDH DESC';
            $query = $connection->query($sql);
            while ($row = $query->fetch_assoc()) {
                echo '
                
               
        <div class="grid__row payment My-payment">
            <div class="payment__col-left">
                <img src="../assets/img/product_img/'.$row['TenHinh'].'" alt="   " class="payment__product-img">
                <div class="payment__product-info" style="margin-top: -20px;">
                    <div class="payment__product-name">
                        '.$row['TenHH'].'
                    </div>
                    <div class="payment__product-price">
                        '.$row['Gia'].'.000đ
                    </div>
                    x'.$row['SoLuong'].'
                </div>
            </div>
            <div class="payment__col-right">
                Thành tiền: <span style="color: var(--primary-color);">'.$row['GiaDatHang'].'.000đ</span>
                <div class="payment__status">
                    Trạng thái: '.$row['TrangThaiDH'].'
                </div>
            </div>
        </div>
        ';
    
    }
?>
        
    </div>
</body>
</html>