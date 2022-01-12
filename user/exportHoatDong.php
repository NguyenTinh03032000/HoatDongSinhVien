<?php
ob_start();
require 'site.php';
include "bocuc/Connect.php";
include "bocuc/KiemTraSession.php";
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use \PhpOffice\PhpSpreadsheet\Calculation\Statistical\Conditional;

$mahd = $_POST['txtMaHoatDong'];
$malop = $_POST['txtMaLop'];

$sql1 = "select * from sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop INNER JOIN khoahoc ON lop.MaKhoaHoc = khoahoc.MaKhoaHoc where lop.MaLop = '" . $malop . "'";
$kq1 = mysqli_query($kn, $sql1);
$row = mysqli_fetch_array($kq1);

$sql2 = "select * from hoatdong where MaHoatDong = '" . $mahd . "'";
$kq2 = mysqli_query($kn, $sql2);
$row2 = mysqli_fetch_array($kq2);

$tenhoatdong = "Hoạt động " . $row2['TenHoatDong'] . " - " . $row['TenLop'];

$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
$hamExcel = new Conditional();

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();


$styleArray = [
    'font' => [
        'bold' => true,
    ],
];

// Tạo viền
$styleArray_Border = array(
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'left' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'right' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ]
    ],
);

// Kiểu chữ và kích cỡ chữ
$spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
$spreadsheet->getDefaultStyle()->getFont()->setSize(12);

$tieude = $tenhoatdong;

$activeSheet->setCellValue('A1', $tieude);

$activeSheet->mergeCells('A1:G1');

$activeSheet->getStyle('A1')->getAlignment()->setWrapText(true);

$activeSheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$activeSheet->getStyle('A1')->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

$activeSheet->getStyle('A1')->applyFromArray($styleArray);

$activeSheet->setCellValue('A3', 'STT');
$activeSheet->setCellValue('B3', 'Mã sinh viên');
$activeSheet->setCellValue('C3', 'Họ');
$activeSheet->setCellValue('D3', 'Tên');
$activeSheet->setCellValue('E3', 'Lớp');
$activeSheet->setCellValue('F3', 'Tham gia');
$activeSheet->setCellValue('G3', 'Ghi chú');

// In đậm từ A2 đến G2
$activeSheet->getStyle('A3:G3')->applyFromArray($styleArray);

$activeSheet->getStyle('A3:G3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$activeSheet->getStyle('A3:G3')->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

$activeSheet->getStyle('A3:G3')->getAlignment()->setWrapText(true);

// Chiều dài cột
$activeSheet->getColumnDimension('A')->setWidth(26, 'pt');
$activeSheet->getColumnDimension('B')->setWidth(65, 'pt');
$activeSheet->getColumnDimension('C')->setAutoSize(TRUE);
$activeSheet->getColumnDimension('D')->setAutoSize(TRUE);
$activeSheet->getColumnDimension('E')->setAutoSize(TRUE);
$activeSheet->getColumnDimension('F')->setAutoSize(TRUE);
$activeSheet->getColumnDimension('G')->setWidth(60, 'pt');

// Chỉnh chiều cao của hàng
$activeSheet->getRowDimension('1')->setRowHeight(30);
$activeSheet->getRowDimension('2')->setRowHeight(30);
$activeSheet->getRowDimension('3')->setRowHeight(20);

// Tạo viền
$activeSheet->getStyle('A3')->applyFromArray($styleArray_Border);
$activeSheet->getStyle('B3')->applyFromArray($styleArray_Border);
$activeSheet->getStyle('C3')->applyFromArray($styleArray_Border);
$activeSheet->getStyle('D3')->applyFromArray($styleArray_Border);
$activeSheet->getStyle('E3')->applyFromArray($styleArray_Border);
$activeSheet->getStyle('F3')->applyFromArray($styleArray_Border);
$activeSheet->getStyle('G3')->applyFromArray($styleArray_Border);

// $truyvan = mysqli_query($kn, "SELECT * FROM dangkyhoatdong INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong
//                         INNER JOIN sinhvien ON dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien 
//                         INNER JOIN lop ON sinhvien.MaLop = lop.MaLop
//                         WHERE hoatdong.MaHoatDong = '" . $mahd . "' and lop.MaLop = '" . $malop . "'");

$truyvan = mysqli_query($kn, "SELECT * FROM sinhvien INNER JOIN lop ON sinhvien.MaLop = lop.MaLop WHERE lop.MaLop = '" . $malop . "'");

$stt = 0;
$count = 3;

while ($rowtruyvan = mysqli_fetch_array($truyvan)) {
    $count++;
    $stt = $stt + 1;

    $hoten = explode(" ", $rowtruyvan['HoTen']);
    $ho = array_shift($hoten);
    $ten = array_pop($hoten);
    $holot = implode(" ", $hoten);

    $ho = $ho . " " . $holot;

    $thamgia = mysqli_query($kn, "SELECT * FROM dangkyhoatdong INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong
                        INNER JOIN sinhvien ON dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien 
                        INNER JOIN lop ON sinhvien.MaLop = lop.MaLop
                        WHERE hoatdong.MaHoatDong = '" . $mahd . "' and lop.MaLop = '" . $malop . "' and sinhvien.MaSinhVien = '" . $rowtruyvan["MaSinhVien"] . "' and dangkyhoatdong.ThamGia = 'Tham gia'");

    $rowthamgia = mysqli_fetch_array($thamgia);

    if (isset($rowthamgia['ThamGia'])) {
        $kq_thamgia = "x";
    } else {
        $kq_thamgia = "";
    }

    $activeSheet->setCellValue('A' . $count, $stt);
    $activeSheet->setCellValue('B' . $count, $rowtruyvan["MaSinhVien"]);
    $activeSheet->setCellValue('C' . $count, $ho);
    $activeSheet->setCellValue('D' . $count, $ten);
    $activeSheet->setCellValue('E' . $count, $rowtruyvan["TenLop"]);
    $activeSheet->setCellValue('F' . $count, $kq_thamgia);
    $activeSheet->setCellValue('G' . $count, "");

    $activeSheet->getStyle('A' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('A' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('B' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('B' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('C' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('D' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('E' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('F' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('F' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('G' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

    // Tạo viền
    $activeSheet->getStyle('A' . $count)->applyFromArray($styleArray_Border);
    $activeSheet->getStyle('B' . $count)->applyFromArray($styleArray_Border);
    $activeSheet->getStyle('C' . $count)->applyFromArray($styleArray_Border);
    $activeSheet->getStyle('D' . $count)->applyFromArray($styleArray_Border);
    $activeSheet->getStyle('E' . $count)->applyFromArray($styleArray_Border);
    $activeSheet->getStyle('F' . $count)->applyFromArray($styleArray_Border);
    $activeSheet->getStyle('G' . $count)->applyFromArray($styleArray_Border);

    // Chỉnh chiều cao của hàng
    $activeSheet->getRowDimension($count)->setRowHeight(18);

    // In đậm
    $activeSheet->getStyle('F' . $count)->applyFromArray($styleArray);
}

$tongthamgia = mysqli_query($kn, "SELECT count(dangkyhoatdong.MaSinhVien) as dem FROM dangkyhoatdong INNER JOIN hoatdong ON dangkyhoatdong.MaHoatDong = hoatdong.MaHoatDong
                        INNER JOIN sinhvien ON dangkyhoatdong.MaSinhVien = sinhvien.MaSinhVien 
                        INNER JOIN lop ON sinhvien.MaLop = lop.MaLop
                        WHERE hoatdong.MaHoatDong = '" . $mahd . "' and lop.MaLop = '" . $malop . "' and dangkyhoatdong.ThamGia = 'Tham gia'");

$rowtongthamgia = mysqli_fetch_array($tongthamgia);

$activeSheet->setCellValue('A2', 'Năm học: ' . $row2['NamHoc'] . ' - Học kỳ: ' . $row2['HocKy']);
//Gộp cột
$activeSheet->mergeCells('A2:C2');

$activeSheet->getStyle('A2')->applyFromArray($styleArray);

$activeSheet->getStyle('A2')->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

$activeSheet->setCellValue('D2', 'Ngày diễn ra: ' . date_format(date_create($row2['NgayDienRa']), "d/m/Y"));
//Gộp cột
$activeSheet->mergeCells('D2:E2');

$activeSheet->getStyle('D2')->applyFromArray($styleArray);

$activeSheet->getStyle('D2')->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

$activeSheet->setCellValue('F2', 'Tổng tham gia: ' . $rowtongthamgia['dem']);
//Gộp cột
$activeSheet->mergeCells('F2:G2');

$activeSheet->getStyle('F2')->applyFromArray($styleArray);

$activeSheet->getStyle('F2')->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

$filename = $tenhoatdong . '.xlsx';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
