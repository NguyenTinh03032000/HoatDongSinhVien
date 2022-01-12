<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng ký hoạt động</title>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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

            <div class="col-sm-12">
                <?php
                if ($user) {
                ?>
                    <form action="" method="POST">
                        <h2 style="text-align: center">ĐĂNG KÝ HOẠT ĐỘNG SINH VIÊN</h2>
                        <hr>

                        <div class="row">
                            <?php
                            $MaSV = $_SESSION['Username'];

                            $sqlThongTin = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop 
                                                INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc  
                                                where MaSinhVien='" . $_SESSION['Username'] . "'";
                            $kqThongTin = mysqli_query($kn, $sqlThongTin);
                            $row = mysqli_fetch_array($kqThongTin);

                            $today = date("Y-m-d");

                            $sql1 = "SELECT * FROM hoatdong where NgayDienRa > '" . $today . "' ORDER BY NgayDienRa DESC";
                            $kq1 = mysqli_query($kn, $sql1);
                            $stt = 0;
                            while ($row = mysqli_fetch_array($kq1)) {
                                $stt = $stt + 1;
                                $MaHD = $row['MaHoatDong'];
                            ?>
                                <div class="col-lg-3" style="margin-bottom: 15px">
                                    <div class="card" style="width:350px">
                                        <img class="card-img-top" src="image/anh3.jpg" alt="Card image" style="width:100%">
                                        <div class="card-body">
                                            <h5 class="card-title" style="text-align: center"><?php echo $row['TenHoatDong']; ?></h5>
                                            <hr>
                                            <p class="card-text">Ngày diễn ra: <?php echo htmlspecialchars(date_format(date_create($row['NgayDienRa']), "d-m-Y")); ?></p>
                                            <p>Năm học: <?php echo $row['NamHoc']; ?> <-> Học kỳ: <?php echo $row['HocKy']; ?></p>
                                            <p>Đối tượng: <?php echo $row['KhoaThamGia']; ?></p>

                                            <div class="row">
                                                <?php
                                                $sqlKiemTra = "select * from dangkyhoatdong where MaHoatDong = '" . $MaHD . "' and MaSinhVien = '" . $MaSV . "'";
                                                $kqKiemTra = mysqli_query($kn, $sqlKiemTra);
                                                $rowKiemTra = mysqli_fetch_array($kqKiemTra);

                                                if (isset($rowKiemTra['MaHoatDong']) or isset($rowKiemTra['MaSinhVien'])) {
                                                    echo '
                                                    <div class="col-lg-12">
                                                        <div class="alert alert-info" style="margin: 0;">
                                                            <h6 style="text-align: center;">Hoạt động đã đăng ký</h6>
                                                        </div>
                                                    </div>
                                                    ';
                                                } else {
                                                    echo '
                                                    <div class="col-lg-6">
                                                        <button type="button" data-toggle="modal" data-target="#mdChitiet' . $row['MaHoatDong'] . '" class="btn btn-info btn-block" style="margin: 5px;">CHI TIẾT</button>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <button type="submit" class="btn btn-primary btn-block" style="margin: 5px;" name="btnDangKy_1" value="' . $row['MaHoatDong'] . '">ĐĂNG KÝ</button>
                                                    </div>
                                                    ';
                                                }
                                                ?>

                                            </div>
                                        </div>

                                        <!-- MODAL CHI TIẾT, CHỈNH SỬA -->
                                        <div class="modal fade" id="mdChitiet<?php echo $row['MaHoatDong']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="mdChitietLabel" aria-hidden="true">
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
                                                                    <input type="text" class="form-control" id="tenhoatdong" name="txtTenHD" style="font-size: 18px; pointer-events: none;" value="<?php echo $row['TenHoatDong']; ?>">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                <p style=" font-size: 18px;">
                                                                    Ngày diễn ra:
                                                                    <input type="text" class="form-control" id="Ngaydienra" name="txtNgay" style="font-size: 18px; pointer-events: none;" value="<?php echo htmlspecialchars(date_format(date_create($row['NgayDienRa']), "d-m-Y")); ?>">
                                                                </p>
                                                            </div>
                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                <p style=" font-size: 18px;">
                                                                    Thời gian diễn ra:
                                                                    <input type="text" class="form-control" id="TGdienra" name="txtTG" style="font-size: 18px; pointer-events: none;" value="<?php echo $row['ThoiGianDienRa']; ?>">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                <p style=" font-size: 18px;">
                                                                    Năm học:
                                                                    <input type="text" class="form-control" id="namhoc" name="txtNamhoc" style="font-size: 18px; pointer-events: none;" value="<?php echo $row['NamHoc']; ?>">
                                                                </p>
                                                            </div>
                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                <p style=" font-size: 18px;">
                                                                    Học kì:
                                                                    <input type="text" class="form-control" id="hocki" name="txthocki" style="font-size: 18px; pointer-events: none;" value="<?php echo $row['HocKy']; ?>">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                <p style=" font-size: 18px;">
                                                                    Khóa tham gia:
                                                                    <input type="text" class="form-control" id="khoathamgia" name="txtkhoa" style="font-size: 18px; pointer-events: none;" value="<?php echo $row['KhoaThamGia']; ?>">
                                                                </p>
                                                            </div>
                                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                                <p style=" font-size: 18px;">
                                                                    Số lượng:
                                                                    <input type="text" class="form-control" id="soluong" name="txtsoluong" style="font-size: 18px; pointer-events: none;" value="<?php echo $row['SoLuong']; ?>">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12" style="justify-content: center;display: block;">
                                                                <p style=" font-size: 18px;">
                                                                    Nội dung:
                                                                    <textarea class="form-control" id="noidung" name="txtNoiDung" style=" font-size: 18px; overflow-y: scroll; resize: none; height: 500px;" rows="3"><?php echo $row['NoiDung']; ?></textarea>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary-all" name="btnDangKy_2" value="<?php echo $row['MaHoatDong']; ?>"><span>Đăng ký</span></button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END MODAL -->

                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                    </form>
                <?php
                } else {
                    include "loadDangNhapUser.php";
                }
                ?>
                <br>
            </div>

        </div>
    </div>

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
                $('#tenhoatdong').val(data[2].trim());
                $('#Ngaydienra').val(data[3].trim());
                $('#TGdienra').val(data[4].trim());
                $('#namhoc').val(data[5].trim());
                $('#hocki').val(data[6].trim());
                $('#khoathamgia').val(data[7].trim());
                $('#soluong').val(data[8].trim());
                $('#noidung').val(data[9].trim());
            });
        });
    </script>

</body>

</html>

<?php
$txtmahoatdong_1 = array_key_exists('btnDangKy_1', $_POST) ?  $_POST['btnDangKy_1'] : null;
$txtmahoatdong_2 = array_key_exists('btnDangKy_2', $_POST) ?  $_POST['btnDangKy_2'] : null;

function DangKyHoatDong_1($MaSV, $txtmahoatdong_1)
{
    include "bocuc/Connect.php";

    $ktra = "select MaSinhVien, MaHoatDong from dangkyhoatdong where MaSinhVien = '" . $MaSV . "' and MaHoatDong = '" . $txtmahoatdong_1 . "'";
    $kq = mysqli_query($kn, $ktra) or die("Lỗi truy vấn");


    if ($row1 = mysqli_fetch_array($kq)) {
        echo "<script>alert('Hoạt động đã được đăng ký trên hệ thống trước đó!');</script>";
    } else {
        $sql1 = "insert into dangkyhoatdong (MaHoatDong, MaSinhVien, ThamGia) values ('$txtmahoatdong_1','$MaSV', N'Đăng ký')";
        $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
        echo "<script>alert('Đăng ký thành công');</script>";
    }
    echo '<meta http-equiv="refresh" content="0">';
}

function DangKyHoatDong_2($MaSV, $txtmahoatdong_2)
{
    include "bocuc/Connect.php";

    $ktra = "select MaSinhVien, MaHoatDong from dangkyhoatdong where MaSinhVien = '" . $MaSV . "' and MaHoatDong = '" . $txtmahoatdong_2 . "'";
    $kq = mysqli_query($kn, $ktra) or die("Lỗi truy vấn");


    if ($row1 = mysqli_fetch_array($kq)) {
        echo "<script>alert('Hoạt động đã được đăng ký trên hệ thống trước đó!');</script>";
    } else {
        $sql1 = "insert into dangkyhoatdong (MaHoatDong, MaSinhVien, ThamGia) values ('$txtmahoatdong_2','$MaSV', N'Đăng ký')";
        $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
        echo "<script>alert('Đăng ký thành công');</script>";
    }
    echo '<meta http-equiv="refresh" content="0">';
}

if ($_POST) {
    if (isset($_POST['btnDangKy_1']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        DangKyHoatDong_1($MaSV, $txtmahoatdong_1);
    }
    if (isset($_POST['btnDangKy_2']) and $_SERVER['REQUEST_METHOD'] == "POST") {
        DangKyHoatDong_2($MaSV, $txtmahoatdong_2);
    }
}
?>
​