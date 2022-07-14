<?php 
include_once 'header.php';
$action= $_GET['action'] ?? "";
switch ($action){
    case 'update':
        include_once 'contract/update.php';
        break;
    default:
        include_once 'contract/table.php';
}
include_once 'footer.php';