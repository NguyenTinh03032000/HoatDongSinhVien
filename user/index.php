<?php
session_start();
include "bocuc/Connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-DangNhap.css">
    <link rel="stylesheet" href="style/style-color.css">
</head>

<body>
    <div class="nentrang">
        <div class="formdangnhap">
            <form action="" method="POST" class="needs-validation" novalidate>
                <img src="image/logo1.png" class="rounded">
                <h2 style="text-align: center"><b> HOẠT ĐỘNG SINH VIÊN </b></h2>
                <span>------ &#10020; ------</span>
                <style>
                    span {
                        content: "\2724";
                        margin-bottom: 15px;
                    }
                </style>
                <br><br>
                <div class="form-group">
                    <input type="text" class="form-control" id="Username" placeholder="Nhập mã đăng nhập" name="Username" required>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="Password" id="Password" placeholder="Nhập mật khẩu" required></input>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng không được bỏ trống thông tin!</div>
                </div>
                <button type="submit" name="btn_submit" class="btn btn-primary-all"><b>ĐĂNG NHẬP</b></button>
                <br>
            </form>
            <br>
        </div>
    </div>
</body>

<script>
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</html>

<?php
if (isset($_POST["btn_submit"])) {
    $_SESSION['Username'] = $_POST["Username"];
    $pass = array_key_exists('Password', $_POST) ? $_POST["Password"] : null;

    $sql1 = "select * from sinhvien where MaSinhVien='" . $_SESSION['Username'] . "'";
    $kq1 = mysqli_query($kn, $sql1);

    if (!($row1 = mysqli_fetch_array($kq1))) {
        echo '<script>alert("Tên đăng nhập không tồn tại");</script>';
    } else {
        if ($pass != $row1['MatKhau']) {
            echo '<script>alert("Sai mật khẩu");</script>';
        } else {
            header("Location: DKHoatDong.php");
        }
    }
}
?>
​