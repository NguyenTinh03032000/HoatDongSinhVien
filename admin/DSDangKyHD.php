<!DOCTYPE html>
<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";

$MaHoatDong = $_GET['ma'];

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đăng ký</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <link rel="stylesheet" href="style/style-Hoatdong.css">
    <link rel="stylesheet" href="style/style-color.css">
    <style>
        .btn {
            margin: 15px 15px;
        }

        .btn1 {
            margin: 15px 15px;
            width: 100px;

        }

        .form-control {
            margin: 15px 0;
        }

        #tbsv3 {
            /* border:5px solid none; */
            max-width: 1200px;
            width: 100%;
            overflow: auto;
            overflow: scroll;
            height: 700px;
            margin: 10px auto;
        }
    </style>
</head>

<body>

    <?php
    $txtTimKiem = array_key_exists('txtTimKiem', $_POST) ?  $_POST['txtTimKiem'] : null;
    $txtMaSinhVien1 = array_key_exists('txtMaSinhVien1', $_POST) ?  $_POST['txtMaSinhVien1'] : null;
    $txtMaHoatDong1 = array_key_exists('txtMaHoatDong1', $_POST) ?  $_POST['txtMaHoatDong1'] : null;
    $txtMaSinhVien2 = array_key_exists('txtMaSinhVien2', $_POST) ?  $_POST['txtMaSinhVien2'] : null;
    $txtMaHoatDong2 = array_key_exists('txtMaHoatDong2', $_POST) ?  $_POST['txtMaHoatDong2'] : null;
    $cboTinhTrang = array_key_exists('cboTinhTrang', $_POST) ?  $_POST['cboTinhTrang'] : null;


    function loadDS()
    {
        include "bocuc/Connect.php";

        $MaHoatDong = $_GET['ma'];

        $sqlHD = "SELECT * from dangkyhoatdong INNER JOIN hoatdong on dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong 
                                INNER JOIN sinhvien on dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien 
                                INNER JOIN lop on sinhvien.MaLop = lop.MaLop 
                                WHERE dangkyhoatdong.MaHoatDong= '" . $MaHoatDong . "'";
        $kqHD = mysqli_query($kn, $sqlHD) or die("lỗi truy vấn");
        $stt = 0;

        echo "  <tr class='hang1'>
                <th class='textDS'>STT</th>
                <th class='textDS' hidden>Mã hoạt động</th>
                <th class='textDS'>Mã sinh viên</th>
                <th class='textDS'>Tên sinh viên</th>
                <th class='textDS'>Lớp</th>
                <th class='textDS'>Tình trạng</th>
                <th class='textDS'>Chỉnh sửa</th>
                <th class='textDS'>Xóa</th>
            </tr>";

        while ($rowHD = mysqli_fetch_array($kqHD)) {
            $stt = $stt + 1;
            $MaHoatDong = $rowHD['MaHoatDong'];
            $masinhvien = $rowHD['MaSinhVien'];
            $TenHoatDong = $rowHD['MaSinhVien'];
            $TenSinhVien = $rowHD['HoTen'];
            $Lop = $rowHD['TenLop'];
            $NgayDienRa = $rowHD['ThamGia'];

            echo "
                <tr class='hang1' id='thongtin'>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $stt . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['MaHoatDong'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['MaSinhVien'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['HoTen'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['TenLop'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['ThamGia'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link editbtn' data-toggle='modal' data-target='#editModal' style='margin: 0 0;'><i class='fas fa-edit'></i></a></td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link xoabtn' data-toggle='modal' data-target='#xoaModal' style='margin: 0 0;'><i class='fas fa-trash-alt'></i></a></td>
                    </tr>";
        }
    }

    function loadDS1()
    {
        include "bocuc/Connect.php";

        $MaHoatDong = $_GET['ma'];

        $sqlHD = "SELECT * from dangkyhoatdong INNER JOIN hoatdong on dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong 
                        INNER JOIN sinhvien on dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien INNER JOIN lop on sinhvien.MaLop = lop.MaLop WHERE dangkyhoatdong.MaHoatDong= '" . $MaHoatDong . "'";
        $kqHD = mysqli_query($kn, $sqlHD) or die("lỗi truy vấn");
        $stt = 0;

        echo "<tr class='hang1'>
                <th class='textDS'>Chọn</th>
                <th class='textDS'>STT</th>
                <th class='textDS' hidden>Mã hoạt động</th>
                <th class='textDS'>Mã sinh viên</th>
                <th class='textDS'>Tên sinh viên</th>
                <th class='textDS'>Lớp</th>
                <th class='textDS'>Tình trạng</th>
            </tr>";

        while ($rowHD = mysqli_fetch_array($kqHD)) {
            $stt = $stt + 1;
            $MaHoatDong = $rowHD['MaHoatDong'];
            $masinhvien = $rowHD['MaSinhVien'];
            $TenHoatDong = $rowHD['TenHoatDong'];
            $TenSinhVien = $rowHD['HoTen'];
            $Lop = $rowHD['TenLop'];
            $NgayDienRa = $rowHD['ThamGia'];

            echo "
                <tr class='hang1' id='thongtin'>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><input type='checkbox' style='margin: auto; text-align: center; display: block;' name='mangthamgia[]' value = $masinhvien></td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $stt . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['MaHoatDong'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['MaSinhVien'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['HoTen'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['TenLop'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['ThamGia'] . "</td>
                    </tr>";
        }
        echo "<tr> <td Colspan='8'> <button class='btn btn1 btn-primary-all' type='submit' name='btnThamGia' >Tham Gia
                <button class='btn btn-primary-all' type='submit' name='btnKhongThamGia' >Không tham gia</button>
                <button class='btn btn1 btn-primary-all' type='submit' name='btnXoa1' >Xóa</button> </td> </tr>";
    }

    // function TimKiem($txtTimKiem)
    // {
    //     include "bocuc/Connect.php";

    //     $MaHoatDong = $_GET['ma'];

    //     $sqlHD = "SELECT * from dangkyhoatdong INNER JOIN hoatdong on dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong 
    //                     INNER JOIN sinhvien on dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien INNER JOIN lop on sinhvien.MaLop = lop.MaLop WHERE dangkyhoatdong.MaHoatDong= '" . $MaHoatDong . "'
    //                     and (sinhvien.MaSinhVien = '%$txtTimKiem%' or sinhvien.HoTen like '%$txtTimKiem%' or lop.TenLop like '%$txtTimKiem%' or dangkyhoatdong.ThamGia like '%$txtTimKiem%')";
    //     $kqHD = mysqli_query($kn, $sqlHD) or die("lỗi truy vấn");

    //     $stt = 0;

    //     echo "<tr class='hang1'>
    //             <th class='textDS'>STT</th>
    //             <th class='textDS' hidden>Mã hoạt động</th>
    //             <th class='textDS'>Mã sinh viên</th>
    //             <th class='textDS'>Tên sinh viên</th>
    //             <th class='textDS'>Lớp</th>
    //             <th class='textDS'>Tình trạng</th>
    //             <th class='textDS'>Chỉnh sửa</th>
    //             <th class='textDS'>Xóa</th>
    //         </tr>";

    //     while ($rowHD = mysqli_fetch_array($kqHD)) {
    //         $stt = $stt + 1;
    //         // $MaHoatDong = $rowHD['MaHoatDong'];
    //         // $TenHoatDong = $rowHD['MaSinhVien'];
    //         // $TenSinhVien = $rowHD['HoTen'];
    //         // $Lop = $rowHD['TenLop'];
    //         // $NgayDienRa = $rowHD['ThamGia'];

    //         echo "<tr class='hang1' id='thongtin'>
    //                 <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $stt . "</td>
    //                 <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['MaHoatDong'] . "</td>
    //                 <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['MaSinhVien'] . "</td>
    //                 <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['HoTen'] . "</td>
    //                 <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['TenLop'] . "</td>
    //                 <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['ThamGia'] . "</td>
    //                 <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link editbtn' data-toggle='modal' data-target='#editModal' style='margin: 0 0;'><i class='fas fa-edit'></i></a></td>
    //                 <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link xoabtn' data-toggle='modal' data-target='#xoaModal' style='margin: 0 0;'><i class='fas fa-trash-alt'></i></a></td>
    //             </tr>";
    //     }
    // }

    function Xoa($txtMaHoatDong1, $txtMaSinhVien1)
    {
        include "bocuc/Connect.php";

        $sql1 = "delete from dangkyhoatdong where MaHoatDong = '" . $txtMaHoatDong1 . "' and MaSinhVien = '" . $txtMaSinhVien1 . "'";
        $kq1 = mysqli_query($kn, $sql1) or die("lỗi truy vấn");

        echo "<script>alert('Xóa thành công');</script>";
    }

    function CapNhat($txtMaHoatDong2, $txtMaSinhVien2, $cboTinhTrang)
    {
        include "bocuc/Connect.php";

        $sql1 = "update dangkyhoatdong set ThamGia = '" . $cboTinhTrang . "'                                       
                     where MaHoatDong = '" . $txtMaHoatDong2 . "' and MaSinhVien = '" . $txtMaSinhVien2 . "'";
        $kq1 = mysqli_query($kn, $sql1) or die("lỗi truy vấn");

        echo "<script>alert('Cập nhật thành công');</script>";
    }

    function LamMoi()
    {
        echo '<meta http-equiv="refresh" content="0"> ';
    }

    ?>
    <!-- top đầu trang -->
    <div class="jumbotron1 text-center" style="margin-bottom:0;  padding: 20px;">

        <?php load_top(); ?>

    </div>

    <!-- menu của trang / menu user 1 -->
    <?php load_menu_admin_1(); ?>

    <?php
    $MaHoatDong = $_GET['ma'];

    $sql2 = "select * from hoatdong where MaHoatDong = '" . $MaHoatDong . "'";
    $kq2 = mysqli_query($kn, $sql2);
    $row2 = mysqli_fetch_array($kq2);
    ?>

    <div class="container-fluid" style="margin-top:30px;">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?php
                if ($user) {
                ?>
                    <form action="" method="POST">
                        <div>
                            <h3 style="text-align: center">DANH SÁCH ĐĂNG KÝ HOẠT ĐỘNG</h3>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 border border-primary" style="padding: 10px;">
                                    <h5><small>Hoạt động: <?php echo $row2['TenHoatDong'] ?></small></h5>
                                    <h5><small>Ngày diễn ra: <?php echo htmlspecialchars(date_format(date_create($row2['NgayDienRa']), "d-m-Y")); ?></small></h5>
                                    <h5><small>Năm học: <?php echo $row2['NamHoc'] ?> - Học kỳ: <?php echo $row2['HocKy'] ?></small></h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input class="form-control" type="text" id="myInput" name="txtTimKiem" placeholder="Nhập nội dung cần cần tìm" aria-label="Search" autocomplete="off">
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-primary-all btn-block" type="submit" name="btnLamMoi">Làm mới</button>
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-primary-all btn-block" type="submit" name="btnChon" id="btnchon">Chọn</button>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-primary-all btn-block" data-toggle="modal" data-target="#myModalIn" name="btnIn" id="btnIn">Xuất danh sách</button>
                                </div>
                                <!-- <div class="col-sm-6" style="justify-content: center;display: flex;">
                                    <input class="form-control" type="text" id="myInput" name="txtTimKiem" placeholder="Nhập nội dung cần cần tìm" aria-label="Search" autocomplete="off">
                                </div>
                                <div class="col-sm-6" style="justify-content: center;display: flex;">
                                    <button class="btn btn-primary-all" type="submit" name="btnTimKiem">Tìm kiếm</button>
                                    <button class="btn btn-primary-all" type="submit" name="btnLamMoi">Làm mới</button>
                                    <button class="btn btn-primary-all" type="submit" name="btnChon" id="btnchon">Chọn</button>
                                    <button type="button" class="btn btn-primary-all" data-toggle="modal" data-target="#myModalIn" name="btnIn" id="btnIn">Xuất danh sách</button>
                                </div> -->
                            </div>
                        </div>

                        <!-- load danh sách -->

                        <div style="width: 100%; height: 500px; overflow-y: scroll;" class="table-responsive">
                            <div class="tbsv3" class="table-responsive">
                                <table class="table table-bordered table-hover" style="width: 100%; text-align: center; vertical-align: inherit;" id="bangthongtin">
                                    <!-- <thead>
                                    <tr class="hang1">
                                        <th class="textDS">STT</th>
                                        <th class="textDS" hidden>Mã hoạt động</th>
                                        <th class="textDS">Mã sinh viên</th>
                                        <th class="textDS">Tên sinh viên</th>
                                        <th class="textDS">Lớp</th>
                                        <th class="textDS">Tình trạng</th>
                                        <th class="textDS">Chỉnh sửa</th>
                                        <th class="textDS">Xóa</th>
                                    </tr>
                                </thead> -->
                                    <tbody id="myTable">
                                        <?php
                                        if ($_POST) {
                                            // if(isset($_POST['btnThem']) and $_SERVER['REQUEST_METHOD'] == "POST"){
                                            //     themHD($txtTenHoatDong, $dateNgayDienRa, $txtNoiDung,$cboNamHoc, $cboHocKy, $txtKhoaThamGia, $txtSoLuong);
                                            //     loadHD();
                                            // }
                                            if (isset($_POST['btnLamMoi']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                loadDS();
                                            }
                                            if (isset($_POST['btnChon']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                loadDS1();
                                            }
                                            if (isset($_POST['btnCapNhat']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                CapNhat($txtMaHoatDong2, $txtMaSinhVien2, $cboTinhTrang);
                                                loadDS();
                                            }
                                            // if (isset($_POST['btnTimKiem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                            //     TimKiem($txtTimKiem);
                                            // }
                                            if (isset($_POST['btnXoa']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                Xoa($txtMaHoatDong1, $txtMaSinhVien1);
                                                loadDS();
                                            }
                                        } else {
                                            loadDS();
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end load danh sách -->
                        <br>

                        <!-- Modal Xóa -->
                        <div class="modal fade" id="xoaModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <!-- <div>
                                            <h4 class="modal-title" style="text-align: left;">Xóa</h4>
                                        </div> -->

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div>
                                            <div class="row">
                                                <div class="col-sm-6" style="justify-content: center;display: block;">
                                                    <input type="text" class="form-control" name="txtMaHoatDong1" id="mahoatdong1" hidden style="font-size: 18px; pointer-events: none;">
                                                </div>
                                                <div class="col-sm-6" style="justify-content: center;display: block;">
                                                    <input type="text" class="form-control" name="txtMaSinhVien1" id="masinhvien1" hidden style="font-size: 18px; pointer-events: none;">
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-sm-12" style="justify-content: center;display: block;">
                                                    <p>Hoạt động: </p>
                                                    <input type="text" class="form-control" name="txtTenHoatDong3" id="tenhoatdong3" style="font-size: 18px; pointer-events: none;">
                                                </div>
                                            </div> -->
                                            <h4>Bạn chắc chắn muốn xóa thông tin này không?</h4>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button class="btn btn-primary-all" type="submit" name="btnXoa">Xóa</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                        <!-- Modal cập nhật -->
                        <div class="modal fade" id="editModal">
                            <div class="modal-dialog modal-lg" style="display:flex; justify-content: center;">
                                <div class="modal-content" style="width:350px;">

                                    <div class="modal-header">
                                        <div>
                                            <h4 class="modal-title" style="text-align: left;">Chỉnh sửa</h4>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <input type="text" class="form-control" name="txtMaHoatDong2" id="mahoatdong2" hidden style="font-size: 18px; pointer-events: none;">
                                            </div>
                                            <div class="col-sm-6" style="justify-content: center;display: block;">
                                                <input type="text" class="form-control" name="txtMaSinhVien2" id="masinhvien2" hidden style="font-size: 18px; pointer-events: none;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" style="justify-content: center;display: block;">
                                                <p>Tình trạng</p>
                                                <select name="cboTinhTrang" class="form-control" id="cbotinhtrang">
                                                    <!-- <option value="" selected="selected">--Chọn tình trạng--</option> -->
                                                    <option value="Không tham gia">Không tham gia</option>
                                                    <option value="Tham gia">Tham gia</option>
                                                </select>
                                            </div>
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-primary-all btn-block" id="btnCapNhat" name="btnCapNhat" value="btnCapNhat" style="margin: 0 0;">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End -->
                    </form>

                    <form action="exportHoatDongAdmin.php" method="post">

                        <!-- MODAL IN-->
                        <div class="modal fade" id="myModalIn">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Xuất danh sách tham gia</h5>
                                        <button type="button" class="btn" data-dismiss="modal" style="margin: 0px;"><b>X</b></button>
                                    </div>
                                    <div class="modal-body" style="display: flex; justify-content: center;margin-right:10px; margin-top:7px">
                                        <table hidden>
                                            <tr>
                                                <td><input type="text" name="txtMaKhoaIn" value="<?php echo $MaKhoa ?>"></td>
                                                <td><input type="text" name="txtMaHoatDongIn" value="<?php echo $MaHoatDong ?>"></td>
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
    <div class="jumbotron1 text-center" style="margin-bottom:0">

        <?php load_footer(); ?>

    </div>
</body>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable #thongtin").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    // Gọi modal xóa
    $(document).ready(function() {
        $('.xoabtn').on('click', function() {
            $('#xoaModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#mahoatdong1').val(data[1]);
            $('#masinhvien1').val(data[2]);
        });
    });

    // Gọi modal cập nhật 
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
            $('#mahoatdong2').val(data[1]);
            $('#masinhvien2').val(data[2]);
            $('#cbotinhtrang').val(data[5]);
        });
    });
</script>
<?php
if (isset($_POST['btnThamGia'])) {
    if (isset($_POST['mangthamgia'])) {
        foreach ($_POST['mangthamgia'] as $maSinhVienThamGia) {
            $sql1 = "update dangkyhoatdong set ThamGia = 'Tham gia' where MaSinhVien ='" . $maSinhVienThamGia . "' and MaHoatDong = '" . $MaHoatDong . "'";
            $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
        }
        echo '<meta http-equiv="refresh" content="0">';
        echo '<script> alert("Cập nhật thông tin thành công");</script>';
    } else {
        echo '<meta http-equiv="refresh" content="0">';
        echo '<script> alert("Chưa chọn thông tin");</script>';
    }
}

if (isset($_POST['btnKhongThamGia'])) {
    if (isset($_POST['mangthamgia'])) {
        foreach ($_POST['mangthamgia'] as $maSinhVienThamGia) {
            $sql1 = "update dangkyhoatdong set ThamGia = 'Không tham gia' where MaSinhVien ='" . $maSinhVienThamGia . "' and MaHoatDong = '" . $MaHoatDong . "'";
            $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
        }
        echo '<meta http-equiv="refresh" content="0">';
        echo '<script> alert("Cập nhật thông tin thành công");</script>';
    } else {
        echo '<meta http-equiv="refresh" content="0">';
        echo '<script> alert("Chưa chọn thông tin");</script>';
    }
}

if (isset($_POST['btnXoa1'])) {
    if (isset($_POST['mangthamgia'])) {
        foreach ($_POST['mangthamgia'] as $maxoaSV) {
            $sql1 = "delete from dangkyhoatdong where MaSinhVien ='" . $maxoaSV . "' and MaHoatDong = '" . $MaHoatDong . "'";
            $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
        }
    }
    echo '<meta http-equiv="refresh" content="0">';
    echo '<script> alert("Xóa thành công");</script>';
}
?>

</html>