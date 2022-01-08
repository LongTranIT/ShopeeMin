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
        include 'header.php';
        if (isset($_GET['idOrder'])) {
            $sql = "
            update dathang
            set trangthaidh='" . $_GET['product-status'] . "'
            where sodondh=" . $_GET['idOrder'];
            if ($connection->query($sql) === TRUE) {
                $sql = "
                update dathang
                set msnv='" . $_SESSION['msnv'] . "'
                where sodondh=" . $_GET['idOrder'];
                if ($connection->query($sql) === TRUE) {
                    echo '<script>alert("Update success!")</script>';
                    echo ("<script>location.href = './admin_order.php';</script>");
                }
            } else
                echo "Error: " . $sql . "<br>" . $connection->error;
        }

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
                                <li class="category-item ">
                                    <a href="admin_catelogy.php" class="category-item__link">Quản Lý Loại Hàng Hóa</a>
                                </li>
                                <li class="category-item ">
                                    <a href="admin_product.php" class="category-item__link">Quản Lý Sản Phẩm</a>
                                </li>
                                <li class="category-item category-item--active">
                                    <a href="admin_order.php" class="category-item__link">Quản Lý Đơn hàng</a>
                                </li>
                                <li class="category-item ">
                                    <a href="admin_user.php" class="category-item__link">Quản Lý Thông Tin Khách Hàng</a>
                                </li>
                            </ul>
                        </nav>
                    </div>


                    <!-- Hiển thị danh sách sản phẩm -->

                    <div class="grid__col-10 admin-right">
                        <table border="1">
                            <tr>
                                <th>Mã</th>
                                <th>Khách Hàng</th>
                                <th>Thông Tin Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                                <th>Trạng Thái Đơn Hàng</th>
                                <th>Chức Năng</th>
                            </tr>
                            <?php
                            $sql = 'select * from chitietdathang join dathang on chitietdathang.sodondh=dathang.sodondh
                                join khachhang on khachhang.mskh=dathang.mskh
                                join hanghoa on hanghoa.mshh=chitietdathang.mshh
                                join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh
                                order by dathang.sodondh desc';
                            $query = $connection->query($sql);
                            while ($row = $query->fetch_assoc()) {
                                echo '

                        
                            <form class="admin-item" action="admin_order.php" method="get">
                            <tr>
                                <td>
                                <div class="admin-item__ma admin_item__sohoadon">
                                ' . $row['SoDonDH'] . '
                                <input type="hidden" name="idOrder" value="' . $row['SoDonDH'] . '">
                            </div>
                                </td>
                                <td>
                                ';

                                if ($row['HoTenKH'] !== '')
                                    echo '
                                <div class="admin-item__user-name">
                                ' . $row['HoTenKH'] . '
                                </div>';
                                else
                                    echo '
                                <div class="admin-item__user-name">
                                ' . $row['SoDienThoai'] . '
                                </div>';
                                echo '
                                </td>
                                <td>
                                <div class="admin-item__product">
                                <img src="../assets/img/product_img/'.$row['TenHinh'].'" alt="" class="admin-item__img">
                                <div class="admin-item__tenloaiHang">
                                ' . $row['TenHH'] . '
                                </div>
                            </div>
                                </td>
                                <td>
                                <div class="product__price">
                                ' . $row['Gia'] . '.000đ
                                </div>
                                </td>
                                <td>
                                    <div class="product__quanity">
                                        x'.$row['SoLuong'].'
                                    </div>
                                </td>
                                <td>
                                     <span class="admin-item__payment-price">' . $row['GiaDatHang'] . '.000đ</span>
                                </td>
                                <td>
                                <select name="product-status" id="" class="combo-box">';
                                if ($row['TrangThaiDH'] === "Chưa xác nhận")
                                    echo '
                                        <option value="Chưa xác nhận"selected>Chưa xác nhận</option>
                                        <option value="Đã xác nhận">Đã xác nhận</option>
                                        <option value="Đã giao hàng">Đã giao hàng</option>
                                    </select>';
                                else if ($row['TrangThaiDH'] === "Đã xác nhận")
                                    echo '
                                        <option value="Chưa xác nhận">Chưa xác nhận</option>
                                        <option value="Đã xác nhận"selected>Đã xác nhận</option>
                                        <option value="Đã giao hàng">Đã giao hàng</option>
                                    </select>';
                                elseif ($row['TrangThaiDH'] === "Đã giao hàng")
                                    echo '
                                        <option value="Chưa xác nhận">Chưa xác nhận</option>
                                        <option value="Đã xác nhận">Đã xác nhận</option>
                                        <option value="Đã giao hàng"selected>Đã giao hàng</option>
                                    </select>';
                                echo '
                                </td>
                                <td>
                                    <button class="btn btn--primary admin__update-btn">Update</button>
                                </td>
                            </tr>
                            </form>
                        
                        ';
                            }
                            ?>
                            </table>
                    </div>


                </div>
            </div>


        </div>
        <?php
        include 'footer.php';
        ?>
</body>

</html>