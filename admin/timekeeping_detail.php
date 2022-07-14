<?php 
include 'header.php';
$action= $_GET['action'] ?? "";
if($action == 'tableEmployee'){
    include 'timekeeping_detail/tableEmployee.php';
}else{
    include 'timekeeping_detail/table.php';
}
include 'footer.php';