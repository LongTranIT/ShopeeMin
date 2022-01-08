<?php
//Khai báo sử dụng session
session_start();
 
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');



//Xử lý đăng nhập
if (isset($_POST['login'])) 
{
    //Kết nối tới database
    include('connection.php');

     
    //Lấy dữ liệu nhập vào
    $hotennv = addslashes($_POST['hotennv']);
    $password = addslashes($_POST['password']);
     
    // mã hóa pasword
    // $password = md5($password);
     
    //Kiểm tra tên đăng nhập có tồn tại không
    $query = mysqli_query($connection,"SELECT msnv, password FROM nhanvien WHERE hotennv='$hotennv'");
    if (mysqli_num_rows($query) == 0) {
        echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
     
    //Lấy mật khẩu trong database ra
    $row = mysqli_fetch_array($query);
     
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['password']) {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    
    $username=$hotennv;
    //Lưu tên đăng nhập
    $_SESSION['usernameadmin'] = $username;
    $_SESSION['msnv']=$row['msnv'];
    echo'<script>window.location="./index.php"</script>';

    die();
}
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
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Modal playout -->
    <div class="main">
        <header class="auth-header">
            <div class="auth-header__left">
                <a href="./index.php" class="shopee-logo">
                    <img src="../assets/img/shopee-logo.png" alt="">
                </a>
                <span class="header-text">Đăng nhập
                </span>
            </div>
            <div class="auth-header__right">
                Cần trợ giúp?
            </div>

        </header>

        <div class="body">
            <form action='login.php?do=login' method="post" class="auth-container">

                <!-- Login form  -->
                <div class="auth-form" id="login-form" >
                    <div class="auth-form__container">
                        <div class="auth-form__header">
                            <h3 class="auth-form__heading">Đăng Nhập</h3>
                            <div class="auth-form__switch-btn">Admin</div>
                        </div>

                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input type="text" class="auth-form__input" placeholder="Nhập họ tên" name="hotennv" required>
                            </div>
                        </div>
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu" name='password' required>
                            </div>
                        </div>

                        <div class="auth-form__aside">
                            <div class="auth-form__help">
                                <a href="" class="auth-form__help-link auth-form__help-link--forgot">Quên mật khẩu</a>
                                <span class="auth-form__help-separate"></span>
                                <a href="" class="auth-form__help-link">Cần trợ giúp?</a>
                            </div>
                        </div>

                        <div class="auth-form__controls">
                            <input class="btn btn--close" type="reset">
                            <button class="btn btn--primary" type="submit" name="login">ĐĂNG NHẬP</button>
                        </div>
                    </div>

                    <div class="auth-form__socials">
                        <a href="" class="btn btn--size-s btn-with-icon-facebook">
                            <i class="fa fa-facebook-square" aria-hidden="true"></i>
                            Đăng nhập với Facebook
                        </a>
                        <a href="" class="btn btn--size-s btn-with-icon-google">
                            <i class="fa fa-google" aria-hidden="true"></i>
                            Đăng nhập Google
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <?php include 'footer.php' ?>
    </div>
</body>

</html>