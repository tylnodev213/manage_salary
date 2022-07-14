
<?php
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$search = $_GET['search'] ?? '';
$p2 = $_GET['p2'] ?? 1;
include 'conn.php';
$sql = "SELECT hopDong.*, nhanVien.hoTen, baoHiem.* FROM hopDong
INNER JOIN nhanVien
ON nhanVien.id = hopDong.idNhanVien
INNER JOIN baoHiem
ON baoHiem.id = hopDong.idBaohiem
WHERE hopDong.id = $id";
$result = mysqli_query($connect,$sql);
include 'dis-conn.php';
foreach ($result as $each){
    ?>
    <form class="title" action="contract/process_update.php?search=<?php echo $search; ?>&p2=<?php echo $p2; ?>" method="post">
    <input type="hidden" name="idNhanVien" value="<?php echo $each['idNhanVien']; ?>" />
    <div class="form-group">
    <label>Tên nhân viên: <?php echo $each['hoTen']; ?></label>
    </div>
    <div class="form-row">
    <div class="col-md-4 mb-3">
    <input type="hidden" name="id" value="<?php echo $each['id']; ?>">
    <label>Ngày bắt đầu:</label>
    <input  class="form-control" type="date" name="ngayBatDau" value="<?php echo $each['ngayBatDau']; ?>">
    </div>
    <div class="col-md-4 mb-3">
    <label>Ngày kết thúc:</label>
    <input  class="form-control" type="date" name="ngayKetThuc" value="<?php echo $each['ngayKetThuc']; ?>">
    </div>
    <div class="col-md-4 mb-3">
    <label>Bảo hiểm:</label>
    <select class="form-control" name="idBaohiem">
        <option value="">-Chọn-</option>
        <?php
            include 'conn.php';
            $sql = "SELECT * FROM baoHiem";
            $result = mysqli_query($connect,$sql);
            include 'dis-conn.php';
            foreach($result as $row){
                ?>
                <option value="<?php echo $row['id'] ?>"
                <?php
                if($row['id'] == $each['idBaohiem']){
                    ?>
                selected
                <?php
                }
                ?>
                >
                    <?php echo $each['loaiBaohiem']; ?>
                </option>
            <?php
            } 
        ?>
    </select>
    </div>
    </div>
    <div class="form-group">
    <label>Lương cơ bản:</label>
    <input  class="form-control" type="number" step="50" name="luongCb" value="<?php echo $each['luongCb']; ?>">
    </div>
    <button class="btn btn-primary">Sửa</button>
    </form>
    <span id="error_date"></span>
    <span id="error_select"></span>
    <?php
}
?>