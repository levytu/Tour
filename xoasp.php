<?php
  	include "connect.php";

   $id = $_POST['id'];
  


   $query = 'DELETE FROM `sanphammoi` WHERE `id` ='.$id;
   $data =mysqli_query($conn,$query);
        if ($data == true){
            $arr = [
                'success' =>true,
                'message' => "delete product success!!",

        ];
        }else{
            $arr= [
                'success' =>false,
                'message' => "delete product failed!!",

        ];
    }

print_r(json_encode($arr));
?>