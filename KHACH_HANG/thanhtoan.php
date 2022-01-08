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
    include('connection.php');
    
    function confirm()
    {
        include('connection.php');
        if(!isset($_SESSION['mskh'])){
            echo("<script>location.href = './login.php?previouspage=thanhtoan.php';</script>");
            die();
        }
        //set timezone Viet Nam
        date_default_timezone_set('Asia/Ho_Chi_Minh');    
        $sql = "INSERT INTO DatHang (mskh,ngayDH,TrangThaiDH)
        VALUES ('" . $_SESSION['mskh'] . "','".date ('Y-m-d H:i:s')."','Chưa xác nhận')";
        if ($connection->query($sql) === TRUE) {
            $sql = "INSERT INTO ChiTietDatHang (mshh,soluong,giadathang,giamgia)
            VALUES ('" . $_GET['mshh'] . "',".$_GET['product_quantity'].",".$_GET['price']*$_GET['product_quantity'].",".$_GET['price']*0.1.")";
            if ($connection->query($sql) === TRUE) {
                $sql="  update hanghoa
                        set 
                        soluonghang = soluonghang - ".$_GET['product_quantity'].

                        " where mshh=".$_GET['mshh'];
                if ($connection->query($sql) === TRUE) {
                    $sql="  insert into diachikh(mskh,diachi)
                        values (".$_SESSION['mskh'].",'".$_GET['locate-ship']."')";
                    if ($connection->query($sql) === TRUE) {
                        echo("<script>alert('Thêm đơn hàng thành công');</script>");
                        echo "Thêm đơn hàng thành công";
                    }
                    else {
                    echo "Error: " . $sql . "<br>" . $connection->error;
                }
                }
            }
        }
        else {
                echo "Error: " . $sql . "<br>" . $connection->error;
        }
        echo("<script>location.href = './donhangcuatoi.php';</script>");
        die();
    };
    $query_product = mysqli_query($connection,"SELECT * FROM hanghoa where mshh=".$_GET['mshh']);
    $row_product = mysqli_fetch_array($query_product);
    if($_GET['product_quantity']>$row_product['SoLuongHang']){
        echo("<script> alert('Vượt quá số lượng shop có!\\n Vui lòng nhập lại dưới ".$row_product['SoLuongHang']." sản phẩm');</script>");
        echo("<script>location.href =  history.go(-1);</script>");
        die();
    }
    
    $locate_ship = $_GET['locate-ship'];
    $product_quantity = $_GET['product_quantity'];
    if (isset($_GET['confirm']))
        confirm();

    

    $sql = 'select * from hanghoa join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh where hanghoa.mshh=' . $_GET['mshh'];
    $query = $connection->query($sql);
    while ($row = $query->fetch_assoc()) {
        echo '
        
       
    <div class="grid payment-container">
        <div class="grid__row header-banner payment complete ">
            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
            <div>&nbsp;&nbsp;THANH TOÁN</div>
        </div>
        <div class="grid__row payment">
            <div class="payment__col-left">
                <img src="../assets/img/product_img/' . $row['TenHinh'] . '" alt="   " class="payment__product-img">
                <div class="payment__product-info">
                    <div class="payment__product-name">
                        ' . $row['TenHH'] . '
                    </div>
                    <div class="payment__product-price">
                    ' . $row['Gia'] . '.000đ
                    </div>
                </div>
            </div>
            <div class="payment__col-right">x' . $product_quantity . '</div>
        </div>

        <div class="grid__row payment ship">
            <div class="payment__col-left">
                <i class="fa fa-truck" aria-hidden="true"></i>
                Đơn vị vận chuyển
                <br>
                <span style="color: var(--primary-color);">Viettel Post</span>
                <br>
                <span style="font-weight: 500;">Giao hàng từ 3-4 ngày</span>
            </div>
            <div class="payment__col-right">
                <span style="color: var(--primary-color);">Địa chỉ:</span>
                <div class="payment__locate">
                    ' . $locate_ship . '
                </div>
            </div>
        </div>

        <div class="grid__row payment complete">
            <div class="payment__col-left">
                ' . $product_quantity . ' sản phẩm
            </div>
            <div class="payment__col-right">
                Thành tiền: <span style="color: var(--primary-color);">' . $row['Gia'] * $product_quantity . '.000đ</span>
            </div>
        </div>

        <div class="grid__row">
            <button class="btn btn--primary btn__confirm" onclick="window.location.href=\'thanhtoan.php?confirm=true&mshh='.$_GET['mshh']."&product_quantity=".$product_quantity."&locate-ship=".$locate_ship."&price=".$row['Gia'].'\'">Xác nhận</button>
        </div>
    </div>
    ';
    }
    ?>

    <?php
    include('footer.php');
    ?>
</body>

</html>