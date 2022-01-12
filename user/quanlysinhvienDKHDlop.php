<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";

//error_reporting(0);

$mahd = $_GET['mahd'];
$malop = $_GET['malop'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý đăng ký hoạt động lớp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/22403d42e6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-color.css">
</head>
<style>
    .smallbtn {
        border: none;
        outline: none;
        border-radius: 5px;
        background: transparent;
    }

    .smallbtn:hover {
        box-shadow: 5px 5px 10px gray;
    }

    .smallbtn1 {
        border: none;
        outline: none;
        border-radius: 5px;
        background: transparent;
    }

    .smallbtn1:hover {
        box-shadow: 5px 5px 10px gray;
    }

    .smallbtn2 {
        border: none;
        outline: none;
        border-radius: 5px;
        background: transparent;
    }

    .smallbtn2:hover {
        box-shadow: 5px 5px 10px gray;
    }
</style>

<body>

    <!-- top đầu trang -->
    <div class="jumbotron1 text-center" style="margin-bottom:0; padding: 20px">

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu_user_1(); ?>

    <!-- thân của trang -->
    <div class="container-fluid" style="margin-top:30px">
        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10">
                <?php
                if ($user) {
                ?>

                    <?php
                    $sql1 = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc where lop.MaLop = '" . $malop . "'";
                    $kq1 = mysqli_query($kn, $sql1);
                    $row = mysqli_fetch_array($kq1);

                    $sql2 = "select * from hoatdong where MaHoatDong = '" . $mahd . "'";
                    $kq2 = mysqli_query($kn, $sql2);
                    $row2 = mysqli_fetch_array($kq2);
                    ?>

                    <h3 style="text-align: center">QUẢN LÝ ĐĂNG KÝ HOẠT ĐỘNG SINH VIÊN</h3>
                    <h4 style="text-align: center">Lớp: <?php echo $row['TenLop'] ?></h4>
                    <br>

                    <div class="border border-primary" style="padding: 10px;">
                        <h4><small>Hoạt động: <?php echo $row2['TenHoatDong'] ?></small></h4>
                        <h4><small>Ngày diễn ra: <?php echo htmlspecialchars(date_format(date_create($row2['NgayDienRa']), "d-m-Y")); ?></small></h4>
                        <h4><small>Năm học: <?php echo $row2['NamHoc'] ?> - Học kỳ: <?php echo $row2['HocKy'] ?></small></h4>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <button type="button" class="btn btn-primary-all btn-block" data-toggle="modal" data-target="#myModalAdd" name="btnThem" style="margin: 0 0 15px 0;">
                                Thêm sinh viên đăng ký hoạt động
                            </button>
                        </div>
                        <div class="col-lg-3">
                            <button type="button" class="btn btn-primary-all btn-block" data-toggle="modal" data-target="#myModalUpdate" name="btnSua" style="margin: 0 0 15px 0;">
                                Cập nhật tham gia hoạt động
                            </button>
                        </div>
                        <div class="col-lg-3">
                            <button type="button" class="btn btn-primary-all btn-block" data-toggle="modal" data-target="#myModalDelete" name="btnXoa" style="margin: 0 0 15px 0;">
                                Xóa sinh viên tham gia hoạt động
                            </button>
                        </div>
                        <div class="col-lg-3">
                            <form action="exportHoatDong.php" method="post">
                                <button type="button" class="btn btn-primary-all btn-block" data-toggle="modal" data-target="#myModalIn" name="btnIn" style="margin: 0 0 15px 0;">
                                    Xuất danh sách
                                </button>

                                <!-- MODAL IN-->
                                <div class="modal fade" id="myModalIn">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Xuất danh sách tham gia</h5>
                                                <button type="button" class="btn" data-dismiss="modal"><b>X</b></button>
                                            </div>
                                            <div class="modal-body" style="display: flex; justify-content: center;margin-right:10px; margin-top:7px">
                                                <table>
                                                    <tr>
                                                        <td><input type="text" name="txtMaHoatDong" hidden value="<?php echo $mahd ?>"></td>
                                                        <td><input type="text" name="txtMaLop" hidden value="<?php echo $malop ?>"></td>
                                                    </tr>
                                                </table>
                                                <h5>Bạn có chắc chắn muốn xuất danh sách tham gia hoạt động này?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary-all" name="btnIn" value="btnIn">Xuất danh sách</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->
                            </form>
                        </div>
                    </div>

                    <hr>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nhập thông tin cần tìm kiếm ....." id="myInput" style="font-size: 18px">
                        </div>

                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-hover" style="width:100%">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="vertical-align: inherit; text-align: center">STT</th>
                                        <th style="vertical-align: inherit; text-align: center">Mã sinh viên</th>
                                        <th style="vertical-align: inherit; text-align: center">Họ tên</th>
                                        <th style="vertical-align: inherit; text-align: center">Lớp</th>
                                        <th style="vertical-align: inherit; text-align: center">Tham gia</th>
                                        <th style="vertical-align: inherit; text-align: center">Cập nhật</th>
                                        <th style="vertical-align: inherit; text-align: center">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql3 = "SELECT * FROM dangkyhoatdong INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong
                                        INNER JOIN sinhvien ON dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien 
                                        INNER JOIN lop ON sinhvien.MaLop = lop.MaLop
                                        WHERE hoatdong.MaHoatDong = '" . $mahd . "' and lop.MaLop = '" . $malop . "'";
                                    $kq3 = mysqli_query($kn, $sql3) or die("Lỗi truy vấn");
                                    $stt = 0;
                                    while ($row3 = mysqli_fetch_array($kq3)) {
                                        $stt = $stt + 1;
                                    ?>
                                        <tr id="thongtin">
                                            <td>
                                                <p style="margin: 7px auto; text-align: center; vertical-align: inherit;"><?php echo $stt; ?></p>
                                            </td>
                                            <td>
                                                <p style="margin: 7px auto; vertical-align: inherit; text-align: center;"><?php echo $row3['MaSinhVien']; ?></p>
                                            </td>
                                            <td>
                                                <p style="margin: 7px auto; text-align: center; vertical-align: inherit; width: 250px"><?php echo $row3['HoTen']; ?></p>
                                            </td>
                                            <td>
                                                <p style="margin: 7px auto; text-align: center; vertical-align: inherit; width: 200px"><?php echo $row3['TenLop']; ?></p>
                                            </td>
                                            <td>
                                                <p style="margin: 7px auto; text-align: center; vertical-align: inherit; width: 120px"><?php echo $row3['ThamGia']; ?></p>
                                            </td>
                                            <td style="text-align: center; vertical-align: inherit;">
                                                <button class=" btn btnchung btnUpdate" type="button" name="btnUpdate" data-toggle="modal" data-target="#Update">
                                                    <img src="image/updated.png" style="max-width: 30px; height:auto;">
                                                </button>
                                            </td>
                                            <td style="text-align: center; vertical-align: inherit;">
                                                <button class=" btn btnchung btnDelete" type="button" name="btnXoa" data-toggle="modal" data-target="#Xoa">
                                                    <img src="image/delete.png" style="max-width: 30px; height:auto;">
                                                </button>
                                            </td>
                                        <?php } ?>
                                </tbody>
                            </table>
                            <br>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $("#myInput").on("keyup", function() {
                                    var value = $(this).val().toLowerCase();
                                    $("#myTable #thongtin").filter(function() {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                            });
                        </script>

                        <!-- MODAL cập nhật 1 sinh viên-->
                        <div class="modal fade" id="Update">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Cập nhật tham gia</h5>
                                        <button type="button" class="btn" data-dismiss="modal"><b>X</b></button>
                                    </div>
                                    <div class="modal-body" style="display: flex; justify-content: center;margin-right:10px; margin-top:7px">
                                        <table>
                                            <tr hidden>
                                                <td><input type="text" id="txtMaHoatDong_update" name="txtMaHoatDong_update" value="<?php echo $mahd ?>"></td>
                                                <td><input type="text" id="txtMaSinhVien_update" name="txtMaSinhVien_update"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="display: flex; justify-content: center;">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="Tham gia" name="rbThamGia" checked>Tham gia
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="Không tham gia" name="rbThamGia">Không tham gia
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <br>
                                                    <h5 style="text-align: center;">Bạn có chắc chắn muốn cập nhật tham gia hoạt động này?</h5>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary-all" name="btnCapNhat" value="btnCapNhat">Cập nhật</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->

                        <!-- MODAL XÓA-->
                        <div class="modal fade" id="Xoa">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Xóa sinh viên</h5>
                                        <button type="button" class="btn" data-dismiss="modal"><b>X</b></button>
                                    </div>
                                    <div class="modal-body" style="display: flex; justify-content: center;margin-right:10px; margin-top:7px">
                                        <table>
                                            <tr>
                                                <td><input type="text" hidden name="masv" id="masv"></td>
                                            </tr>
                                        </table>
                                        <h5>Bạn có chắc chắn muốn xóa sinh viên này?</h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary-all" name="btnEdit" value="btnEdit" onsubmit="return false">Xóa</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->

                        <!-- The Modal Thêm-->
                        <div class="modal fade" id="myModalAdd" ata-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Thêm sinh viên đăng ký hoạt động</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h4 hidden><small>Hoạt động: <?php echo $row2['MaHoatDong'] ?></small></h4>
                                        <h4><small>Hoạt động: <?php echo $row2['TenHoatDong'] ?></small></h4>
                                        <h4><small>Ngày diễn ra: <?php echo $row2['NgayDienRa'] ?></small></h4>
                                        <h4><small>Năm học: <?php echo $row2['NamHoc'] ?> - Học kỳ: <?php echo $row2['HocKy'] ?></small></h4>
                                        <h4><small>Thêm sinh viên đăng ký:</small></h4>

                                        <div style="overflow-y: scroll; height: 400px;">
                                            <?php
                                            while ($row = mysqli_fetch_array($kq1)) {
                                                $masinhvien = $row['MaSinhVien'];
                                                echo '
                                    <div class="form-check">
                                        <label class="form-check-label form-control" for="check1">
                                            <input type="checkbox" class="form-check-input" name="sv[]" value="' . $masinhvien . '"';

                                                $sql3 = "select * from dangkyhoatdong 
                                                        INNER JOIN sinhvien ON sinhvien.MaSinhVien = dangkyhoatdong.MaSinhVien 
                                                        INNER JOIN hoatdong ON hoatdong.MaHoatDong = dangkyhoatdong.MaHoatDong 
                                                        where sinhvien.MaSinhVien = '" . $masinhvien . "' and dangkyhoatdong.MaHoatDong = '" . $mahd . "'";
                                                $kq3 = mysqli_query($kn, $sql3);
                                                $row3 = mysqli_fetch_array($kq3);

                                                if (isset($row3['MaSinhVien'])) {
                                                    echo 'checked';
                                                }

                                                echo '>' . $row['MaSinhVien'] . " - " . $row['HoTen'] . '
                                        </label>
                                    </div>';
                                            }
                                            ?>
                                        </div>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary-all" name="btnAdd" value="btnAdd" onsubmit="return false">Thêm</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->

                        <!-- The Modal Cập nhật-->
                        <div class="modal fade" id="myModalUpdate" ata-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Cập nhật sinh viên đăng ký hoạt động</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h4 hidden><small>Hoạt động: <?php echo $row2['MaHoatDong'] ?></small></h4>
                                        <h4><small>Hoạt động: <?php echo $row2['TenHoatDong'] ?></small></h4>
                                        <h4><small>Ngày diễn ra: <?php echo $row2['NgayDienRa'] ?></small></h4>
                                        <h4><small>Năm học: <?php echo $row2['NamHoc'] ?> - Học kỳ: <?php echo $row2['HocKy'] ?></small></h4>
                                        <h4><small>Cập nhật sinh viên đăng ký:</small></h4>

                                        <input class="form-control" id="myInput1" type="text" placeholder="Nhập thông tin tìm kiếm" style="margin: 15px auto;">

                                        <div style="overflow-y: scroll; height: 350px;">
                                            <table style="width:100%;" class="table-bordered" id="myTable1">
                                                <tr style="text-align: center;">
                                                    <th style=" padding: 5px">STT</th>
                                                    <th style=" padding: 10px">Sinh viên</th>
                                                    <th style="width: 60px; padding: 15px">Tham gia</th>
                                                    <th style="width: 60px; padding: 10px">Không tham gia</th>
                                                </tr>
                                                <?php
                                                $sql4 = "SELECT * FROM dangkyhoatdong INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong
                                            INNER JOIN sinhvien ON dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien 
                                            INNER JOIN lop ON sinhvien.MaLop = lop.MaLop
                                            WHERE hoatdong.MaHoatDong = '" . $mahd . "' and lop.MaLop = '" . $malop . "'";
                                                $kq4 = mysqli_query($kn, $sql4) or die("Lỗi truy vấn");
                                                $sttCapNhat = 0;
                                                while ($row4 = mysqli_fetch_array($kq4)) {
                                                    $masinhvien = $row4['MaSinhVien'];
                                                    $sttCapNhat += 1;
                                                    echo '
                                            <tr id="thongtin1">
                                                <td style="text-align: center; padding: 10px">' . $sttCapNhat . '</td>
                                                <td>' . $row4['MaSinhVien'] . " - " . $row4['HoTen'] . '</td>
                                                <td>
                                                    <input type="checkbox" style="margin: auto; text-align: center; display: block;" name="mangthamgia[]" value="' . $masinhvien . '" ';

                                                    $sql5 = "select * from dangkyhoatdong 
                                                                    INNER JOIN sinhvien ON sinhvien.MaSinhVien = dangkyhoatdong.MaSinhVien 
                                                                    INNER JOIN hoatdong ON hoatdong.MaHoatDong = dangkyhoatdong.MaHoatDong 
                                                                    where sinhvien.MaSinhVien = '" . $masinhvien . "' and dangkyhoatdong.MaHoatDong = '" . $mahd . "' and dangkyhoatdong.ThamGia = 'Tham gia'";
                                                    $kq5 = mysqli_query($kn, $sql5);
                                                    $row5 = mysqli_fetch_array($kq5);

                                                    if (isset($row5['MaSinhVien'])) {
                                                        echo 'checked';
                                                    }

                                                    echo '>';
                                                    echo '
                                                </td>
                                                <td>
                                                    <input type="checkbox" style="margin: auto; text-align: center; display: block;" name="mangkhongthamgia[]" value="' . $masinhvien . '" ';

                                                    $sql6 = "select * from dangkyhoatdong 
                                                                INNER JOIN sinhvien ON sinhvien.MaSinhVien = dangkyhoatdong.MaSinhVien 
                                                                INNER JOIN hoatdong ON hoatdong.MaHoatDong = dangkyhoatdong.MaHoatDong 
                                                                where sinhvien.MaSinhVien = '" . $masinhvien . "' and dangkyhoatdong.MaHoatDong = '" . $mahd . "' and dangkyhoatdong.ThamGia = 'Không tham gia'";
                                                    $kq6 = mysqli_query($kn, $sql6);
                                                    $row6 = mysqli_fetch_array($kq6);

                                                    if (isset($row6['MaSinhVien'])) {
                                                        echo 'checked';
                                                    }

                                                    echo '>
                                                </td>
                                            </tr>';
                                                }
                                                ?>
                                            </table>
                                        </div>

                                        <script>
                                            $(document).ready(function() {
                                                $("#myInput1").on("keyup", function() {
                                                    var value = $(this).val().toLowerCase();
                                                    $("#myTable1 #thongtin1").filter(function() {
                                                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                                    });
                                                });
                                            });
                                        </script>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary-all" name="btnUpdate" value="btnUpdate" onsubmit="return false">Cập nhật</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->

                        <!-- The Modal Xóa-->
                        <div class="modal fade" id="myModalDelete" ata-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Xóa sinh viên đăng ký hoạt động</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <h4 hidden><small>Hoạt động: <?php echo $row2['MaHoatDong'] ?></small></h4>
                                        <h4><small>Hoạt động: <?php echo $row2['TenHoatDong'] ?></small></h4>
                                        <h4><small>Ngày diễn ra: <?php echo $row2['NgayDienRa'] ?></small></h4>
                                        <h4><small>Năm học: <?php echo $row2['NamHoc'] ?> - Học kỳ: <?php echo $row2['HocKy'] ?></small></h4>
                                        <h4><small>Cập nhật sinh viên đăng ký:</small></h4>

                                        <div style="overflow-y: scroll; height: 400px;">
                                            <table style="width:100%;" class="table-bordered">
                                                <tr style="text-align: center;">
                                                    <th style=" padding: 5px">STT</th>
                                                    <th style=" padding: 10px">Sinh viên</th>
                                                    <th style="width: 60px; padding: 15px">Xóa</th>
                                                </tr>
                                                <?php
                                                $sql6 = "SELECT * FROM dangkyhoatdong INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong
                                            INNER JOIN sinhvien ON dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien 
                                            INNER JOIN lop ON sinhvien.MaLop = lop.MaLop
                                            WHERE hoatdong.MaHoatDong = '" . $mahd . "' and lop.MaLop = '" . $malop . "'";
                                                $kq6 = mysqli_query($kn, $sql4) or die("Lỗi truy vấn");
                                                $sttXoa = 0;
                                                while ($row6 = mysqli_fetch_array($kq6)) {
                                                    $maxoasinhvien = $row6['MaSinhVien'];
                                                    $sttXoa += 1;
                                                    echo '
                                            <tr>
                                                <td style="text-align: center; padding: 10px">' . $sttXoa . '</td>
                                                <td>' . $row6['MaSinhVien'] . " - " . $row6['HoTen'] . '</td>
                                                <td>
                                                    <input type="checkbox" style="margin: auto; text-align: center; display: block;" name="mangxoa[]" value="' . $maxoasinhvien . '">
                                                </td>
                                            </tr>';
                                                }

                                                ?>

                                            </table>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary-all" name="btnDelete" value="btnDelete" onsubmit="return false">Xóa</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->

                    </form>
                <?php
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

    <script>
        $(document).ready(function() {

            $('.btnDelete').on('click', function() {
                $('#Xoa').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#masv').val(data[1].trim());
            });
        });

        $(document).ready(function() {
            $('.btnUpdate').on('click', function() {
                $('#Update').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#txtMaSinhVien_update').val(data[1].trim());
                $('.form-check-input').val([data[4].trim()]);
            });
        });
    </script>
</body>

<?php
if (isset($_POST['btnEdit'])) {
    if (isset($_POST['masv'])) {
        $maSV = $_POST['masv'];
        $sql1 = "delete from dangkyhoatdong where MaSinhVien ='" . $maSV . "' and MaHoatDong = '" . $mahd . "'";
        $kq1 = mysqli_query($kn, $sql1);
        echo '<script> alert("Xóa thành công");</script>';
    } else
        echo "<script> alert('Bạn chưa chọn thông tin')</script>";

    echo '<meta http-equiv="refresh" content="0">';
}

if (isset($_POST['btnAdd'])) {
    if (isset($_POST['sv'])) {
        foreach ($_POST['sv'] as $maSinhVien) {
            $sqlTruyVan = "select * from dangkyhoatdong where MaSinhVien = '" . $maSinhVien . "'";
            $kqTruyVan = mysqli_query($kn, $sqlTruyVan) or die("Lỗi truy vấn");
            $rowTruyVan = mysqli_fetch_array($kqTruyVan);

            if ($rowTruyVan['MaSinhVien'] == null) {
                $sql1 = "insert into dangkyhoatdong (MaHoatDong, MaSinhVien, ThamGia) values ('$mahd','$maSinhVien', N'Đăng ký')";
                $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
            }
        }
    }
    echo '<meta http-equiv="refresh" content="0">';
    echo '<script> alert("Thêm thông tin thành công");</script>';
}

if (isset($_POST['btnUpdate'])) {
    if (isset($_POST['mangthamgia'])) {
        foreach ($_POST['mangthamgia'] as $maSinhVienThamGia) {
            $sql1 = "update dangkyhoatdong set ThamGia = 'Tham gia' where MaSinhVien ='" . $maSinhVienThamGia . "' and MaHoatDong = '" . $mahd . "'";
            $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
        }
    }
    if (isset($_POST['mangkhongthamgia'])) {
        foreach ($_POST['mangkhongthamgia'] as $maSinhVienKhongThamGia) {
            $sql2 = "update dangkyhoatdong set ThamGia = 'Không tham gia' where MaSinhVien ='" . $maSinhVienKhongThamGia . "' and MaHoatDong = '" . $mahd . "'";
            $kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn");
        }
    }
    echo '<meta http-equiv="refresh" content="0">';
    echo '<script> alert("Cập nhật thông tin thành công");</script>';
}

if (isset($_POST['btnDelete'])) {
    if (isset($_POST['mangxoa'])) {
        foreach ($_POST['mangxoa'] as $maxoaSV) {
            $sql1 = "delete from dangkyhoatdong where MaSinhVien ='" . $maxoaSV . "' and MaHoatDong = '" . $mahd . "'";
            $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
        }
    }
    echo '<meta http-equiv="refresh" content="0">';
    echo '<script> alert("Xóa thông tin thành công");</script>';
}

if (isset($_POST['btnCapNhat'])) {
    $masv = $_POST['txtMaSinhVien_update'];
    $mahd = $_POST['txtMaHoatDong_update'];
    $thamgia = $_POST['rbThamGia'];

    $sql1 = "update dangkyhoatdong set ThamGia = '" . $thamgia . "' where MaSinhVien ='" . $masv . "' and MaHoatDong = '" . $mahd . "'";
    $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");

    echo '<meta http-equiv="refresh" content="0">';
    echo '<script> alert("Cập nhật thông tin thành công");</script>';
}
?>

</html>
​