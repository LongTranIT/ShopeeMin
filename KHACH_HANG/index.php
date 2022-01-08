<?php
//Khai báo sử dụng session
session_start();
include('connection.php');
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
if(isset($_GET['register'])){
    echo '<script>alert("Tạo tài khoản thành công!")</script>';
}
else if(isset($_GET['logout'])){
    echo '<script>alert("Đăng xuất thành công!\nHẹn gặp lại!")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee</title>
    <!-- Reset CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="main">
        <?php
            include('header.php');
        ?>

        <div class="container">
            <div class="grid">
                <div class="grid__row app__content">
                    <div class="grid__col-2">
                        <nav class="category">
                            <h3 class="category__heading">
                                <i class="fa fa-list" aria-hidden="true"></i>
                                Danh Mục 
                            </h3>
                            <ul class="category-list">
                    <?php
                            if(!isset($_GET['catid'])){
                                $classList='category-item category-item--active';
                            }
                            else
                                $classList='category-item';
                                echo '
                                <li class="'.$classList.'">
                                    <a href="index.php" class="category-item__link">Tất cả</a>
                                </li>
                                
                                ';

                            $sql='select * from loaihanghoa';
                            $query=$connection->query($sql);
                            while($row=$query->fetch_assoc()){
                                if(isset($_GET['catid'])&&$_GET['catid']===$row['MaLoaiHang']){
                                    $classList='category-item category-item--active';
                                }
                                else
                                    $classList='category-item';
                                echo '
                                <li class="'.$classList.'">
                                    <a href="index.php?catid='.$row['MaLoaiHang'].'" class="category-item__link">'.$row['TenLoaiHang'].'</a>
                                </li>
                                
                                ';
                            }
                    ?>
                            </ul>
                        </nav>
                    </div>

                    <div class="grid__col-10">
                        <div class="home-filter">
                            <span class="home-filter__label">Sắp xếp theo</span>
                            <button class="home-filter-btn btn"onclick="location.href = './index.php';">Phổ biến</button>
                            <button class="home-filter-btn btn btn--primary"onclick="location.href = './index.php';">Mới nhất</button>
                            <button class="home-filter-btn btn"onclick="location.href = './index.php';">Bán chạy</button>

                            <select name="filter-price" id="" label='Giá' class='select-input'>
                                <option value="" hidden>Giá</option>
                                <option value="ASC">Giá: Thấp đến cao</option>
                                <option value="DESC">Giá: Cao đến thấp</option>
                            </select>

                            <div class="home-filter__page">
                                <span class="home-filter__page-num">
                                    <span class="home-filter__page-num--current">1</span>/1
                                </span>

                                <div class="home-filter__page-control">
                                    <a href="" class="home-filter__page-btn btn--disable">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    </a>
                                    <a href="" class="home-filter__page-btn">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Display product  -->
                        <div class="home-product">
                            <div class="grid__row">
                                <!-- Product item -->
                                
                                <?php 
                                    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
                                        $sql='select * from hanghoa join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh';
                                     }
                                     else{
                                        $sql='select * from hanghoa join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh where MaLoaiHang='.$_GET['catid'];
                                     }
                                    if(isset($_GET['search__text'])&&$_GET['search__text']!=='')
                                        $sql='select * from hanghoa join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh where tenhh like "%'.$_GET['search__text'].'%"';
                                    $query=$connection->query($sql);
                                    while($row=$query->fetch_assoc()){
                                        echo '
                                        
                                        
                                        
                                <!-- Product item -->
                                <div class="grid__col-2-4">
                                    <a class="home-product-item" href="product.php?mshh='.$row['MSHH'].'">
                                        <div class="home-product-item__img"
                                            style="background-image: url(../assets/img/product_img/'.$row['TenHinh'].');background-size: contain;">
                                        </div>
                                        <h4 class="home-product-item__name">'.$row['TenHH'].'</h4>
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price--old">'.((float)$row['Gia']*1.1).'.000đ</span>
                                            <span class="home-product-item__price--current">'.$row['Gia'].'.000đ</span>
                                        </div>

                                        <div class="home-product-item__action">
                                            <span class="home-product-item__like">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                            </span>
                                            <div class="home-product-item-ranting">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                        </div>

                                        <div class="home-product-item__origin">
                                            <div class="home-product-item__brand">Whoo</div>
                                            <span class="home-product-item__origin-name">TP HCM</span>
                                        </div>

                                        <div class="home-product-item__favourite">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            Yêu thích
                                        </div>

                                        <div class="home-product-item__sale-off">
                                            <span class="home-product-item__sale-off-percent">10%</span>
                                            <span class="home-product-item__sale-off-label">GIẢM</span>
                                        </div>
                                    </a>
                                </div>

                                ';
                                    }
                                ?>
                               
                            </div>
                        </div>

                        <!-- Pagination  -->
                        <ul class="pagination home-product__pagination">
                            <li class="pagination-item ">
                                <a href="" class="pagination-item__link">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                            </li>
                            <li class="pagination-item pagination-item--active">
                                <a href="" class="pagination-item__link">1</a>
                            </li>
                            <!-- <li class="pagination-item">
                                <a href="" class="pagination-item__link">2</a>
                            </li>
                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">3</a>
                            </li>
                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">4</a>
                            </li>
                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">5</a>
                            </li>
                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">...</a>
                            </li> -->
                            <li class="pagination-item">
                                <a href="" class="pagination-item__link">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php
        include('footer.php');
        if(isset($_GET['search__text'])&&$_GET['search__text']!=='')
          echo '
            <script>
                document.querySelector("#search-input").value="'.$_GET['search__text'].'";
            </script>
          ';
    ?>
    

</body>

</html>