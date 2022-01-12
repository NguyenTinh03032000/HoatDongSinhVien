<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hoạt động</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="style/style-VanBan.css">
    <!-- <link rel="stylesheet" href="style/style-DangNhap.css"> -->
    <link rel="stylesheet" href="style/style-Hoatdong.css">
    <link rel="stylesheet" href="style/style-color.css">
    <style>
        .btn {
            margin: 15px 15px;
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
    $txtTenHoatDong = array_key_exists('txtTenHoatDong', $_POST) ?  $_POST['txtTenHoatDong'] : null;
    $cboNamHoc = array_key_exists('cboNamHoc', $_POST) ?  $_POST['cboNamHoc'] : null;
    $cboHocKy = array_key_exists('cboHocKy', $_POST) ?  $_POST['cboHocKy'] : null;
    $cboNamHocL = array_key_exists('cboNamHocL', $_POST) ?  $_POST['cboNamHocL'] : null;
    $cboHocKyL = array_key_exists('cboHocKyL', $_POST) ?  $_POST['cboHocKyL'] : null;
    $cboCapDienRa = array_key_exists('cboCapDienRa', $_POST) ?  $_POST['cboCapDienRa'] : null;
    $dateNgayDienRa = array_key_exists('dateNgayDienRa', $_POST) ?  $_POST['dateNgayDienRa'] : null;
    $ckbKhoaThamGia = array_key_exists('ckbKhoaThamGia', $_POST) ?  $_POST['ckbKhoaThamGia'] : null;
    $txtSoLuong = array_key_exists('txtSoLuong', $_POST) ?  $_POST['txtSoLuong'] : null;
    $txtNoiDung = array_key_exists('txtNoiDung', $_POST) ?  $_POST['txtNoiDung'] : null;
    $cboThoiGianDienRa =  array_key_exists('cboThoiGianDienRa', $_POST) ?  $_POST['cboThoiGianDienRa'] : null;
    //  $File= array_key_exists('File', $_POST) ?  $_POST['File']: null;
    $File = array_key_exists('Filedrive', $_POST) ?  $_POST['Filedrive'] : null;

    $txtTimKiem = array_key_exists('txtTimKiem', $_POST) ?  $_POST['txtTimKiem'] : null;

    $cboNamHoc1 = array_key_exists('cboNamHoc1', $_POST) ?  $_POST['cboNamHoc1'] : null;
    $cboHocKy1 = array_key_exists('cboHocKy1', $_POST) ?  $_POST['cboHocKy1'] : null;
    $cboCapDienRa1 = array_key_exists('cboCapDienRa1', $_POST) ?  $_POST['cboCapDienRa1'] : null;
    $txtMaHoatDong1 = array_key_exists('txtMaHoatDong1', $_POST) ?  $_POST['txtMaHoatDong1'] : null;
    $txtTenHoatDong1 = array_key_exists('txtTenHoatDong1', $_POST) ?  $_POST['txtTenHoatDong1'] : null;
    $dateNgayDienRa1 = array_key_exists('dateNgayDienRa1', $_POST) ?  $_POST['dateNgayDienRa1'] : null;
    $ckbKhoaThamGia1 = array_key_exists('ckbKhoaThamGia1', $_POST) ?  $_POST['ckbKhoaThamGia1'] : null;
    $txtSoLuong1 = array_key_exists('txtSoLuong1', $_POST) ?  $_POST['txtSoLuong1'] : null;
    $txtNoiDung1 = array_key_exists('txtNoiDung1', $_POST) ?  $_POST['txtNoiDung1'] : null;
    $cboThoiGianDienRa1 =  array_key_exists('cboThoiGianDienRa1', $_POST) ?  $_POST['cboThoiGianDienRa1'] : null;
    //  $File1 = array_key_exists('File1', $_POST) ?  $_POST['File1']: null;
    $File1 = array_key_exists('Filedrive1', $_POST) ?  $_POST['Filedrive1'] : null;

    $txtMaHoatDong3 = array_key_exists('txtMaHoatDong3', $_POST) ?  $_POST['txtMaHoatDong3'] : null;
    $txtTenHoatDong3 = array_key_exists('txtTenHoatDong2', $_POST) ?  $_POST['txtTenHoatDong2'] : null;

    $sqlThongTin = "select * from giangvien where MaGiangVien = '" . $_SESSION['Username'] . "'";
    $kqThongTin = mysqli_query($kn, $sqlThongTin) or die("Lỗi truy vấn");
    $rowThongTin = mysqli_fetch_array($kqThongTin);

    // Hàm load danh sách hoạt động
    function loadHD()
    {
        include "bocuc/Connect.php";

        $sqlHD = "select * from hoatdong ORDER BY NgayDienRa DESC";
        $kqHD = mysqli_query($kn, $sqlHD) or die("lỗi truy vấn");
        $stt = 0;
        while ($rowHD = mysqli_fetch_array($kqHD)) {
            $stt = $stt + 1;
            $MaHoatDong = $rowHD['MaHoatDong'];
            $TenHoatDong = $rowHD['TenHoatDong'];
            $NgayDienRa = $rowHD['NgayDienRa'];
            //  $NoiDung = $rowHD['NoiDung'];
            $NamHoc = $rowHD['NamHoc'];
            $HocKy = $rowHD['HocKy'];
            $KhoaThamGia = $rowHD['KhoaThamGia'];
            $SoLuong = $rowHD['SoLuong'];
            $File = $rowHD['File'];
            echo "
                <tr class='hang1'>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $stt . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['MaHoatDong'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['TenHoatDong'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit; width: 125px;'>" . $rowHD['NgayDienRa'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['ThoiGianDienRa'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['CapDienRa'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit; width: 110px;'>" . $rowHD['NamHoc'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['HocKy'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['NoiDung'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['KhoaThamGia'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['SoLuong'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['File'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link chitietbtn' data-toggle='modal' data-target='#chitietModal' style='margin: 0 0;'><i class='fas fa-info-circle'></i></a></td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link editbtn' data-toggle='modal' data-target='#editModal' style='margin: 0 0;'><i class='fas fa-edit'></i></a></td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link xoabtn' data-toggle='modal' data-target='#xoaModal' style='margin: 0 0;'><i class='fas fa-trash-alt'></i></a></td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link' href='DSDangKyHD.php?ma=$MaHoatDong'><i class='far fa-list-alt'></i></a></td>
                    </tr>";
        }
    }

    //  Hàm thêm hoạt động

    function themHD($txtTenHoatDong, $dateNgayDienRa, $cboThoiGianDienRa, $txtNoiDung, $cboNamHoc, $cboHocKy, $cboCapDienRa, $ckbKhoaThamGia, $txtSoLuong, $File)
    {
        include "bocuc/Connect.php";

        $sqlKiemTra = "select * from hoatdong where TenHoatDong = '" . $txtTenHoatDong . "' 
                                                    and NgayDienRa = '" . $dateNgayDienRa . "' 
                                                    and NamHoc = '" . $cboNamHoc . "' 
                                                    and HocKy = '" . $cboHocKy . "' 
                                                    and CapDienRa = '" . $cboCapDienRa . "'";
        $kqKiemTra = mysqli_query($kn, $sqlKiemTra) or die("lỗi truy vấn");

        if ($rowKiemTra = mysqli_fetch_array($kqKiemTra)) {
            $TenHoatDong_1 = $rowKiemTra['TenHoatDong'];
            $NamHoc_1 = $rowKiemTra['NamHoc'];
            $HocKy_1 = $rowKiemTra['HocKy'];

            echo '<script>alert("Hoạt động: ' . $TenHoatDong_1 . ' trong Năm học: ' . $NamHoc_1 . ' và Học kỳ: ' . $HocKy_1 . ' đã có trong hệ thống!");</script>';
        } else {
            if ($txtTenHoatDong == "") {
                echo "<script>alert('Không được bỏ trống thông tin tên hoạt động !!!');</script>";
            } elseif ($dateNgayDienRa == "") {
                echo "<script>alert('Không được bỏ trống thông tin ngày diễn ra hoạt động !!!');</script>";
            } elseif ($cboNamHoc == "") {
                echo "<script>alert('Không được bỏ trống thông tin năm học diễn ra hoạt động !!!');</script>";
            } elseif ($cboHocKy == "") {
                echo "<script>alert('Không được bỏ trống thông tin học kỳ diễn ra hoạt động !!!');</script>";
            } elseif ($cboCapDienRa == "") {
                echo "<script>alert('Không được bỏ trống thông tin cấp diễn ra hoạt động !!!');</script>";
            } else {
                $khoahoc = "";
                foreach ($_POST['ckbKhoaThamGia'] as $khoaThamGia) {
                    $khoahoc = $khoahoc . " - " . $khoaThamGia;
                }
                $khoahoc = substr($khoahoc, 3);
                $sql2 = "insert into hoatdong(TenHoatDong, NgayDienRa, ThoiGianDienRa, NoiDung, NamHoc, HocKy, CapDienRa, KhoaThamGia, SoLuong, File)
                            values('" . $txtTenHoatDong . "', '" . $dateNgayDienRa . "','" . $cboThoiGianDienRa . "', '" . $txtNoiDung . "', '" . $cboNamHoc . "', '" . $cboHocKy . "', '" . $cboCapDienRa . "', '" . $khoahoc . "', '" . $txtSoLuong . "', '" . $File . "')";
                $kq2 = mysqli_query($kn, $sql2) or die("lỗi truy vấn");

                echo '<meta http-equiv="refresh" content="0">';
                echo "<script>alert('Thêm thành công');</script>";
            }
        }
    }

    // function TimKiem($txtTimKiem, $MaKhoa)
    // {
    //     include "bocuc/Connect.php";

    //     $sql = "select * from hoatdong where (MaHoatDong like '%$txtTimKiem%' or TenHoatDong like '%$txtTimKiem%' or NamHoc like '%$txtTimKiem%' or HocKy like '%$txtTimKiem%' or KhoaThamGia like '%$txtTimKiem%') and MaKhoa = '" . $MaKhoa . "' ORDER BY NgayDienRa DESC";
    //     $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

    //     $stt = 0;

    //     while ($rowHD = mysqli_fetch_array($kq)) {
    //         $stt = $stt + 1;
    //         $MaHoatDong = $rowHD['MaHoatDong'];
    //         // $TenHoatDong = $rowHD['TenHoatDong'];
    //         // $NoiDung = $rowHD['NoiDung']
    //         // $NamHoc = $rowHD['NamHoc'];
    //         // $HocKy = $rowHD['HocKy'];
    //         // $KhoaThamGia = $rowHD['KhoaThamGia']
    //         echo "
    //             <tr class='hang1'>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $stt . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['MaHoatDong'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['TenHoatDong'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit; width: 125px;'>" . $rowHD['NgayDienRa'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['ThoiGianDienRa'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['CapDienRa'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit; width: 110px;'>" . $rowHD['NamHoc'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['HocKy'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['NoiDung'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['KhoaThamGia'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['SoLuong'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['File'] . "</td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link chitietbtn' data-toggle='modal' data-target='#chitietModal' style='margin: 0 0;'>chi tiết</a></td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link editbtn' data-toggle='modal' data-target='#editModal' style='margin: 0 0;'><i class='fas fa-edit'></i></a></td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link xoabtn' data-toggle='modal' data-target='#xoaModal' style='margin: 0 0;'><i class='fas fa-trash-alt'></i></a></td>
    //             <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link' href='DSDangKyHD.php?ma=$MaHoatDong&khoa=$MaKhoa'><i class='far fa-list-alt'></i></a></td>
    //             </tr>";
    //     }
    // }

    function LocDuLieu($cboNamHocL, $cboHocKyL)
    {
        include "bocuc/Connect.php";

        if ($cboHocKyL == "" and $cboNamHocL == "") {
            echo '<script>alert("Bạn cần chọn thông tin lọc");</script> ';
        } else {
            if ($cboHocKyL == "") {
                $sql = "select * from hoatdong where NamHoc = '" . $cboNamHocL . "' ORDER BY NgayDienRa DESC";
            } elseif ($cboNamHocL == "") {
                $sql = "select * from hoatdong where HocKy = '" . $cboHocKyL . "' ORDER BY NgayDienRa DESC";
            } else {
                $sql = "select * from hoatdong where NamHoc = '" . $cboNamHocL . "' and HocKy = '" . $cboHocKyL . "' ORDER BY NgayDienRa DESC";
            }
            $kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

            $stt = 0;

            while ($rowHD = mysqli_fetch_array($kq)) {
                $stt = $stt + 1;
                $MaHoatDong = $rowHD['MaHoatDong'];
                // $TenHoatDong = $rowHD['TenHoatDong'];
                // $NoiDung = $rowHD['NoiDung']
                // $NamHoc = $rowHD['NamHoc'];
                // $HocKy = $rowHD['HocKy'];
                // $KhoaThamGia = $rowHD['KhoaThamGia']
                echo "
                    <tr class='hang1'>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $stt . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['MaHoatDong'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['TenHoatDong'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit; width: 125px;'>" . $rowHD['NgayDienRa'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['ThoiGianDienRa'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['CapDienRa'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit; width: 110px;'>" . $rowHD['NamHoc'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['HocKy'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['NoiDung'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['KhoaThamGia'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'>" . $rowHD['SoLuong'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;' hidden>" . $rowHD['File'] . "</td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link chitietbtn' data-toggle='modal' data-target='#chitietModal' style='margin: 0 0;'><i class='fas fa-info-circle'></i></a></td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link editbtn' data-toggle='modal' data-target='#editModal' style='margin: 0 0;'><i class='fas fa-edit'></i></a></td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link xoabtn' data-toggle='modal' data-target='#xoaModal' style='margin: 0 0;'><i class='fas fa-trash-alt'></i></a></td>
                    <td class='cot' style='text-align: center; vertical-align: inherit;'><a class='btn btn-link' href='DSDangKyHD.php?ma=$MaHoatDong'><i class='far fa-list-alt'></i></a></td>
                    </tr>";
            }
        }
    }

    function CapNhatHD($txtMaHoatDong1, $txtTenHoatDong1, $dateNgayDienRa1, $cboThoiGianDienRa1, $txtNoiDung1, $cboNamHoc1, $cboHocKy1, $cboCapDienRa1, $ckbKhoaThamGia1, $txtSoLuong1, $File1)
    {
        include "bocuc/Connect.php";

        $khoahoc = "";
        foreach ($_POST['ckbKhoaThamGia1'] as $khoaThamGia) {
            $khoahoc = $khoahoc . " - " . $khoaThamGia;
        }
        $khoahoc = substr($khoahoc, 3);

        $sql1 = "update hoatdong set TenHoatDong = '" . $txtTenHoatDong1 . "', 
                                        NgayDienRa = '" . $dateNgayDienRa1 . "',
                                        ThoiGianDienRa = '" . $cboThoiGianDienRa1 . "', 
                                        NoiDung = '" . $txtNoiDung1 . "', 
                                        NamHoc = '" . $cboNamHoc1 . "', 
                                        HocKy = '" . $cboHocKy1 . "',
                                        CapDienRa = '" . $cboCapDienRa1 . "',
                                        KhoaThamGia = '" . $khoahoc . "', 
                                        SoLuong = '" . $txtSoLuong1 . "',
                                        File = '" . $File1 . "'
                     where MaHoatDong = '" . $txtMaHoatDong1 . "'";
        $kq1 = mysqli_query($kn, $sql1) or die("lỗi truy vấn");

        echo '<meta http-equiv="refresh" content="0">';
        echo "<script>alert('Cập nhật thành công');</script>";
    }

    function xoaHD($txtMaHoatDong3)
    {
        include "bocuc/Connect.php";

        $sql1 = "delete from hoatdong where MaHoatDong = '" . $txtMaHoatDong3 . "'";
        $kq1 = mysqli_query($kn, $sql1) or die("lỗi truy vấn");

        echo '<meta http-equiv="refresh" content="0">';
        echo "<script>alert('Xóa thành công');</script>";
    }

    function lammoi()
    {
        echo '<meta http-equiv="refresh" content="0"> ';
    }

    ?>

    <body>
        <!-- top đầu trang -->
        <div class="jumbotron1 text-center" style="margin-bottom:0;  padding: 20px;">

            <?php load_top(); ?>

        </div>

        <!-- menu của trang / menu user 1 -->
        <?php load_menu_admin_1(); ?>

        <div class="container-fluid" style="margin-top:30px;">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <?php
                    if ($user) {
                    ?>
                        <form action="" method="POST">
                            <div>
                                <h3 style="text-align: center">DANH SÁCH CÁC HOẠT ĐỘNG</h3>
                                <hr>
                                <!-- Phần tìm kiếm, lọc dữ liệu -->
                                <div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" id="myInput" name="txtTimKiem" placeholder="Nhập nội dung cần cần tìm" aria-label="Search">
                                        </div>
                                        <div class="col-lg-2">
                                            <button class="btn btn-primary-all btn-block" type="button" data-toggle="modal" data-target="#addModal">Thêm mới</button>
                                        </div>
                                        <div class="col-lg-2">
                                            <button class="btn btn-primary-all btn-block" type="submit" name="btnLamMoi">Làm mới</button>
                                        </div>
                                        <!-- <div class="col-sm-7" style="justify-content: center;display: flex;">
                                            <input class="form-control" type="text" id="myInput" name="txtTimKiem" placeholder="Nhập nội dung cần cần tìm" aria-label="Search">
                                        </div>
                                        <div class="col-sm-5" style="justify-content: center;display: flex;">
                                            <button class="btn btn-primary-all" type="submit" name="btnTimKiem">Tìm kiếm</button>
                                            <button class="btn btn-primary-all" type="button" data-toggle="modal" data-target="#addModal">Thêm mới</button>
                                            <button class="btn btn-primary-all" type="submit" name="btnLamMoi">Làm mới</button>
                                        </div> -->
                                    </div>
                                    <div class="row border">
                                        <div class="col-sm-2" style="justify-content: center;display: flex; margin:auto">
                                            <span>Lọc theo:</span>
                                        </div>
                                        <div class="col-sm-3" style="justify-content: center;display: flex;">
                                            <select name="cboNamHocL" class="form-control" id="cboNamHocL">
                                                <option value="" selected="selected">--Chọn năm học--</option>
                                                <?php
                                                $date = getdate();
                                                $nammoi = $date['year'] + 3;
                                                $namcu = $date['year'] - 4;
                                                while ($namcu < $nammoi) {
                                                    $nam1 = ($namcu) . "-" . ($namcu + 1);
                                                    echo "<option value='$nam1'>$nam1</option>";
                                                    $namcu++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3" style="justify-content: center;display: flex;">
                                            <select name="cboHocKyL" class="form-control" id="cboHocKyL">
                                                <option value="" selected="selected">--Chọn học kỳ--</option>
                                                <option value="1">Học kỳ 1</option>
                                                <option value="2">Học kỳ 2</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2" style="justify-content: center;display: flex;">
                                            <button class="btn btn-secondary" type="submit" name="btnLoc">Lọc dữ liệu</button>
                                        </div>
                                        <div class="col-sm-2" style="justify-content: center;display: flex;">
                                        </div>
                                    </div>
                                </div>
                                <!-- Kết thúc phần tìm kiếm -->

                                <!-- CÁC MODAL -->

                                <!-- modal thêm  -->
                                <div class="modal fade" id="addModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Thêm hoạt động</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <p style="color: red;">**Lưu ý: Nhập đầy đủ thông tin cần thiết trước khi lưu thông tin.</p>
                                                <div class="row">
                                                    <div class="col-sm-12" style="justify-content: center; display: block;">
                                                        <p>Tên hoạt động:</p>
                                                        <input type="text" class="form-control" id="tenhoatdong" name="txtTenHoatDong" style="font-size: 18px;">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6" style="justify-content: center; display: block;">
                                                        <p>Ngày diễn ra</p>
                                                        <input type="date" class="form-control" id="ngaydienra" name="dateNgayDienRa">
                                                    </div>

                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Thời gian</p>
                                                        <!-- <input type="text" class="form-control" id="thoigian" name="txtThoiGianDR"> -->
                                                        <select name="cboThoiGianDienRa" class="form-control" id="cboThoiGianDienRa">
                                                            <option value="" selected="selected">--Chọn thời gian--</option>
                                                            <?php
                                                            $thoigian = array(
                                                                "00:00", "00:30", "01:00", "01:30", "02:00", "02:30",
                                                                "03:00", "03:30", "04:00", "04:30", "05:00", "05:30",
                                                                "06:00", "06:30", "07:00", "07:30", "08:00", "08:30",
                                                                "09:00", "09:30", "10:00", "10:30", "11:00", "11:30",
                                                                "12:00", "12:30", "13:00", "13:30", "14:00", "14:30",
                                                                "15:00", "15:30", "16:00", "16:30", "17:00", "17:30",
                                                                "18:00", "18:30", "19:00", "19:30", "20:00", "20:30",
                                                                "21:00", "21:30", "22:00", "22:30", "23:00", "23:30"
                                                            );
                                                            foreach ($thoigian as $tg) {
                                                            ?>
                                                                <option value="<?php echo $tg ?>"><?php echo $tg ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Chọn năm học</p>
                                                        <select name="cboNamHoc" class="form-control" id="cboNamHoc">
                                                            <option value="" selected="selected">--Chọn năm học--</option>
                                                            <?php
                                                            $date = getdate();
                                                            $nammoi = $date['year'] + 3;
                                                            $namcu = $date['year'] - 4;
                                                            while ($namcu < $nammoi) {
                                                                $nam1 = ($namcu) . "-" . ($namcu + 1);
                                                                echo "<option value='$nam1'>$nam1</option>";
                                                                $namcu++;
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Chọn học kỳ</p>
                                                        <select name="cboHocKy" class="form-control" id="cboHocKy">
                                                            <option value="" selected="selected">--Chọn học kỳ--</option>
                                                            <option value="1">Học kỳ 1</option>
                                                            <option value="2">Học kỳ 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Chọn cấp diễn ra</p>
                                                        <select name="cboCapDienRa" class="form-control" id="cboCapDienRa">
                                                            <option value="" selected="selected">-- Chọn cấp diễn ra --</option>
                                                            <option value="CAPTINH">CAPTINH - Cấp tỉnh</option>
                                                            <option value="CAPTRUONG">CAPTRUONG - Cấp trường</option>
                                                            <option value="CAPKHOA">CAPKHOA - Cấp khoa</option>
                                                            <option value="CAPLOP">CAPLOP - Cấp lớp</option>
                                                            <option value="HIENMAU">HIENMAU - Hiến máu</option>
                                                            <option value="TN1">TN1 - Tình nguyện (Mùa hè xanh, tiếp sức mùa thi, ...)</option>
                                                            <option value="TN2">TN2 - Tình nguyện tại chỗ</option>
                                                            <option value="DIEUDONG">DIEUDONG - Huy động lực lượng cấp khoa trở lên</option>
                                                            <option value="HT_CAPTINH">HT_CAPTINH - Học thuật cấp tỉnh</option>
                                                            <option value="HT_CAPTRUONG">HT_CAPTRUONG - Học thuật cấp trường</option>
                                                            <option value="HT_CAPKHOA">HT_CAPKHOA - Học thuật cấp khoa</option>
                                                            <option value="HT_CAPLOP">HT_CAPLOP - Học thuật cấp lớp</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Khóa tham gia</p>
                                                        <!-- <input type="text" class="form-control" id="khoathamgia" name="txtKhoaThamGia" style="font-size: 18px;"> -->
                                                        <?php
                                                        $sql_KhoaThamGia_1 = "select * from khoahoc limit 5";
                                                        $kq_KhoaThamGia_1 = mysqli_query($kn, $sql_KhoaThamGia_1) or die("lỗi truy vấn");

                                                        while ($row_KhoaThamGia_1 = mysqli_fetch_array($kq_KhoaThamGia_1)) {
                                                        ?>

                                                            <div class='form-check-inline'>
                                                                <label class='form-check-label'>
                                                                    <input type='checkbox' class='form-check-input' id='khoathamgia' checked value='<?php echo $row_KhoaThamGia_1['MaKhoaHoc'] ?>' name='ckbKhoaThamGia[]'><?php echo $row_KhoaThamGia_1['MaKhoaHoc'] ?>
                                                                </label>
                                                            </div>

                                                        <?php
                                                        }
                                                        ?>
                                                        <p style="color: red;">Vui lòng chọn khóa tham gia.</p>
                                                    </div>
                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Số lượng</p>
                                                        <input type="number" min="0" max="10000" class="form-control" id="soluong" name="txtSoLuong" style="font-size: 18px;" value="0">
                                                        <p style="color: red;">Nhập số lượng tham gia từ 0 trở lên.</p>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                                        <p>Link drive</p>
                                                        <input type="text" class="form-control" id="file" name="Filedrive" style="font-size: 18px;">
                                                        <!-- <input type="text" class="form-control" id="file" name="File" style="font-size: 18px;" > -->
                                                    </div>
                                                </div>
                                                <div>
                                                    <p>Nội dung</p>
                                                    <textarea class="form-control" name="txtNoiDung" id="noidung" cols="40" rows="6" style="font-size: 18px;"></textarea>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class=" modal-footer">
                                                <button class="btn btn-primary-all" type="submit" name="btnThem">Thêm mới</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->

                                <!-- Modal cập nhật-->
                                <div class="modal fade" id="editModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div>
                                                    <h4 class="modal-title" style="text-align: left;">Chỉnh sửa hoạt động</h4>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Mã hoạt động:</p>
                                                        <input type="text" class="form-control" id="mahoatdong1" name="txtMaHoatDong1" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Ngày diễn ra</p>
                                                        <input type="date" class="form-control" name="dateNgayDienRa1" id="ngaydienra1">
                                                    </div>
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Thời gian</p>
                                                        <!-- <input type="text" class="form-control" id="thoigian1" name="txtThoiGianDR1"> -->
                                                        <select name="cboThoiGianDienRa1" class="form-control" id="thoigian1">
                                                            <option value="" selected="selected">--Chọn thời gian--</option>
                                                            <?php
                                                            $thoigian_1 = array(
                                                                "00:00", "00:30", "01:00", "01:30", "02:00", "02:30",
                                                                "03:00", "03:30", "04:00", "04:30", "05:00", "05:30",
                                                                "06:00", "06:30", "07:00", "07:30", "08:00", "08:30",
                                                                "09:00", "09:30", "10:00", "10:30", "11:00", "11:30",
                                                                "12:00", "12:30", "13:00", "13:30", "14:00", "14:30",
                                                                "15:00", "15:30", "16:00", "16:30", "17:00", "17:30",
                                                                "18:00", "18:30", "19:00", "19:30", "20:00", "20:30",
                                                                "21:00", "21:30", "22:00", "22:30", "23:00", "23:30"
                                                            );
                                                            foreach ($thoigian_1 as $tg) {
                                                            ?>
                                                                <option value="<?php echo $tg ?>"><?php echo $tg ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                                        <p>Tên hoạt động:</p>
                                                        <input type="text" class="form-control" id="tenhoatdong1" name="txtTenHoatDong1" style="font-size: 18px;">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Chọn năm học</p>
                                                        <select name="cboNamHoc1" class="form-control" id="cbonamhoc1">
                                                            <option value="" selected="selected">--Chọn năm học--</option>
                                                            <?php
                                                            $date = getdate();
                                                            $nammoi = $date['year'] + 3;
                                                            $namcu = $date['year'] - 4;
                                                            while ($namcu < $nammoi) {
                                                                $nam1 = ($namcu) . "-" . ($namcu + 1);
                                                                echo "<option value='$nam1'>$nam1</option>";
                                                                $namcu++;
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Chọn học kỳ</p>
                                                        <select name="cboHocKy1" class="form-control" id="cbohocky1">
                                                            <option value="" selected="selected">--Chọn học kỳ--</option>
                                                            <option value="1">Học kỳ 1</option>
                                                            <option value="2">Học kỳ 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Chọn cấp</p>
                                                        <select name="cboCapDienRa1" class="form-control" id="cbocapdienra1">
                                                            <option value="" selected="selected">-- Chọn cấp diễn ra --</option>
                                                            <option value="CAPTINH">CAPTINH - Cấp tỉnh</option>
                                                            <option value="CAPTRUONG">CAPTRUONG - Cấp trường</option>
                                                            <option value="CAPKHOA">CAPKHOA - Cấp khoa</option>
                                                            <option value="CAPLOP">CAPLOP - Cấp lớp</option>
                                                            <option value="HIENMAU">HIENMAU - Hiến máu</option>
                                                            <option value="TN1">TN1 - Tình nguyện (Mùa hè xanh, tiếp sức mùa thi, ...)</option>
                                                            <option value="TN2">TN2 - Tình nguyện tại chỗ</option>
                                                            <option value="DIEUDONG">DIEUDONG - Huy động lực lượng cấp khoa trở lên</option>
                                                            <option value="HT_CAPTINH">HT_CAPTINH - Học thuật cấp tỉnh</option>
                                                            <option value="HT_CAPTRUONG">HT_CAPTRUONG - Học thuật cấp trường</option>
                                                            <option value="HT_CAPKHOA">HT_CAPKHOA - Học thuật cấp khoa</option>
                                                            <option value="HT_CAPLOP">HT_CAPLOP - Học thuật cấp lớp</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Khóa tham gia</p>
                                                        <!-- <input type="text" class="form-control" id="khoathamgia1" name="txtKhoaThamGia1" style="font-size: 18px;"> -->
                                                        <?php
                                                        $sql_KhoaThamGia_2 = "select * from khoahoc limit 5";
                                                        $kq_KhoaThamGia_2 = mysqli_query($kn, $sql_KhoaThamGia_2) or die("lỗi truy vấn");

                                                        while ($row_KhoaThamGia_2 = mysqli_fetch_array($kq_KhoaThamGia_2)) {
                                                        ?>
                                                            <div class='form-check-inline'>
                                                                <label class='form-check-label'>
                                                                    <input type='checkbox' class='form-check-input khoathamgia1' value='<?php echo $row_KhoaThamGia_2['MaKhoaHoc'] ?>' name='ckbKhoaThamGia1[]'><?php echo $row_KhoaThamGia_2['MaKhoaHoc'] ?>
                                                                </label>
                                                            </div>

                                                        <?php
                                                        }
                                                        ?>
                                                        <p style="color: red;">Vui lòng chọn khóa tham gia.</p>
                                                    </div>
                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Số lượng</p>
                                                        <input type="text" class="form-control" id="soluong1" name="txtSoLuong1" style="font-size: 18px;">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                                        <p>Link drive</p>
                                                        <input type="text" class="form-control" id="file1" name="Filedrive1" style="font-size: 18px;">
                                                        <!-- <input type="text" class="form-control" id="file1" name="File1" style="font-size: 18px;" > -->
                                                    </div>
                                                </div>
                                                <div>
                                                    <p>Nội dung</p>
                                                    <textarea class="form-control" name="txtNoiDung1" id="noidung1" cols="40" rows="6" style="font-size: 18px;"></textarea>
                                                </div>

                                                <br>
                                                <!-- <button class="btn btn-primary" type="submit" name="btnCapNhat">Cập nhật</button> -->
                                                <button type="submit" class="btn btn-primary-all btn-block" id="btnCapNhat" name="btnCapNhat" value="btnCapNhat" style="margin: 0 0;">Cập nhật</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->

                                <!-- Modal xem chi tiết  -->
                                <div class="modal fade" id="chitietModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div>
                                                    <h4 class="modal-title" style="text-align: left;">Xem chi tiết hoạt động</h4>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                                        <p>Tên hoạt động:</p>
                                                        <input type="text" class="form-control" id="tenhoatdong2" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Ngày diễn ra</p>
                                                        <input type="date" class="form-control" id="ngaydienra2" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Thời gian</p>
                                                        <input type="text" class="form-control" id="thoigian2" name="txtThoiGianDR2" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Năm học</p>
                                                        <input type="text" class="form-control" id="namhoc2" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Học kỳ</p>
                                                        <input type="text" class="form-control" id="hocky2" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                    <div class="col-sm-4" style="justify-content: center;display: block;">
                                                        <p>Cấp diễn ra</p>
                                                        <input type="text" class="form-control" id="capdienra2" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Khóa tham gia</p>
                                                        <input type="text" class="form-control" id="khoathamgia2" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                    <div class="col-sm-6" style="justify-content: center;display: block;">
                                                        <p>Số lượng</p>
                                                        <input type="text" class="form-control" id="soluong2" style="font-size: 18px; pointer-events: none;">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12" style="justify-content: center;display: block;">
                                                        <p>Link drive</p>
                                                        <input type="text" class="form-control" id="file2" name="Filedrive2" style="font-size: 18px;">
                                                        <!-- <input type="text" class="form-control" id="file2" name="File2" style="font-size: 18px;" > -->
                                                    </div>
                                                </div>
                                                <div>
                                                    <p>Nội dung</p>
                                                    <textarea class="form-control" id="noidung2" cols="40" rows="6" style="font-size: 18px;  pointer-events: none;"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->
                                <!-- modal xóa -->
                                <div class="modal fade" id="xoaModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <div>
                                                    <h4 class="modal-title" style="text-align: left;">Xóa hoạt động</h4>
                                                </div>

                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-sm-12" style="justify-content: center;display: block;">
                                                            <input type="text" class="form-control" name="txtMaHoatDong3" id="mahoatdong3" hidden style="font-size: 18px; pointer-events: none;">
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
                                <!-- end modal -->

                                <!-- Phần load danh sách -->
                                <div style="width: 100%">
                                    <br>
                                    <div id="tbsv3">
                                        <table class="table table-bordered table-hover" style="width: 100%; text-align: center; vertical-align: inherit;" id="bangthongtin">
                                            <thead>
                                                <tr class="hang1">
                                                    <th class="textDS" style="vertical-align: inherit;">STT</th>
                                                    <th class="textDS" style="vertical-align: inherit;" hidden>Mã hoạt động</th>
                                                    <th class="textDS" style="vertical-align: inherit;">Tên hoạt động</th>
                                                    <th class="textDS" style="vertical-align: inherit;">Ngày diễn ra</th>
                                                    <th class="textDS" style="vertical-align: inherit;" hidden>Thời gian</th>
                                                    <th Class="textDS" style="vertical-align: inherit;">Cấp diễn ra</th>
                                                    <th class="textDS" style="vertical-align: inherit;">Năm học</th>
                                                    <th class="textDS" style="vertical-align: inherit;">Học kỳ</th>
                                                    <th class="textDS" style="vertical-align: inherit;" hidden>Nội dung</th>
                                                    <th class="textDS" style="vertical-align: inherit;">Khóa tham gia</th>
                                                    <th class="textDS" style="vertical-align: inherit;">Số lượng</th>
                                                    <th class="textDS" style="vertical-align: inherit;" hidden>File</th>
                                                    <th class="textDS" style="vertical-align: inherit; width: 50px;">Chi tiết</th>
                                                    <th class="textDS" style="vertical-align: inherit; width: 50px;">Chỉnh sửa</th>
                                                    <th class="textDS" style="vertical-align: inherit; width: 50px;">Xóa</th>
                                                    <th class="textDS" style="vertical-align: inherit; width: 50px;">Xem danh sách</th>
                                                </tr>
                                            </thead>
                                            <tbody id="myTable">
                                                <?php
                                                if ($_POST) {
                                                    if (isset($_POST['btnThem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                        themHD($txtTenHoatDong, $dateNgayDienRa, $cboThoiGianDienRa, $txtNoiDung, $cboNamHoc, $cboHocKy, $cboCapDienRa, $ckbKhoaThamGia, $txtSoLuong, $File);
                                                        loadHD();
                                                    }
                                                    if (isset($_POST['btnLamMoi']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                        loadHD();
                                                    }
                                                    if (isset($_POST['btnCapNhat']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                        CapNhatHD($txtMaHoatDong1, $txtTenHoatDong1, $dateNgayDienRa1, $cboThoiGianDienRa1, $txtNoiDung1, $cboNamHoc1, $cboHocKy1, $cboCapDienRa1, $ckbKhoaThamGia1, $txtSoLuong1, $File1);
                                                        loadHD();
                                                    }
                                                    // if (isset($_POST['btnTimKiem']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                    //     TimKiem($txtTimKiem, $MaKhoa);
                                                    // }
                                                    if (isset($_POST['btnLoc']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                        LocDuLieu($cboNamHocL, $cboHocKyL);
                                                    }
                                                    if (isset($_POST['btnXoa']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                        XoaHD($txtMaHoatDong3);
                                                        loadHD();
                                                    }
                                                    // if (isset($_POST['btnLamMoi']) and $_SERVER['REQUEST_METHOD'] == "POST") {
                                                    //     lammoi();
                                                    // }
                                                } else {
                                                    loadHD();
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End load Ddnh sách -->
                                <!-- END -->
                            </div>

                            <br>

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
        <script>
            // Gọi modal cập nhật 
            $(document).ready(function() {
                $('.editbtn').on('click', function() {
                    $('#editModal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    var khoathamgia = data[9];

                    if (khoathamgia.length <= 3) {
                        var khoa1 = data[9].substring(0, 3);
                        $('.khoathamgia1').val([khoa1]);
                    } else if (khoathamgia.length > 3 && khoathamgia.length <= 9) {
                        var khoa1 = data[9].substring(0, 3);
                        var khoa2 = data[9].substring(6, 9);
                        $('.khoathamgia1').val([khoa1, khoa2]);
                    } else if (khoathamgia.length > 9 && khoathamgia.length <= 15) {
                        var khoa1 = data[9].substring(0, 3);
                        var khoa2 = data[9].substring(6, 9);
                        var khoa3 = data[9].substring(12, 15);
                        $('.khoathamgia1').val([khoa1, khoa2, khoa3]);
                    } else if (khoathamgia.length > 15 && khoathamgia.length <= 21) {
                        var khoa1 = data[9].substring(0, 3);
                        var khoa2 = data[9].substring(6, 9);
                        var khoa3 = data[9].substring(12, 15);
                        var khoa4 = data[9].substring(18, 21);
                        $('.khoathamgia1').val([khoa1, khoa2, khoa3, khoa4]);
                    } else {
                        var khoa1 = data[9].substring(0, 3);
                        var khoa2 = data[9].substring(6, 9);
                        var khoa3 = data[9].substring(12, 15);
                        var khoa4 = data[9].substring(18, 21);
                        var khoa5 = data[9].substring(24, 27);
                        $('.khoathamgia1').val([khoa1, khoa2, khoa3, khoa4, khoa5]);
                    }

                    console.log(data);
                    $('#mahoatdong1').val(data[1]);
                    $('#tenhoatdong1').val(data[2]);
                    $('#ngaydienra1').val(data[3]);
                    $('#thoigian1').val(data[4]);
                    $('#cbocapdienra1').val(data[5]);
                    $('#cbonamhoc1').val(data[6]);
                    $('#cbohocky1').val(data[7]);
                    $('#noidung1').val(data[8]);
                    // $('#khoathamgia1').val(data[9]);
                    $('#soluong1').val(data[10]);
                    $('#file1').val(data[11]);
                });
            });

            // Gọi modal xem chi tiết 
            $(document).ready(function() {
                $('.chitietbtn').on('click', function() {
                    $('#chitietModal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);
                    $('#tenhoatdong2').val(data[2]);
                    $('#ngaydienra2').val(data[3]);
                    $('#thoigian2').val(data[4]);
                    $('#capdienra2').val(data[5]);
                    $('#namhoc2').val(data[6]);
                    $('#hocky2').val(data[7]);
                    $('#noidung2').val(data[8]);
                    $('#khoathamgia2').val(data[9]);
                    $('#soluong2').val(data[10]);
                    $('#file2').val(data[11]);

                });
            });

            //Gọi modal xóa
            $(document).ready(function() {
                $('.xoabtn').on('click', function() {
                    $('#xoaModal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);
                    $('#mahoatdong3').val(data[1]);
                    $('#tenhoatdong3').val(data[2]);
                });
            });


            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>

        <div class="jumbotron1 text-center" style="margin-bottom:0">

            <?php load_footer(); ?>

        </div>
    </body>

</html>