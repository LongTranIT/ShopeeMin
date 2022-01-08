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
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
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
                                Quản lý
                            </h3>
                            <ul class="category-list">
                                <li class="category-item">
                                    <a href="admin_catelogy.php" class="category-item__link">Quản Lý Loại Hàng Hóa</a>
                                </li>
                                <li class="category-item">
                                    <a href="admin_product.php" class="category-item__link">Quản Lý Sản Phẩm</a>
                                </li>
                                <li class="category-item">
                                    <a href="admin_order.php" class="category-item__link">Quản Lý Đơn hàng</a>
                                </li>
                                <li class="category-item">
                                    <a href="admin_user.php" class="category-item__link">Quản Lý Thông Tin Khách Hàng</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="grid__col-10 admin-right">
                        <img src="../assets/img/shopee_admin.jpg" alt=""
                        style="width:100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
                   
</body>

</html>