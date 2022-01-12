<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Nội dung góp ý sinh viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-color.css">
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>

<body>

    <!-- top đầu trang -->
    <div class="jumbotron1 text-center" style="margin-bottom:0;  padding: 20px;">

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu_user_1(); ?>

    <!-- thân của trang -->
    <div class="container-fluid" style="margin-top:30px;">
        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10">
                <h2 style="text-align: center">NỘI DUNG GÓP Ý SINH VIÊN</h2>
                <hr>
                <div class="container">

                    <?php
                    if ($user) {

                        $sqlThongTin = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop 
                                                                INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc 
                                                                where MaSinhVien='" . $_SESSION['Username'] . "'";
                        $kqThongTin = mysqli_query($kn, $sqlThongTin);
                        $row = mysqli_fetch_array($kqThongTin);

                        // Cho phép hiển thị bao nhiu dòng trên một trang
                        $sdttrang = 15;

                        if (isset($_GET['trang'])) {
                            $page = $_GET['trang'];
                        } else {
                            $page = 0;
                        }

                        $today = date("Y-m-d");
                        $today_time = strtotime($today);

                        $lenhdem = "SELECT * FROM homthugopy INNER JOIN sinhvien ON sinhvien.MaSinhVien = homthugopy.MaSinhVien 
                                                            INNER JOIN lop ON lop.MaLop = sinhvien.MaLop 
                                                            where sinhvien.MaSinhVien = '" . $_SESSION['Username'] . "'";
                        $kqdem = mysqli_query($kn, $lenhdem) or die("Lỗi truy vấn");
                        $sodong = mysqli_num_rows($kqdem);
                        $sotrang = $sodong / $sdttrang;
                        $vtbd = $page * $sdttrang;

                        $phantrang = "SELECT * FROM homthugopy INNER JOIN sinhvien ON sinhvien.MaSinhVien = homthugopy.MaSinhVien 
                                                            INNER JOIN lop ON lop.MaLop = sinhvien.MaLop 
                                                            where sinhvien.MaSinhVien = '" . $_SESSION['Username'] . "'
                                                            ORDER BY NgayGopY DESC, GioGopY DESC limit {$vtbd}, {$sdttrang} ";
                        $kqpt = mysqli_query($kn, $phantrang) or die("Lỗi truy vấn phân trang");

                        while ($row1 = mysqli_fetch_array($kqpt)) {
                            $ngaygui = date_create($row1['NgayGopY']);
                            $ngay = date_format($ngaygui, "d/m/Y");
                    ?>
                            <div class="card">
                                <div class="card-body">
                                    <button type="button" class="btn btn-block" data-toggle="modal" data-target="#myModal<?php echo $row1['ID'] ?>">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6 class="card-title" style="margin-left: auto;text-align: left;"><?php echo ($row1['HoTen'] . " [ " . $row1['MaSinhVien'] . " ]") ?></h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6 style="margin-right: auto;text-align: right;">
                                                    <small>
                                                        <i>
                                                            <?php echo "Thời gian: " . ($ngay . " - " . $row1['GioGopY']) ?>
                                                        </i>
                                                    </small>
                                                </h6>
                                            </div>
                                        </div>

                                        <p class="card-text" style="text-align: left;"><?php echo ("Tiêu đề: " . $row1['TieuDe']) ?></p>
                                    </button>

                                    <!-- The Modal -->
                                    <div class="modal fade" id="myModal<?php echo $row1['ID'] ?>">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <div style="display: block;">
                                                        <h5 class="modal-title"><?php echo ($row1['HoTen'] . " [ " . $row1['MaSinhVien'] . " ]") ?></h5>
                                                        <h5 class="modal-title"><?php echo "Thời gian gửi: " . ($ngay . " - " . $row1['GioGopY']) ?></h5>
                                                        <hr>
                                                        <h5 class="modal-title"><?php echo ("Tiêu đề: " . $row1['TieuDe']) ?></h5>
                                                    </div>

                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">

                                                    <div class="container mt-3">
                                                        <div class="media border p-3">
                                                            <div class="media-body">
                                                                <div class="p-3">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <h5 class="card-title" style="margin-left: auto;text-align: left;">Nội dung</h5>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <h6 style="margin-right: auto;text-align: right;">
                                                                                <small>
                                                                                    <i>
                                                                                        <?php echo "Thời gian: " . ($ngay . " - " . $row1['GioGopY']) ?>
                                                                                    </i>
                                                                                </small>
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <h4>
                                                                        <small>
                                                                            <pre style="white-space: pre-line; font-size: 18px; font-family: Cambiria;">
                                                                            <?php echo $row1['NoiDung'] ?>
                                                                        </pre>
                                                                        </small>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                    <?php
                        }

                        echo " <div style='display:flex; justify-content:center'>";
                        echo '
                    <ul class="pagination">';
                        // tạo nút phân trang
                        for ($i = 0; $i < $sotrang; $i++) {
                            $t = $i + 1;

                            echo '
                        
                            <li class="page-item"><a class="page-link" href="QLHomThuGopY.php?trang=' . $i . '">' . $t . '</a></li>
                            
                    ';
                            // echo "<a style='text-decoration: none; font-size: 20px;margin: 20px;'' href='HoatDongUser.php?trang=$i'>Trang $t </a>";


                        }
                        echo '</ul>';
                        echo "</div>";
                    } else {
                        include "loadDangNhapUser.php";
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

        <?php
        function guiGopY()
        {
            include "bocuc/Connect.php";

            $MaSV = $_SESSION['Username'];
            $message = array_key_exists('noidung', $_POST) ? $_POST['noidung'] : null;
            $tieude = array_key_exists('tieude', $_POST) ? $_POST['tieude'] : null;

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = getdate();
            $ngay = $date['mday'];
            $thang = $date['mon'];
            $nam = $date['year'];
            $gio = $date['hours'];
            $phut = $date['minutes'];
            $giay = $date['seconds'];

            $ngayGopY = $nam . "-" . $thang . "-" . $ngay;
            $gioGopY = $gio . ":" . $phut . ":" . $giay;

            $sql = "insert into homthugopy (ID, MaSinhVien, NgayGopY, GioGopY, TieuDe, NoiDung) values ('', '$MaSV', '$ngayGopY', '$gioGopY', '$tieude' , '$message')";
            $kq = mysqli_query($kn, $sql);

            echo '<script>alert("Gửi thông tin góp ý thành công!");</script>';
        }

        if ($_POST) {
            if (isset($_POST['submit']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                guiGopY();
            }
        }
        ?>
</body>

</html>
​<script>
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