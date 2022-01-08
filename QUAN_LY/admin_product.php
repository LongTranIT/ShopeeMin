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
                                <li class="category-item category-item--active">
                                    <a href="admin_product.php" class="category-item__link">Quản Lý Sản Phẩm</a>
                                </li>
                                <li class="category-item ">
                                    <a href="admin_order.php" class="category-item__link">Quản Lý Đơn hàng</a>
                                </li>
                                <li class="category-item ">
                                    <a href="admin_user.php" class="category-item__link">Quản Lý Thông Tin Khách
                                        Hàng</a>
                                </li>
                            </ul>
                        </nav>
                    </div>


                    <?php
                    //Chuyển sang form thêm mới khi bấm add new
                    if (isset($_GET['action']) && $_GET['action'] === 'addform') {
                        echo '
                        <!-- Form nhap thông tin  -->
                        <form class="grid__col-10 admin-right" method="get" action="admin_product.php">
                                    <button class="btn btn--primary admin__add-btn">Add New</button>
        
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Chọn loại sản phẩm:
                                        </div>
                                        <select name="MaLoaiHang" id="" class="combo-box admin-item__input">';
                        $sql = 'select * from loaihanghoa';
                        $query = $connection->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            echo '
                            <option value="' . $row['MaLoaiHang'] . '">' . $row['TenLoaiHang'] . '</option>';
                        }
                        echo '  </select>
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Nhập tên hàng hóa:
                                        </div>
                                        <input type="text" class="admin-item__input" name="TenHH">
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__product">
                                            <img id="product_img" src="../assets/img/product_img/no_product.png" alt=""
                                                class="admin-item__img product-img">
                                            <input name="image" accept="image/*" type=\'file\' id="imgInp"  onchange="document.getElementById(\'product_img\').src = window.URL.createObjectURL(this.files[0]); ">
                                        
                                            <div class="admin-item__note">
                                                Lưu ý: Chọn ảnh sản phẩm nằm trong thư mục shopee/assets/img/product_img/
                                            </div>
                                        </div>
        
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Nhập quy cách:
                                        </div>
                                        <textarea name="QuyCach" rows="10" cols="60" class="admin-item__input admin-item__text-area"></textarea>
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Nhập giá hàng hóa:
                                        </div>
                                        <input type="text" class="admin-item__input" name="Gia">
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Nhập số lượng hàng hóa:
                                        </div>
                                        <input type="number" class="admin-item__input" name="SoLuongHang">
                                    </div>
                                
                                </form>
                        ';
                    }

                    //chuyển sang form sửa
                    else if(isset($_GET['action']) && $_GET['action'] === 'updateform'){
                        $query_product = mysqli_query($connection,"SELECT * FROM hanghoa join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh join loaihanghoa on hanghoa.maloaihang=loaihanghoa.maloaihang WHERE hanghoa.mshh='".$_GET['idUpdate']."'");
                        $row_product = mysqli_fetch_array($query_product);
                        echo '
                        <!-- Form nhap thông tin  -->
                        <form class="grid__col-10 admin-right" method="get" action="admin_product.php">
                                    <button type="submit" class="btn btn--primary admin__add-btn">Update</button>
                                    <input type="hidden" name="MSHH" value="'.$_GET['idUpdate'].'" >
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Chọn loại sản phẩm:
                                        </div>
                                        <select name="MaLoaiHang" id="" class="combo-box admin-item__input">
                                            <option value="' . $row_product['MaLoaiHang'] . '" hidden>' . $row_product['TenLoaiHang'] . '</option>
                                        ';
                                            
                        $sql = 'select * from loaihanghoa';
                        $query = $connection->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            echo '
                            <option value="' . $row['MaLoaiHang'] . '">' . $row['TenLoaiHang'] . '</option>';
                        }
                        echo '  </select>
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Nhập tên hàng hóa:
                                        </div>
                                        <input type="text" class="admin-item__input" name="TenHH" value="'.$row_product['TenHH'].'">
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__product">
                                            <img id="product_img" src="../assets/img/product_img/'.$row_product['TenHinh'].'" alt="Ảnh sản phẩm"
                                                class="admin-item__img product-img">
                                            <input type="hidden" name="image_default" value="'.$row_product['TenHinh'].'">
                                            <input name="image" accept="image/*" type=\'file\' id="imgInp"  onchange="document.getElementById(\'product_img\').src = window.URL.createObjectURL(this.files[0]); ">
                                        
                                            <div class="admin-item__note">
                                                Lưu ý: Chọn ảnh sản phẩm nằm trong thư mục shopee/assets/img/product_img/
                                            </div>
                                        </div>
        
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Nhập quy cách:
                                        </div>
                                        <textarea name="QuyCach" rows="10" cols="60" class="admin-item__input admin-item__text-area" >'.$row_product['QuyCach'].'</textarea>
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Nhập giá hàng hóa:
                                        </div>
                                        <input type="text" class="admin-item__input" name="Gia" value="'.$row_product['Gia'].'">
                                    </div>
                                    <div class="admin-item">
                                        <div class="admin-item__title">
                                            Nhập số lượng hàng hóa:
                                        </div>
                                        <input type="number" class="admin-item__input" name="SoLuongHang" value="'.$row_product['SoLuongHang'].'">
                                    </div>
                                   
                                </form>
                        ';
                    }

                    //Thêm mới hang hoa
                    else if (!isset($_GET['MSHH']) & isset($_GET['TenHH'])) {
                        $sql = "insert into HangHoa(TenHH,quycach,gia,soluonghang,maloaihang) values(
                            '" . $_GET['TenHH'] . "',
                            '" . $_GET['QuyCach'] . "',
                            " . $_GET['Gia'] . ",
                            '" . $_GET['SoLuongHang'] . "',
                            '" . $_GET['MaLoaiHang'] . "'
                            )";
                        if ($connection->query($sql) === TRUE) {
                            $query_product = mysqli_query($connection,"SELECT * FROM hanghoa where tenhh='".$_GET['TenHH']."'");
                            $row_product = mysqli_fetch_array($query_product);
                            $sql = "insert into HinhHangHoa(tenhinh,mshh) values(
                                '" . $_GET['image'] . "',
                                '" . $row_product['MSHH'] . "'
                                )";
                            if($connection->query($sql) === TRUE){
                                echo '<script>alert("Add new success!")</script>';
                                echo ("<script>location.href = './admin_product.php';</script>");
                            }
                            else
                                echo "Error: " . $sql . "<br>" . $connection->error;
                        } 
                    }
                    //Sửa hàng hoa
                    else if(isset($_GET['MSHH'])&isset($_GET['TenHH'])){
                        if($_GET['image']===''){
                            $image=$_GET['image_default'];
                        }
                        else{
                             $image=$_GET['image'];
                        }            
                        $sql="
                        update hanghoa
                        set tenhh='".$_GET['TenHH']."',
                        quycach='".$_GET['QuyCach']."',
                        gia=".$_GET['Gia'].",
                        soluonghang='".$_GET['SoLuongHang']."',
                        maloaihang='".$_GET['MaLoaiHang']."'

                        where mshh=".$_GET['MSHH'];
                        if ($connection->query($sql) === TRUE) {
                            $sql="
                            update hinhhanghoa
                            set tenhinh='".$_GET['image']."'
                            where mshh=".$_GET['MSHH'];
                            if ($connection->query($sql) === TRUE){
                                echo '<script>alert("Update success!")</script>';
                                echo("<script>location.href = './admin_product.php';</script>");
                            }
                            else
                            echo "Error: " . $sql . "<br>" . $connection->error;
                        }
                        else
                            echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                    //Thực hiện xóa san pham
                    else if (isset($_GET['idDelete'])) {
                        $sql = "delete from hanghoa where mshh=" . $_GET['idDelete'];
                        if ($connection->query($sql) === TRUE) {
                            echo '<script>alert("Delete success!")</script>';
                            echo ("<script>location.href = './admin_product.php';</script>");
                        } else
                            echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                    //Hien bang san pham
                    else {

                        echo '
                    <!-- Hiển thị danh sách sản phẩm -->

                    <div class="grid__col-10 admin-right">

                    <button class="btn btn--primary admin__add-btn" onclick="window.location.href=\'admin_product.php?action=addform\'">Add New</button>



                        <table border="1">
                            <tr>
                                <th>Mã</th>
                                <th>Loại Sản Phẩm</th>
                                <th>Thông Tin</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Chức Năng</th>
                            </tr>
                    ';
                        $sql = 'select * from hanghoa join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh join loaihanghoa on hanghoa.maloaihang=loaihanghoa.maloaihang';
                        $query = $connection->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            echo '
                        <tr>
                            <td>
                                <div class="admin-item__ma">
                                ' . $row['MSHH'] . '
                                </div>
                            </td>
                            <td>
                                <div class="admin-item__tenloaiHang">
                                ' . $row['TenLoaiHang'] . '
                                </div>
                            </td>
                            <td>
                                <div class="admin-item__product">
                                    <img src="../assets/img/product_img/' . $row['TenHinh'] . '" alt="" class="admin-item__img">
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
                                    x' . $row['SoLuongHang'] . '
                                </div>
                            </td>

                            <td>
                                <div class="admin-item__btn" style="display: flex;justify-content: space-around;">
                                <button class="btn btn-delete"onclick="window.location.href=\'admin_product.php?idDelete=' . $row['MSHH'] . '\'">Delete</button>
                                <button class="btn btn-update"onclick="window.location.href=\'admin_product.php?action=updateform&idUpdate=' . $row['MSHH'] . '\'">Update</button>
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
    include 'footer.php';
    ?>

</body>

</html>