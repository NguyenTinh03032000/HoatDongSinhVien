<?php 
     include "bocuc/Connect.php";
     
     $key = $_POST['namhoc'];
     $sql1 = "select * from khoahoc where MaKhoaHoc = '".$key."'";
     $kq1 = mysqli_query($kn, $sql1);
     $row = mysqli_fetch_array($kq1);
     $nam1 = ($row['NamBatDau'])."-".($row['NamBatDau'] + 1);
     $nam2 = ($row['NamBatDau'] + 1)."-".($row['NamBatDau'] + 2);
     $nam3 = ($row['NamBatDau'] + 2)."-".($row['NamBatDau'] + 3);
     $nam4 = ($row['NamBatDau'] + 3)."-".($row['NamBatDau'] + 4);
     $nam5 = ($row['NamBatDau'] + 4)."-".($row['NamBatDau'] + 5);
     echo "<option value='$nam1'>$nam1</option>";
     echo "<option value='$nam2'>$nam2</option>";
     echo "<option value='$nam3'>$nam3</option>";
     echo "<option value='$nam4'>$nam4</option>";
     echo "<option value='$nam5'>$nam5</option>";
?>