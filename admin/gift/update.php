<?php
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$search=$_get['search'] ?? '';
$p=$_GET['p'] ?? 1;
include 'conn.php';
$sql = "SELECT * FROM thuong WHERE id = $id";
$result = mysqli_query($connect,$sql);
include 'dis-conn.php';
foreach ($result as $each){
    echo '
    <form class="title" action="gift/process_update.php?search='.$search.'&p='.$p.'" method="post">
    <input type="hidden" name="id" value="'. $each['id'].'">
    Tiên thưởng(nghìn đồng): <input class="form-control" type="number" step="50" name="money_gift" value="'. $each['tienThuong'].'"><br>
    <button class="btn btn-primary">Sửa</button>
    </form>';
}