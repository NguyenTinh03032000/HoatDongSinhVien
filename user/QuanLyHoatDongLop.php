<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
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

<?php
$cboNamHoc = array_key_exists('cboNamHoc', $_POST) ? $_POST['cboNamHoc'] : null;
$cboHocKy = array_key_exists('cboHocKy', $_POST) ? $_POST['cboHocKy'] : null;

function loadDL()
{
    include "bocuc/Connect.php";

    $sql2 = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop 
                                    INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc 
                                    where sinhvien.MaSinhVien = '" . $_SESSION['Username'] . "'";
    $kq2 = mysqli_query($kn, $sql2);
    $row2 = mysqli_fetch_array($kq2);

    $MaLop = $row2['MaLop'];

    $today = date("Y-m-d");

    $phantrang = "SELECT * FROM hoatdong ORDER BY NgayDienRa DESC";
    $kqpt = mysqli_query($kn, $phantrang) or die("Lỗi truy vấn phân trang");

    $stt = 0;

    while ($row = mysqli_fetch_array($kqpt)) {
        $stt = $stt + 1;
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
                        <div class="col-lg-12">
                            <a href="quanlysinhvienDKHDlop.php?mahd=' . $MaHD . '&malop=' . $MaLop . '" class="btn btn-info btn-block" style="margin-top: 10px;">CHI TIẾT >></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
}

function LocDL($cboNamHoc, $cboHocKy)
{
    include "bocuc/Connect.php";

    $sql2 = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop 
                                    INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc 
                                    where sinhvien.MaSinhVien = '" . $_SESSION['Username'] . "'";
    $kq2 = mysqli_query($kn, $sql2);
    $row2 = mysqli_fetch_array($kq2);

    $MaLop = $row2['MaLop'];

    if ($cboHocKy == "") {
        $phantrang = "SELECT * FROM hoatdong where NamHoc = '" . $cboNamHoc . "' ORDER BY NgayDienRa DESC";
    } elseif ($cboNamHoc == "") {
        $phantrang = "SELECT * FROM hoatdong where HocKy = '" . $cboHocKy . "' ORDER BY NgayDienRa DESC";
    } else {
        $phantrang = "SELECT * FROM hoatdong where NamHoc = '" . $cboNamHoc . "' and HocKy = '" . $cboHocKy . "' ORDER BY NgayDienRa DESC";
    }

    $kqpt = mysqli_query($kn, $phantrang) or die("Lỗi truy vấn phân trang");

    $stt = 0;

    while ($row = mysqli_fetch_array($kqpt)) {
        $stt = $stt + 1;

        $MaHD = $row['MaHoatDong'];

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
                            <div class="col-lg-12">
                                <a href="quanlysinhvienDKHDlop.php?mahd=' . $MaHD . '&malop=' . $MaLop . '" class="btn btn-info btn-block" style="margin-top: 10px;">CHI TIẾT >></a>
                            </div>
                        </div>
                    </div>
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
        <?php
        if ($user) {
        ?>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-sm-1"></div>

                    <div class="col-sm-10">
                        <?php
                        $sql1 = "select * from sinhvien 
                                INNER JOIN lop ON sinhvien.MaLop = lop.MaLop 
                                INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc 
                                where sinhvien.MaSinhVien = '" . $_SESSION['Username'] . "'";
                        $kq1 = mysqli_query($kn, $sql1);
                        $row = mysqli_fetch_array($kq1);

                        $MaLop = $row['MaLop'];
                        ?>
                        <h2 style="text-align: center">QUẢN LÝ ĐĂNG KÝ HOẠT ĐỘNG SINH VIÊN</h2>
                        <h4 style="text-align: center">Lớp: <?php echo $row['TenLop'] ?></h4>
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
                                <button class="btn btn-primary-all  btn-block" type="submit" name="btnLoc" value="btnLoc" style="margin: 5px 0;">Lọc dữ liệu</button>
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

                    </div>

                    <div class="col-sm-1"></div>
                </div>
            </form>
        <?php
        } else {
            include "loadDangNhapUser.php";
        }
        ?>
        <br>
    </div>

    <!-- chân trang -->
    <div class="jumbotron1 text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>

</body>

</html>
​