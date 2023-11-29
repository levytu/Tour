<?php
  	include "connect.php";

   $tensanpham = $_POST['tensanpham'];
   $giasp = $_POST['giasp'];
   $hinhanh = $_POST['hinhanh'];
   $mota = $_POST['mota'];
   $loai = $_POST['loai'];
   $sltonkho =$_POST['sltonkho'];

   $query = 'INSERT INTO `sanphammoi`(`tensanpham`, `giasp`, `hinhanh`, `mota`, `loai`,`sltonkho`) VALUES ("'.$tensanpham.'","'.$giasp.'","'.$hinhanh.'","'.$mota.'",'.$loai.','.$sltonkho.')';
   $data =mysqli_query($conn,$query);
        if ($data == true){
            $arr = [
                'success' =>true,
                'message' => "add product success!!",

        ];
        }else{
            $arr= [
                'success' =>false,
                'message' => "add product failed!!",

        ];
    }

print_r(json_encode($arr));
?>