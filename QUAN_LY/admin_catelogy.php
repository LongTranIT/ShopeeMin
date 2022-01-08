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
                                <li class="category-item category-item--active">
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
                    
                    <?php

                    //Chuyển sang form thêm mới khi bấm add new
                    if (isset($_GET['action'])&&$_GET['action'] === 'addform') {
                        echo '
                        <div class="grid__col-10 admin-right">
                        <form class="admin-item" method="get" action="admin_catelogy.php">    
                            <div class="admin-item__title">
                                Nhập tên loại danh mục:
                            </div>
                            <input type="text" class="admin-item__input" name="TenLoaiHang">
                            <button class="btn btn--primary admin__add-btn" >Add New</button>
                        </form>
                    </div>
                        ';
                    } 
                    //Thêm mới loai hàng
                    else if(!isset($_GET['MaLoaiHang'])&isset($_GET['TenLoaiHang'])){
                        $sql="insert into LoaiHangHoa(TenLoaiHang) values('".$_GET['TenLoaiHang']."')";
                        if ($connection->query($sql) === TRUE) {
                            echo '<script>alert("Add new success!")</script>';
                            echo("<script>location.href = './admin_catelogy.php';</script>");
                        }
                        else
                            echo "Error: " . $sql . "<br>" . $connection->error;
                    }

                    //Sửa tên loại hàng
                    else if(isset($_GET['MaLoaiHang'])&isset($_GET['TenLoaiHang'])){
                        $sql="
                        update loaihanghoa
                        set tenloaihang='".$_GET['TenLoaiHang']."'
                        where maloaihang=".$_GET['MaLoaiHang'];
                        if ($connection->query($sql) === TRUE) {
                            echo '<script>alert("Update success!")</script>';
                            echo("<script>location.href = './admin_catelogy.php';</script>");
                        }
                        else
                            echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                    //Thực hiện xóa loại hàng
                    else if(isset($_GET['idDelete'])){
                        $sql="delete from loaihanghoa where maloaihang=".$_GET['idDelete'];
                        if ($connection->query($sql) === TRUE) {
                            echo '<script>alert("Delete success!")</script>';
                            echo("<script>location.href = './admin_catelogy.php';</script>");
                        }
                        else
                            echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                    //chuyển sang form sửa
                    else if(isset($_GET['idUpdate'])){
                        echo '
                        <div class="grid__col-10 admin-right">
                        <form class="admin-item" method="get" action="admin_catelogy.php">    
                            <div class="admin-item__title">
                                Nhập tên loại danh mục:
                            </div>
                            <input type="text" class="admin-item__input" name="TenLoaiHang" value="'.$_GET['name'].'">
                            <input type="hidden" name="MaLoaiHang" value="'.$_GET['idUpdate'].'">
                            <button class="btn btn--primary admin__add-btn" >Update</button>
                        </form>
                    </div>
                        ';
                    }
                    else
                    {
                        echo '<div class="grid__col-10 admin-right">
                        <button class="btn btn--primary admin__add-btn" onclick="window.location.href=\'admin_catelogy.php?action=addform\'">Add New</button>
                        <table border="1" >
                            <tr>
                                <th>Mã</th>
                                <th>Loại Sản Phẩm</th>
                                <th>Chức Năng</th>
                            </tr>
                        <!-- Hiển thị từng phần tử -->';
                        $sql = 'select * from loaihanghoa';
                        $query = $connection->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            echo '
                            <tr>
                                <td>
                                    <div class="admin-item__ma">
                                    ' . $row['MaLoaiHang'] . '
                                    </div>
                                </td>
                                <td>
                                    ' . $row['TenLoaiHang'] . '
                                </td>
                            
                                <td>
                                    <div class="admin-item__btn">
                                        <button class="btn btn-delete"onclick="window.location.href=\'admin_catelogy.php?idDelete='.$row['MaLoaiHang'].'\'">Delete</button>
                                        <button class="btn btn-update"onclick="window.location.href=\'admin_catelogy.php?idUpdate='.$row['MaLoaiHang'].'&name='.$row['TenLoaiHang'].'\'">Update</button>
                                    </div>
                                </td>
                            </tr>
                            
                        ';
                        }
                    }
                    ?>
</table>
                </div>

            </div>
        </div>

    </div>
    <?php
    include('footer.php');
    ?>
</body>

</html>