<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thông tin tài khoản</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-color.css">
</head>

<body>

    <!-- top đầu trang -->
    <div class="jumbotron1 text-center" style="margin-bottom:0;  padding: 20px;">

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu_admin_1(); ?>

    <!-- thân của trang -->
    <div class="container-fluid" style="margin-top:30px;">
        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10">
                <?php
                if ($user) {
                ?>
                    <div class="container">
                        <h3 style="text-align: center">THÔNG TIN TÀI KHOẢN</h3>
                        <hr>
                        <form action="ThongTinTaiKhoanAdmin.php" class="needs-validation" method="POST" novalidate>
                            <?php
                            $sql1 = "select * from giangvien where MaGiangVien='" . $_SESSION['Username'] . "'";
                            $kq1 = mysqli_query($kn, $sql1);
                            $row = mysqli_fetch_array($kq1);

                            $gioitinh = $row['GioiTinh'];
                            ?>
                            <div class="media">
                                <div class="row" style="width: 100%;">
                                    <div class="col-sm-4" style="display: flex; justify-content: center;">
                                        <img src="<?php if ($gioitinh == "Nam") {
                                                        echo 'image/anh-nam.jpg';
                                                    } else {
                                                        echo 'image/anh-nu.jpg';
                                                    } ?>" style="width: 350px; height: auto;">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="media-body">
                                            <h5><?php echo $row['MaGiangVien'] . ' - ' . $row['HoTen'] ?></h5>
                                            <hr>
                                            <p>Ngày sinh: <?php echo $row['NgaySinh'] ?></p>
                                            <p>Giới tính: <?php echo $row['GioiTinh'] ?></p>
                                            <p>Số điện thoại: <?php echo $row['SDT'] ?></p>
                                            <p>Email: <?php echo $row['Email'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>
                    </div>
                <?php
                } else {
                    include "loadDangNhapAdmin.php";
                }
                ?>
                <br>

            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>

    <!-- chân trang -->
    <div class="jumbotron1 text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>

</html>
​