<?php 
include_once 'header.php';
$action= $_GET['action'] ?? "";
switch ($action){
    case 'create':
        include_once 'insurance/create.php';
        break;
    case 'update':
        include_once 'insurance/update.php';
        break;
    default:
        include_once 'insurance/table.php';
}
include_once 'footer.php';