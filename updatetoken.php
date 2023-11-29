<?php
  	include "connect.php";
       $token = $_POST['token'];
   $id = $_POST['id'];



   $query = 'UPDATE `user` SET `token`="'.$token.'" WHERE `id` ='.$id;
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