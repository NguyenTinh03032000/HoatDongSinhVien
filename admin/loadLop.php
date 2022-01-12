<?php
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";

$sqlThongTin = "select * from giangvien INNER JOIN khoa ON giangvien.MaKhoa = khoa.MaKhoa where MaGiangVien = '" . $_SESSION['Username'] . "'";
$kqThongTin = mysqli_query($kn, $sqlThongTin) or die("Lỗi truy vấn");
$rowThongTin = mysqli_fetch_array($kqThongTin);

$MaKhoa = $rowThongTin['MaKhoa'];

$key = $_POST['khoa'];

$sql1 = "SELECT * FROM lop INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc 
                            INNER JOIN nganhhoc ON lop.MaNganh = nganhhoc.MaNganh 
                            INNER JOIN khoa ON nganhhoc.MaKhoa =  khoa.MaKhoa 
                            where lop.MaKhoaHoc = '" . $key . "' and nganhhoc.MaKhoa = '" . $MaKhoa . "'";
$kq1 = mysqli_query($kn, $sql1);

while ($row = mysqli_fetch_array($kq1)) {
?>
    <option value="<?php echo htmlspecialchars($row['MaLop']) ?>"><?php echo $row['MaLop'] . ' - ' . $row['TenLop'] ?></option>
<?php
}
?>