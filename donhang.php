<?php
	include "connect.php";
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $tongtien = $_POST['tongtien'];
    $iduser = $_POST['iduser'];
    $diachi = $_POST['diachi'];
    $soluong = $_POST['soluong'];
    $chitiet = $_POST['chitiet'];
	$query = 'INSERT INTO `donhang`(`iduser`, `diachi`, `sodienthoai`, `email`, `soluong`, `tongtien`) VALUES ('.$iduser.', "'.$diachi.'","'.$sdt.'","'.$email.'",'.$soluong.',"'.$tongtien.'")';
	$data= mysqli_query($conn,$query);

    if($data == true){
            $query='SELECT id AS iddonghang FROM `donhang` WHERE `iduser` = '.$iduser.' ORDER BY id DESC LIMIT 1';
            $data= mysqli_query($conn,$query);

            while($row = mysqli_fetch_assoc($data)){
                $iddonhang=($row);
            }
            if(!empty($iddonhang)){
                $chitiet =json_decode($chitiet, true);
                foreach ($chitiet as $key => $value) {
                    $truyvan = 'INSERT INTO `chitietdonhang`(`iddonhang`, `idsp`, `soluong`, `gia`) VALUES ('.$iddonhang["iddonghang"].','.$value["idsp"].','.$value["soluong"].',"'.$value["giasp"].'")';
                    $data= mysqli_query($conn,$truyvan);
                    //xu ly hang ton kho 
                    $truyvankho = 'SELECT `sltonkho` FROM `sanphammoi` WHERE `id` ='.$value["idsp"];
                    $data1= mysqli_query($conn,$truyvankho);
                    $sltrenkho = mysqli_fetch_assoc($data1) ;     
                    //update lại số lượng sau khi đặt // ps: chưa xử lý logic
                    $truyvankho2 = 'UPDATE `sanphammoi` SET `sltonkho`='.$sltrenkho['sltonkho']-$value['soluong'].' WHERE `id` = '.$value["idsp"];
                    $data2= mysqli_query($conn,$truyvankho2);

                }   
                if($data==true){
                    $arr =[
                        'success' => true,
                        'message'=>"thanh cong"
                    ];
                }
                else{
                    $arr =[
                        'success' => false,
                        'message'=>"khongthanh cong"
                    ];
                }   
                    print_r(json_encode($arr));
                 
            } else{
                $arr =[
                    'success' => false,
                    'message'=>"khongthanh cong"
                ];
                print_r(json_encode($arr));
            }
           
    }    
 

?>