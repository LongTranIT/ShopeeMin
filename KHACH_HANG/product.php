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
    <link rel="stylesheet" href="../assets/css/sanpham.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    include('header.php');

    include('connection.php');
    
    ?>
    <form action="thanhtoan.php" class="grid product" method="GET">;
        <div class="grid__row">


            <?php
            $sql = 'select * from hanghoa join hinhhanghoa on hanghoa.mshh=hinhhanghoa.mshh where hanghoa.mshh=' . $_GET['mshh'];
            $query = $connection->query($sql);
            while ($row = $query->fetch_assoc()) {
                echo '
            <div class="grid__col-1-3 product__img">
                <img src="../assets/img/product_img/' . $row['TenHinh'] . '" alt="">
            </div>
            <div class="grid__col-2-3 product__info">
                <div class="product__info-name">' . $row['TenHH'] . '</div>
                <div class="product__info-header">
                    <div class="product__info-ratings">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    </div>
                    <div class="product__info-n-rating"> 1 Đánh Giá</div>
                    <div class="product__info-n-sold"> 1 Đã Bán</div>
                </div>
                <div class="product__info-price">₫' . $row['Gia'] . '.000</div>
                <div class="product__info-ship">
                    <i class="fa fa-truck" aria-hidden="true"></i>
                    Vận chuyển tới:
                    <input type="text" name="locate-ship" class="locate-ship" value="Ninh Kiều, Cần Thơ">
                </div>
                <div class="product__info-desc">
                    ' . str_replace("\n","<br />",$row['QuyCach']) . '
                </div>
                <div class="product__info-quantity">
                    <div class="product__info-quatity-text">
                        Số lượng
                    </div>
                    <button type="button" class="product__quantity-left">-</button>
                    <input type="text" name="product_quantity" value="1" aria-valuenow="1" id="product__quantity">
                    <button type="button" class="product__quantity-right">+</button>
                    <div class="product__quantity-available">
                        ' . $row['SoLuongHang'] . ' sản phẩm có sẵn
                    </div>

                    <input type="hidden" name="mshh" value="'.$_GET['mshh'].'">
                </div>';
                if ($row['SoLuongHang'] > 0) {
                    echo '
                    <button class="btn btn--pretty btn--size-l" type="button" onclick="goCart(\'giohang.php?mshh='.$_GET['mshh'].'&action=add&product_quantity=\')">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        Thêm vào giỏ hàng
                    </button>
                    <button class="btn btn--primary btn--size-l">
                        Mua Ngay
                    </button>
                    ';
                }
                else
                echo '
                    <button class="btn btn--pretty btn--size-l btn--disable" type="button">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        Thêm vào giỏ hàng
                    </button>
                    <button class="btn btn--primary btn--size-l  btn--disable">
                        Mua Ngay
                    </button>
                    <span style="color:red; font-size:1.4rem;">Sản phẩm tạm thời hết hàng</span>
                ';
                echo '
            </div>

            ';
            }
            ?>
        </div>
    </form>
    <?php
    include('footer.php');
    ?>
    <script>
        btn_decrease = document.querySelector('.product__quantity-left');
        btn_increase = document.querySelector('.product__quantity-right');
        product_quantity = document.querySelector('#product__quantity');

        btn_decrease.addEventListener('click', function() {
            if (parseInt(product_quantity.value) <= 1) return;
            product_quantity.value = parseInt(product_quantity.value) - 1;
        });
        btn_increase.addEventListener('click', function() {
            product_quantity.value = parseInt(product_quantity.value) + 1;
        });

        function goCart(url){
            window.location.href=url+document.querySelector('#product__quantity').value;
        }
    </script>
</body>

</html>