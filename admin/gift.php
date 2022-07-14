<?php 
include_once 'header.php';
$action= $_GET['action'] ?? "";
switch ($action){
    case 'create':
        include_once 'gift/create.php';
        break;
    case 'update':
        include_once 'gift/update.php';
        break;
    default:
        include_once 'gift/table.php';
}
include_once 'footer.php';