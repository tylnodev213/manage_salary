<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}
include_once 'header.php';
include 'home.php';
include_once 'footer.php';