<!DOCTYPE html>
<html>

<head>
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

    <h2>Chi Tiết Sản Phẩm</h2>
    <!-- <a href="./show-create-sanpham.php" class="btn-GTthemsan">Thêm Sản phẩm mới </a> -->

    <table>
        <tr>
            <th>ID Sản Phẩm</th>
            <th>Tên Sản Phẩm</th>
            <th>Ảnh Sản Phẩm</th>
            <th>Số lượng Sản Phẩm</th>
            <th>giá Sản Phẩm</th>


        </tr>
        <?php
        $idchitiet = $_GET['chitietid'];
        $query = "SELECT chitietdonhang.idsp, sanphammoi.tensanpham, chitietdonhang.soluong,sanphammoi.hinhanh,sanphammoi.giasp
        FROM chitietdonhang
        INNER JOIN donhang ON donhang.id = chitietdonhang.iddonhang
        INNER JOIN sanphammoi ON sanphammoi.id = chitietdonhang.idsp
        WHERE donhang.id = $idchitiet";
          $result= mysqli_query($conn,$query);
          if($result){
          while(  $row=mysqli_fetch_assoc($result)){
            $idsp=$row['idsp'];
            $tensanpham=$row['tensanpham'];
            $hinhanh= $row['hinhanh'];
            $soluong=$row['soluong'];
            $gia=$row['giasp'];
     
            echo ' 
            <tr>
                <td>' . $idsp . '</td>
                <td>' . $tensanpham . '</td>
               
                <td>';

            // Kiểm tra nếu hình ảnh là liên kết
            if (strpos($hinhanh, 'https') === 0) {
                echo '<img class="product-image" src="' . $hinhanh . '" alt="Hình ảnh">';
            } else {
                echo '<img class="product-image" src="../../images/' . $hinhanh . '" alt="Hình ảnh">';
            }
            echo ' 
                <td>' . $soluong . '</td>
                <td>' . $gia . '</td>
            
            
            
            
            ';
            
    
          }
        }
        ?>

    </table>

</body>

</html>