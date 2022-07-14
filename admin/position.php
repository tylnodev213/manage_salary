<?php 
include_once 'header.php';
$action= $_GET['action'] ?? "";
switch ($action){
    case 'create':
        include_once 'position/create.php';
        break;
    case 'update':
        include_once 'position/update.php';
        break;
    default:
        include_once 'position/table.php';
}
include_once 'footer.php';