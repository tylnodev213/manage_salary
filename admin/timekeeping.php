<?php 
include 'header.php';
$action= $_GET['action'] ?? "";
switch ($action){
    case 'create':
        include_once 'timekeeping/create.php';
        break;
    case 'update':
        include_once 'timekeeping/update.php';
        break;
    default:
        include_once 'timekeeping/table.php';
}
include 'footer.php';