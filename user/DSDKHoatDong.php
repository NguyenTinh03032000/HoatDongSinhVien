<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách đăng ký hoạt động</title>
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

<?php
$cboNamHoc = array_key_exists('cboNamHoc', $_POST) ? $_POST['cboNamHoc'] : null;
$cboHocKy = array_key_exists('cboHocKy', $_POST) ? $_POST['cboHocKy'] : null;

function loadDL()
{
    include "bocuc/Connect.php";

    $MaSV = $_SESSION['Username'];

    $sqlThongTin = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop 
                                            INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc 
                                            where MaSinhVien='" . $_SESSION['Username'] . "'";
    $kqThongTin = mysqli_query($kn, $sqlThongTin);
    $row = mysqli_fetch_array($kqThongTin);

    $phantrang = "select * from dangkyhoatdong INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong 
                    where dangkyhoatdong.MaSinhVien = '" . $_SESSION['Username'] . "' ORDER BY NgayDienRa DESC ";
    $kqpt = mysqli_query($kn, $phantrang) or die("Lỗi truy vấn phân trang");

    $stt = 0;
    while ($row = mysqli_fetch_array($kqpt)) {
        $MaHD = $row['MaHoatDong'];
        $MaSV = $_SESSION['Username'];

        echo '
        <div class="col-lg-3" style="margin-bottom: 15px">
            <div class="card" style="width:300px">
                <img class="card-img-top" src="image/anh3.jpg" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center">' . $row['TenHoatDong'] . '</h5>
                    <hr>
                    <p class="card-text">Ngày diễn ra: ' . htmlspecialchars(date_format(date_create($row['NgayDienRa']), "d-m-Y")) . '</p>
                    <p>Năm học: ' . $row['NamHoc'] . ' <-> Học kỳ: ' . $row['HocKy'] . '</p>

                    <div class="row">
                        <div class="col-lg-12">';

        if ($row['ThamGia'] == "Tham gia") {
            echo '<div class="alert alert-success" style="margin: 0;">
                                    <h6 style="text-align: center;">Bạn đã tham gia hoạt động</h6>
                                </div>';
        } else if ($row['ThamGia'] == "Đăng ký") {
            echo '<div class="alert alert-info" style="margin: 0;">
                                    <h6 style="text-align: center;">Hoạt động đã đăng ký</h6>
                                </div>';
        } else {
            echo '<div class="alert alert-danger" style="margin: 0;">
                                    <h6 style="text-align: center;">Bạn không tham gia hoạt động</h6>
                                </div>';
        }



        echo '</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" data-toggle="modal" data-target="#mdChitiet' . $row['MaHoatDong'] . '" class="btn btn-info btn-block" style="margin-top: 10px;">CHI TIẾT</button>
                        </div>
                    </div>
                </div>

                <!-- MODAL CHI TIẾT, CHỈNH SỬA -->
                <div class="modal fade" id="mdChitiet' . $row['MaHoatDong'] . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="mdChitietLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mdChitietLabel">Chi tiết hoạt động</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Tên hoạt động:
                                            <input type="text" class="form-control" id="tenhoatdong" name="txtTenHD" style="font-size: 18px; pointer-events: none;" value="' . $row['TenHoatDong'] . '">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Ngày diễn ra:
                                            <input type="text" class="form-control" id="Ngaydienra" name="txtNgay" style="font-size: 18px; pointer-events: none;" value="' . htmlspecialchars(date_format(date_create($row['NgayDienRa']), "d-m-Y")) . '">
                                        </p>
                                    </div>
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Thời gian diễn ra:
                                            <input type="text" class="form-control" id="TGdienra" name="txtTG" style="font-size: 18px; pointer-events: none;" value="' . $row['ThoiGianDienRa'] . '">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Năm học:
                                            <input type="text" class="form-control" id="namhoc" name="txtNamhoc" style="font-size: 18px; pointer-events: none;" value="' . $row['NamHoc'] . '">
                                        </p>
                                    </div>
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Học kì:
                                            <input type="text" class="form-control" id="hocki" name="txthocki" style="font-size: 18px; pointer-events: none;" value="' . $row['HocKy'] . '">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Khóa tham gia:
                                            <input type="text" class="form-control" id="khoathamgia" name="txtkhoa" style="font-size: 18px; pointer-events: none;" value="' . $row['KhoaThamGia'] . '">
                                        </p>
                                    </div>
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Số lượng:
                                            <input type="text" class="form-control" id="soluong" name="txtsoluong" style="font-size: 18px; pointer-events: none;" value="' . $row['SoLuong'] . '">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Nội dung:
                                            <textarea class="form-control" id="noidung" name="txtNoiDung" style=" font-size: 18px; overflow-y: scroll; resize: none; height: 500px;" rows="3">' . $row['NoiDung'] . '</textarea>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->

            </div>
        </div>';
    }
}

function LocDL($cboNamHoc, $cboHocKy)
{
    include "bocuc/Connect.php";

    $sqlThongTin = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop 
                                            INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc 
                                            where MaSinhVien='" . $_SESSION['Username'] . "'";
    $kqThongTin = mysqli_query($kn, $sqlThongTin);
    $row = mysqli_fetch_array($kqThongTin);

    if ($cboNamHoc == "") {
        $phantrang = "select * from dangkyhoatdong INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong 
            where MaSinhVien = '" . $_SESSION['Username'] . "' and HocKy = '" . $cboHocKy . "' ORDER BY NgayDienRa DESC";
    } elseif ($cboHocKy == "") {
        $phantrang = "select * from dangkyhoatdong   INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong 
            where MaSinhVien = '" . $_SESSION['Username'] . "' and NamHoc = '" . $cboNamHoc . "'  ORDER BY NgayDienRa DESC";
    } else {
        $phantrang = "select * from dangkyhoatdong  INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong 
            where MaSinhVien = '" . $_SESSION['Username'] . "' and NamHoc = '" . $cboNamHoc . "' and HocKy = '" . $cboHocKy . "' ORDER BY NgayDienRa DESC";
    }

    $kqpt = mysqli_query($kn, $phantrang) or die("Lỗi truy vấn phân trang");

    $stt = 0;

    while ($row = mysqli_fetch_array($kqpt)) {
        $MaHD = $row['MaHoatDong'];
        $MaSV = $_SESSION['Username'];

        if ($row['NamHoc'] != null or $row['HocKy'] != null or $row['MaSinhVien'] != null) {
            echo '
        <div class="col-lg-3" style="margin-bottom: 15px">
            <div class="card" style="width:300px">
                <img class="card-img-top" src="image/anh3.jpg" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h5 class="card-title" style="text-align: center">' . $row['TenHoatDong'] . '</h5>
                    <hr>
                    <p class="card-text">Ngày diễn ra: ' . htmlspecialchars(date_format(date_create($row['NgayDienRa']), "d-m-Y")) . '</p>
                    <p>Năm học: ' . $row['NamHoc'] . ' <-> Học kỳ: ' . $row['HocKy'] . '</p>

                    <div class="row">
                        <div class="col-lg-12">';

            if ($row['ThamGia'] == "Tham gia") {
                echo '<div class="alert alert-success" style="margin: 0;">
                                    <h6 style="text-align: center;">Bạn đã tham gia hoạt động</h6>
                                </div>';
            } else if ($row['ThamGia'] == "Đăng ký") {
                echo '<div class="alert alert-info" style="margin: 0;">
                                    <h6 style="text-align: center;">Hoạt động đã đăng ký</h6>
                                </div>';
            } else {
                echo '<div class="alert alert-danger" style="margin: 0;">
                                    <h6 style="text-align: center;">Bạn không tham gia hoạt động</h6>
                                </div>';
            }

            echo '</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" data-toggle="modal" data-target="#mdChitiet' . $row['MaHoatDong'] . '" class="btn btn-info btn-block" style="margin-top: 10px;">CHI TIẾT</button>
                        </div>
                    </div>
                </div>

                <!-- MODAL CHI TIẾT, CHỈNH SỬA -->
                <div class="modal fade" id="mdChitiet' . $row['MaHoatDong'] . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="mdChitietLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mdChitietLabel">Chi tiết hoạt động</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Tên hoạt động:
                                            <input type="text" class="form-control" id="tenhoatdong" name="txtTenHD" style="font-size: 18px; pointer-events: none;" value="' . $row['TenHoatDong'] . '">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Ngày diễn ra:
                                            <input type="text" class="form-control" id="Ngaydienra" name="txtNgay" style="font-size: 18px; pointer-events: none;" value="' . htmlspecialchars(date_format(date_create($row['NgayDienRa']), "d-m-Y")) . '">
                                        </p>
                                    </div>
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Thời gian diễn ra:
                                            <input type="text" class="form-control" id="TGdienra" name="txtTG" style="font-size: 18px; pointer-events: none;" value="' . $row['ThoiGianDienRa'] . '">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Năm học:
                                            <input type="text" class="form-control" id="namhoc" name="txtNamhoc" style="font-size: 18px; pointer-events: none;" value="' . $row['NamHoc'] . '">
                                        </p>
                                    </div>
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Học kì:
                                            <input type="text" class="form-control" id="hocki" name="txthocki" style="font-size: 18px; pointer-events: none;" value="' . $row['HocKy'] . '">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Khóa tham gia:
                                            <input type="text" class="form-control" id="khoathamgia" name="txtkhoa" style="font-size: 18px; pointer-events: none;" value="' . $row['KhoaThamGia'] . '">
                                        </p>
                                    </div>
                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Số lượng:
                                            <input type="text" class="form-control" id="soluong" name="txtsoluong" style="font-size: 18px; pointer-events: none;" value="' . $row['SoLuong'] . '">
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                        <p style=" font-size: 18px;">
                                            Nội dung:
                                            <textarea class="form-control" id="noidung" name="txtNoiDung" style=" font-size: 18px; overflow-y: scroll; resize: none; height: 500px;" rows="3">' . $row['NoiDung'] . '</textarea>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->

            </div>
        </div>';
        } else {
            echo "<script>alert('Thông tin cần lọc dữ liệu không có trong hệ thống');</script>";
        }
    }
}
?>

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
                    <form action="" method="POST">
                        <h2 style="text-align: center">DANH SÁCH CÁC HOẠT ĐỘNG ĐÃ ĐĂNG KÝ</h2>
                        <hr>
                        <div class="row">
                            <div class="col-sm-1" style="justify-content: center;display: flex; margin:auto">
                            </div>
                            <div class="col-sm-3" style="justify-content: center;display: flex;">
                                <select name="cboNamHoc" class="form-control" id="cboNamHoc" style="margin: 5px 0;">
                                    <option value="">--Chọn năm học--</option>
                                    <?php
                                    $sql = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop 
                                        INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc where MaSinhVien='" . $_SESSION['Username'] . "'";
                                    $kq = mysqli_query($kn, $sql);
                                    $thuchienkq = mysqli_fetch_array($kq);
                                    $nam1 = ($thuchienkq['NamBatDau']) . "-" . ($thuchienkq['NamBatDau'] + 1);
                                    $nam2 = ($thuchienkq['NamBatDau'] + 1) . "-" . ($thuchienkq['NamBatDau'] + 2);
                                    $nam3 = ($thuchienkq['NamBatDau'] + 2) . "-" . ($thuchienkq['NamBatDau'] + 3);
                                    $nam4 = ($thuchienkq['NamBatDau'] + 3) . "-" . ($thuchienkq['NamBatDau'] + 4);
                                    $nam5 = ($thuchienkq['NamBatDau'] + 4) . "-" . ($thuchienkq['NamBatDau'] + 5);
                                    echo "<option value='$nam1'>$nam1</option>";
                                    echo "<option value='$nam2'>$nam2</option>";
                                    echo "<option value='$nam3'>$nam3</option>";
                                    echo "<option value='$nam4'>$nam4</option>";
                                    echo "<option value='$nam5'>$nam5</option>";
                                    ?>
                                </select>
                                <script type='text/javascript'>
                                    document.getElementById('cboNamHoc').value = "<?php echo $_POST['cboNamHoc']; ?>";
                                </script>
                            </div>
                            <div class="col-sm-3" style="justify-content: center;display: flex;">
                                <select name="cboHocKy" class="form-control" id="cboHocKy" style="margin: 5px 0;">
                                    <option value="">--Chọn học kỳ--</option>
                                    <option value="1">Học kỳ 1</option>
                                    <option value="2">Học kỳ 2</option>
                                </select>
                                <script type='text/javascript'>
                                    document.getElementById('cboHocKy').value = "<?php echo $_POST['cboHocKy']; ?>";
                                </script>
                            </div>
                            <div class="col-sm-2" style="justify-content: center;display: flex;">
                                <button class="btn btn-primary-all btn-block" type="submit" name="btnLoc" value="btnLoc" style="margin: 5px 0;">Lọc dữ liệu</button>
                            </div>
                            <div class="col-sm-2" style="justify-content: center;display: flex;">
                                <button class="btn btn-info  btn-block" type="submit" name="btnLamMoi" value="btnLamMoi" style="margin: 5px 0;">Làm mới</button>
                            </div>
                            <div class="col-sm-1" style="justify-content: center;display: flex;">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <?php
                            if ($_POST) {
                                if (isset($_POST['btnLoc']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                    LocDL($cboNamHoc, $cboHocKy);
                                }
                                if (isset($_POST['btnLamMoi']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                    loadDL();
                                }
                            } else {
                                loadDL();
                            }
                            ?>
                        </div>

                    </form>
                <?php
                } else {
                    include "loadDangNhapUser.php";
                }
                ?>
            </div>

            <div class="col-sm-1"></div>
        </div>
    </div>
    <?php

    ?>
    <!-- MODAL CHI TIẾT, CHỈNH SỬA -->
    <div class="modal fade" id="mdChitiet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdChitietLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mdChitietLabel">Chi tiết hoạt động</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div hidden style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Mã hoạt động:
                                <input type="text" class="form-control" id="mahoatdong" name="txtMaHD" style="font-size: 18px; pointer-events: none;">
                            </p>
                        </div>
                        <div class="col-sm-12" style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Tên hoạt động:
                                <input type="text" class="form-control" id="tenhoatdong" name="txtTenHD" style="font-size: 18px; pointer-events: none;">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6" style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Ngày diễn ra:
                                <input type="text" class="form-control" id="Ngaydienra" name="txtNgay" style="font-size: 18px; pointer-events: none;">
                            </p>
                        </div>
                        <div class="col-sm-6" style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Thời gian diễn ra:
                                <input type="text" class="form-control" id="TGdienra" name="txtTG" style="font-size: 18px; pointer-events: none; ">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6" style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Năm học:
                                <input type="text" class="form-control" id="namhoc" name="txtNamhoc" style="font-size: 18px; pointer-events: none; ">
                            </p>
                        </div>
                        <div class="col-sm-6" style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Học kì:
                                <input type="text" class="form-control" id="hocki" name="txthocki" style="font-size: 18px; pointer-events: none; ">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6" style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Khóa tham gia:
                                <input type="text" class="form-control" id="khoathamgia" name="txtkhoa" style="font-size: 18px; pointer-events: none;">
                            </p>
                        </div>
                        <div class="col-sm-6" style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Số lượng:
                                <input type="text" class="form-control" id="soluong" name="txtsoluong" style="font-size: 18px; pointer-events: none; ">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="justify-content: center;display: block;">
                            <p style=" font-size: 18px;">
                                Nội dung:
                                <textarea class="form-control" id="noidung" name="txtNoiDung" style=" font-size: 18px; overflow-y: scroll; resize: none; height: 500px;" rows="3"></textarea>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->

    <!-- chân trang -->
    <div class="jumbotron1 text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>

    <!-- load modal chi tiết -->
    <script>
        $(document).ready(function() {
            $('.smallbtn').on('click', function() {
                $('#mdChitiet').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#mahoatdong').val(data[0]);
                $('#tenhoatdong').val(data[2]);
                $('#Ngaydienra').val(data[1]);
                $('#TGdienra').val(data[3]);
                $('#namhoc').val(data[4]);
                $('#hocki').val(data[5]);
                $('#khoathamgia').val(data[6]);
                $('#soluong').val(data[7]);
                $('#noidung').val(data[8]);
            });
        });
    </script>

</body>

</html>
​