<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .product-image {
        max-width: 100px;
        max-height: 100px;
    }

    .btn-GTthemsan {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }

    .btn-GTthemsan:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <?php  $iduser = $_GET['iduser'];
        $querycount = "SELECT COUNT(id) as TongSLDaMua FROM `donhang` WHERE `iduser`= $iduser";
        $resultcount = mysqli_query($conn,$querycount);
        $rowTongSlDaMua = mysqli_fetch_assoc($resultcount);
         $rowTongSlDaMua['TongSLDaMua'];
    ?>

    <h3>Tổng số đơn khách đã mua: <?php  echo $rowTongSlDaMua['TongSLDaMua'];?></h3>
    <table>
        <tr>
            <th>ID Đơn</th>
            <th>Địa chỉ</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Số lượng </th>
            <th>Tổng tiền </th>
            <th>Ngày đặt </th>
        </tr>
        <?php 
   
    $query= "SELECT * FROM `donhang` WHERE `iduser`= $iduser ORDER BY `id` DESC  ";
    $result= mysqli_query($conn,$query);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $iduser=$row['iduser'];
            $diachi=$row['diachi'];
            $sodienthoai=$row['sodienthoai'];
            $email=$row['email'];
            $soluong=$row['soluong'];
            $tongtien=$row['tongtien'];
            $ngaydat=$row['ngaydat'];
            echo '<tr>
                <td>'.$id.' </td>
                
                <td>'.$diachi.' </td>
                <td>'.$sodienthoai.' </td>
                <td>'.$email.' </td>
                <td>'.$soluong.' </td>
                <td>'.$tongtien.' </td>
                <td>'.$ngaydat.' </td>
            </tr>';
        }
    }
    ?>

    </table>

</body>

</html>