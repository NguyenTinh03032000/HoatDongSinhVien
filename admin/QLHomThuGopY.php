<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý hòm thư góp ý</title>
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

        <?php

        $sqlThongTin = "select * from giangvien where MaGiangVien = '" . $_SESSION['Username'] . "'";
        $kqThongTin = mysqli_query($kn, $sqlThongTin) or die("Lỗi truy vấn");
        $rowThongTin = mysqli_fetch_array($kqThongTin);

        $MaGiangVien = $rowThongTin['MaGiangVien'];

        ?>

        <h4 style="text-align: center">QUẢN LÝ GÓP Ý SINH VIÊN</h4>
        <hr>

        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10">
                <?php
                if ($user) {
                    // Cho phép hiển thị bao nhiu dòng trên một trang
                    $sdttrang = 25;

                    if (isset($_GET['trang'])) {
                        $page = $_GET['trang'];
                    } else {
                        $page = 0;
                    }

                    $today = date("Y-m-d");
                    $today_time = strtotime($today);

                    $lenhdem = "SELECT * FROM homthugopy INNER JOIN sinhvien ON sinhvien.MaSinhVien = homthugopy.MaSinhVien 
                                                            INNER JOIN lop ON lop.MaLop = sinhvien.MaLop";
                    $kqdem = mysqli_query($kn, $lenhdem) or die("Lỗi truy vấn");
                    $sodong = mysqli_num_rows($kqdem);
                    $sotrang = $sodong / $sdttrang;
                    $vtbd = $page * $sdttrang;

                    $phantrang = "SELECT * FROM homthugopy INNER JOIN sinhvien ON sinhvien.MaSinhVien = homthugopy.MaSinhVien 
                                                            INNER JOIN lop ON lop.MaLop = sinhvien.MaLop 
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