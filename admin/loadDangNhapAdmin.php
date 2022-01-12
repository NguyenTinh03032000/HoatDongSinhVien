<link rel="stylesheet" href="style/style-DangNhap.css">
<div class="nentrang">
    <div class="formdangnhap">
        <form action="" method="POST" class="needs-validation" novalidate>
            <img src="image/logo1.png" class="rounded" style="max-width: 40%">
            <h3 style="text-align: center"><b>KHOA CÔNG NGHỆ THÔNG TIN</b></h3>
            <h3 style="text-align: center"><i>Quản lý sổ tay sinh viên</i></h3>
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
            <button type="submit" name="btn_submit" class="btn btn-outline-dark btn-lg"><b>ĐĂNG NHẬP</b></button>
            <br>
        </form>
        <br>
    </div>
</div>

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

<?php
if (isset($_POST["btn_submit"])) {
    $_SESSION['Username'] = $_POST["Username"];
    $pass = array_key_exists('Password', $_POST) ? $_POST["Password"] : null;

    $sql1 = "select * from giangvien where MaGiangVien='" . $_SESSION['Username'] . "'";
    $kq1 = mysqli_query($kn, $sql1);

    if (!($row1 = mysqli_fetch_array($kq1))) {
        echo '<script>alert("Tên đăng nhập không tồn tại");</script>';
        session_destroy();
    } else {
        if ($pass != $row1['MatKhau']) {
            echo '<script>alert("Sai mật khẩu");</script>';
            session_destroy();
        } else {
            echo '<meta http-equiv="refresh" content="0">';
        }
    }
}
?>