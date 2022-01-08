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

    if (!isset($_SESSION['mskh'])) {
        echo ("<script>location.href = './login.php?previouspage=giohang.php';</script>");
        die();
    }
    if (isset($_GET['action']) && $_GET['action'] == "confirm")
        confirm();

    if (isset($_GET['action']) && $_GET['action'] == "delete") {
        unset($_SESSION['cart'][$_GET['mshh']]);
        echo ("<script> alert('Đã xóa thành công');</script>");
        echo ("<script>location.href = './giohang.php';</script>");
        die();
    }

    if (isset($_GET['action']) && $_GET['action'] == "add") {
        //Kiểm tra số lương mua có vượt quá số lượng hàng đang có ko
        $query_product = mysqli_query($connection, "SELECT * FROM hanghoa where mshh=" . $_GET['mshh']);
        $row_product = mysqli_fetch_array($query_product);
        if (
            $_GET['product_quantity'] > $row_product['SoLuongHang'] ||
            (isset($_SESSION['cart'][$_GET['mshh']]) && $_SESSION['cart'][$_GET['mshh']]['quantity'] + $_GET['product_quantity'] > $row_product['SoLuongHang'])
        ) {
            echo ("<script> alert('Vượt quá số lượng shop có!\\n->Vui lòng nhập lại dưới " . $row_product['SoLuongHang'] . " sản phẩm\\n->Hoặc vào giỏ hàng xóa bớt');</script>");
            echo ("<script>location.href =  history.go(-1);</script>");
            die();
        }
        $mshh = intval($_GET['mshh']);
        if (isset($_SESSION['cart'][$mshh])) {
            $_SESSION['cart'][$mshh]['quantity'] += $_GET['product_quantity'];
        } else {
            $_SESSION['cart'][$mshh] = array("quantity" => $_GET['product_quantity']);
            echo ("<script>location.href = './giohang.php';</script>");
            die();
        }
    }

    function confirm()
    {
        include('connection.php');
        //set timezone Viet Nam
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        foreach ($_SESSION['cart'] as $mshh => $value) {
            $quantity = $_SESSION['cart'][$mshh]['quantity'];
            $sql = "INSERT INTO DatHang (mskh,ngayDH,TrangThaiDH)
                VALUES ('" . $_SESSION['mskh'] . "','" . date('Y-m-d H:i:s', time()) . "','Chưa xác nhận')";

            if ($connection->query($sql) === TRUE) {
                $query_product = mysqli_query($connection, "SELECT * FROM hanghoa where mshh=" . $mshh);
                $row_product = mysqli_fetch_array($query_product);
                $sql = "INSERT INTO ChiTietDatHang (mshh,soluong,giadathang,giamgia)
            VALUES ('" . $mshh . "'," .  $quantity . "," . $quantity * $row_product['Gia'] . "," . $quantity * $row_product['Gia'] * 0.1 . ")";
                if ($connection->query($sql) === TRUE) {
                    $sql = " update hanghoa
                        set 
                        soluonghang = soluonghang - " .  $quantity .
                        " where mshh=" . $mshh;
                    if ($connection->query($sql) === TRUE) {
                        $sql = "  insert into diachikh(mskh,diachi)
                        values (" . $_SESSION['mskh'] . ",'" . $_GET['locate-ship'] . "')";
                        if ($connection->query($sql) === TRUE) {
                            echo "Thêm đơn hàng thành công";
                        } else {
                            echo "Error: " . $sql . "<br>" . $connection->error;
                        }
                    }
                }
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        }
        unset($_SESSION['cart']);
        echo ("<script>alert('Thêm đơn hàng thành công');</script>");
        echo ("<script>location.href = './donhangcuatoi.php';</script>");
        die();
    };
    ?>
    <div class="grid payment-container">
        <div class="grid__row header-banner payment complete ">
            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
            <div>&nbsp;&nbsp;GIỎ HÀNG</div>
        </div>
        <?php
        if(!isset($_SESSION['cart'])){
            echo '
                <div class="grid__row payment complete ">
                    <h1>&nbsp;&nbsp;Giỏ Hàng Trống</h1>
                </div>';
            include 'footer.php';
            die();
        }
        $sql = 'select * from hanghoa join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh where hanghoa.mshh IN (';
        foreach ($_SESSION['cart'] as $mshh => $value) {
            $sql .= $mshh . ",";
        }
        $sql = substr($sql, 0, -1) . ")";
        $query = $connection->query($sql);
        $totalPrice = 0;
        $totalQuantity = 0;
        if ($query===false) {
            echo '
                <div class="grid__row payment complete ">
                    <h1>&nbsp;&nbsp;Giỏ Hàng Trống</h1>
                </div>';
            include 'footer.php';
            die();
        }
        while ($row = $query->fetch_assoc()) {
            $subtotal = $_SESSION['cart'][$row['MSHH']]['quantity'] * $row['Gia'];
            $totalPrice += $subtotal;
            $totalQuantity += $_SESSION['cart'][$row['MSHH']]['quantity'];
            echo '
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
            <div class="payment__col-right">x'
                . $_SESSION['cart'][$row['MSHH']]['quantity'] .
                '   <br><br>Thành tiền: <span style="color: var(--primary-color);">' . $subtotal . '.000đ</span>
            </div>
            <div class="btn btn--primary" onclick="window.location.href=\'giohang.php?action=delete&mshh=' . $row['MSHH'] . '\'">Xóa</div>
        </div>

    ';
        }
        ?>
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
                <input class="payment__locate" value="Ninh Kiều, Cần Thơ" id=locate_ship>
                </input>
            </div>
        </div>

        <div class="grid__row payment complete">
            <div class="payment__col-left">
                <?php echo $totalQuantity ?> sản phẩm
            </div>
            <div class="payment__col-right">
                Tổng Thành Tiền: <span style="color: var(--primary-color);"> <?php echo $totalPrice ?>.000đ</span>
            </div>
        </div>

        <div class="grid__row">
            <?php echo '
            <button class="btn btn--primary btn__confirm" onclick="muaHang(\'giohang.php?action=confirm&locate-ship=\')">Xác nhận mua</button>
            ' ?>
        </div>
    </div>
    <?php
    include('footer.php');
    ?>
    <script>
        function muaHang(url) {
            window.location.href = url + document.querySelector('#locate_ship').value;
        }
    </script>
</body>

</html>