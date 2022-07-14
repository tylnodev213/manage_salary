<?php 
include_once 'header.php';
$action= $_GET['action'] ?? "";
switch ($action){
    case 'create':
        include_once 'department/create.php';
        break;
    case 'update':
        include_once 'department/update.php';
        break;
    default:
        include_once 'department/table.php';
}

include_once 'footer.php';