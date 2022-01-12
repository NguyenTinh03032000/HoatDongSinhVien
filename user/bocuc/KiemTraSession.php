<?php
    // Bắt đầu lưu session
    session_start();
    // Nếu tồn tại session
    if (@$_SESSION['Username']) {
        // Gán $user = session
        $user = $_SESSION['Username'];
    }
    // Ngược lại 
    else {
        // $user rỗng
        $user = '';
    }
?>