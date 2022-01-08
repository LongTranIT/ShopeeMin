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
                <span class="header-text">Đăng ký</span>
            </div>
            <div class="auth-header__right">
                Cần trợ giúp?
            </div>

        </header>

        <div class="body">
            <form action='register_process.php' method="post" class="auth-container">

                <!-- Register form  -->
                <div class="auth-form" id="register-form">
                    <div class="auth-form__container">
                        <div class="auth-form__header">
                            <h3 class="auth-form__heading">Đăng Ký</h3>
                            <a href="./login.php" class="auth-form__switch-btn">Đăng nhập</a>
                        </div>

                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input name="hotenkh" type="text" class="auth-form__input" placeholder="Nhập tên đăng nhập" required>
                            </div>
                        </div>
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input name='password' type="password" class="auth-form__input" placeholder="Nhập mật khẩu" required>
                            </div>
                        </div>
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input name='password_again' type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu" required>
                            </div>
                        </div>

                        <div class="auth-form__aside">
                            <p class="auth-form__policy-text">
                                Bằng việc đăng kí, bạn đồng ý với Shopee về
                                <a href="" class="auth-from__text-link"> Điều khoản dịch vụ</a>
                                &
                                <a href="" class="auth-from__text-link"> Chính sách bảo mật</a>
                            </p>
                        </div>

                        <div class="auth-form__controls">
                            <input type="reset" class="btn btn--close">
                            <button class="btn btn--primary">ĐĂNG KÝ</button>
                        </div>
                    </div>

                    <div class="auth-form__socials">
                        <a href="" class="btn btn--size-s btn-with-icon-facebook">
                            <i class="fa fa-facebook-square" aria-hidden="true"></i>
                            Kết nối với Facebook
                        </a>
                        <a href="" class="btn btn--size-s btn-with-icon-google">
                            <i class="fa fa-google" aria-hidden="true"></i>
                            Kết nối với Google
                        </a>
                    </div>
                </div>
            </form>

        </div>

        <?php
            include('footer.php');
        ?>
    </div>
    
</body>

</html>