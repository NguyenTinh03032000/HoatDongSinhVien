<?php
include "bocuc/Connect.php";

date_default_timezone_set('Asia/Ho_Chi_Minh');
$date = getdate();
$nam = $date['year'];
$namketthuc = $nam + 7;

$sqlKhoaHoc = "SELECT * FROM khoahoc ORDER BY NamBatDau DESC LIMIT 1";
$kqKhoaHoc = mysqli_query($kn, $sqlKhoaHoc);
$rowKhoaHoc = mysqli_fetch_array($kqKhoaHoc);

$arrKhoaHoc = explode("K", $rowKhoaHoc['MaKhoaHoc']);
$maKhoaHoc = array_pop($arrKhoaHoc) + 1;

// echo $maKhoaHoc;

$sqlKiemTra = "SELECT * FROM khoahoc WHERE NamBatDau = '$nam' ";
$kqKiemTra = mysqli_query($kn, $sqlKiemTra);
$rowKiemTra = mysqli_fetch_array($kqKiemTra);

if ($rowKiemTra['NamBatDau'] != $nam) {
    $sql = "insert into khoahoc (MaKhoaHoc, NamBatDau, NamKetThuc) values ('K" . $maKhoaHoc . "', '$nam', '$namketthuc')";
    $kq = mysqli_query($kn, $sql);
    // echo 'Thành công';
}
// else {
//     echo 'Tồn tại';
// }


?>

<div style="display: flex; justify-content: center;">
    <img src="image/logo1.png" class="rounded">
    <div style="margin-bottom: auto; margin-top: auto;">
        <h1 style="font-size:3vw">QUẢN LÝ HOẠT ĐỘNG SINH VIÊN</h1>
    </div>
</div>

<style>
    h1 {
        margin: auto;
    }

    .rounded {
        max-width: 10%;
        height: auto;
        margin-right: 2%;
        margin-bottom: auto;
        margin-top: auto;
    }

    div>.chanchung {
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }
</style>