<?php
    //include "../connect.php";
    if(isset($_POST['submit'])){
        $tensanpham = $_POST['tensanpham'];
        $giasp = $_POST['giasp'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $mota = $_POST['mota'];
        $loai = $_POST['loai'];
        $sltonkho = $_POST['sltonkho'];
        
        $upload_path = '../../images/'; // Đường dẫn thư mục lưu trữ ảnh tải lên
        $upload_destination = realpath($upload_path) . '/' . $hinhanh;
        
        if(move_uploaded_file($hinhanh_tmp, $upload_destination)){
            $query = 'INSERT INTO `sanphammoi`(`tensanpham`, `giasp`, `hinhanh`, `mota`, `loai`, `sltonkho`) VALUES ("'.$tensanpham.'","'.$giasp.'","'.$hinhanh.'","'.$mota.'",'.$loai.','.$sltonkho.')';
            $result = mysqli_query($conn, $query);
            if($result){
                echo 'Thêm thành công';
            }else{
                echo 'Thêm không thành công';
            }
        }else{
            echo 'Lỗi khi tải lên ảnh';
        }
    }
?>

<!DOCTYPE html>
<html>



<body>
    <div class="body-container">
        <H1 class="h1themsp">Thêm Sản Phẩm Mới</H1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label">Tên sản Phẩm</label>
                <input class="form-input" type="text" placeholder="Nhập Tên Sản phẩm" name="tensanpham" />
            </div>
            <div class="form-group">
                <label class="form-label">Giá sản Phẩm</label>
                <input class="form-input" type="text" placeholder="Nhập Giá Sản phẩm" name="giasp" />
            </div>
            <div class="form-group">
                <label class="form-label">Ảnh sản Phẩm</label>
                <input class="form-input" type="file" name="hinhanh" />
            </div>
            <div class="form-group">
                <label class="form-label">Mô tả sản Phẩm</label>
                <input class="form-input" type="text" placeholder="Nhập Mô Tả Sản phẩm" name="mota" />
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
                <input class="form-input" type="text" placeholder="Số lượng tồn kho" name="sltonkho" />
            </div>

            <button type="submit" name="submit"> Thêm Sản Phẩm</button>
        </form>
    </div>
</body>

</html>