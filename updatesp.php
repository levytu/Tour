<?php
  	include "connect.php";
      $id = $_POST['id'];
   $tensanpham = $_POST['tensanpham'];
   $giasp = $_POST['giasp'];
   $hinhanh = $_POST['hinhanh'];
   $mota = $_POST['mota'];
   $loai = $_POST['loai'];


   $query = 'UPDATE `sanphammoi` SET `tensanpham`="'.$tensanpham.'",`giasp`="'.$giasp.'",`hinhanh`="'.$hinhanh.'",`mota`="'.$mota.'",`loai`='.$loai.' WHERE `id`='.$id;
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