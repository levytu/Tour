<?php 
   // include "../connect.php";
?>
<?php
    	
        $id = $_GET['updateid'];
        $query2 = 'SELECT * FROM `sanphammoi` WHERE `id` = ' . $id;
        $result2 = mysqli_query($conn, $query2);
        $row = mysqli_fetch_assoc($result2);

        if(isset($_POST['submit'])){
            $tensanpham = $_POST['tensanpham'];
            $giasp = $_POST['giasp'];
            $hinhanh = $_POST['hinhanh'];
            $mota = $_POST['mota'];
            $loai = $_POST['loai'];
            $sltonkho =$_POST['sltonkho'];
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $thoigian = date('Y-m-d H:i:s');
   $query = 'UPDATE `sanphammoi` SET `tensanpham`="'.$tensanpham.'",`giasp`="'.$giasp.'",`hinhanh`="'.$hinhanh.'",`mota`="'.$mota.'",`loai`='.$loai.',`sltonkho`='.$sltonkho.' WHERE `id`='.$id;
            $result= mysqli_query($conn,$query);
            if($result){
                echo 'thêm thành công ';
            }else{
                echo 'thêm không thành công ';
            }

            $query3 = 'INSERT INTO lichsu_thaydoi (sanphammoi_id, tensanpham, giasp, hinhanh, mota, loai, sltonkho, thoigian)
           VALUES ("'.$id.'", "'.$tensanpham.'", "'.$giasp.'", "'.$hinhanh.'", "'.$mota.'", "'.$loai.'", "'.$sltonkho.'", "'.$thoigian.'")';
$result3 = mysqli_query($conn, $query3);
        }
?>

<!DOCTYPE html>
<html>

<body>
    <div class="body-container">
        <form method="post">
            <div class="form-group">
                <label class="form-label">Tên sản Phẩm</label>
                <input class="form-input" type="text" placeholder="Nhập Tên Sản phẩm" name="tensanpham"
                    value="<?php echo $row['tensanpham']; ?>" />
            </div>
            <div class="form-group">
                <label class="form-label">Giá sản Phẩm</label>
                <input class="form-input" type="text" placeholder="Nhập Giá Sản phẩm" name="giasp"
                    value="<?php echo $row['giasp']; ?>" />
            </div>
            <div class="form-group">
                <label class="form-label">Ảnh sản Phẩm</label>
                <input class="form-input" type="text" placeholder="Nhập Link Sản phẩm" name="hinhanh"
                    value="<?php echo $row['hinhanh']; ?>" />
            </div>
            <div class="form-group">
                <label class="form-label">Mô tả sản Phẩm</label>
                <input class="form-input" type="text" placeholder="Nhập Mô Tả Sản phẩm" name="mota"
                    value="<?php echo $row['mota']; ?>" />
            </div>
            <div class="form-group">
                <label class="form-label">Loại sản Phẩm</label>
                <select name="loai">
                    <option value="1">Hamster robo</option>
                    <option value="2">Hamster bear</option>
                    <option value="3">Vật Dụng</option>
                    <option value="4">Thức Ăn</option>
                    <option value="5">Thuốc-TPCN</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Số lượng nhập kho: </label>
                <input class="form-input" type="text" placeholder="Số lượng tồn kho" name="sltonkho"
                    value="<?php echo $row['sltonkho']; ?>" />
            </div>

            <button type="submit" name="submit"> Cập Nhật </button>
        </form>

    </div>


</body>

</html>