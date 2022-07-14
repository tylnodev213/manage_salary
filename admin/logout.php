<?php
    session_start();
//    unset($_SESSION['ma_user']); // Xóa 1 biến nào đó trên session
    session_destroy(); // Xóa cả session
//    session_unset(); // Xóa tất cả biến trên session nhưng vẫn để lại session
    header('location:../index.php');
?>