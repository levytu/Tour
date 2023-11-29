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

    <h2>Sản Phẩm</h2>
    <a href="./show-create-sanpham.php" class="btn-GTthemsan">Thêm Sản phẩm mới </a>

    <table>
        <tr>
            <th>ID</th>
            <th>Tên Sản Phẩm</th>
            <th>Giá Sản Phẩm</th>
            <th>Link Ảnh</th>
            <th>Mô Tả</th>
            <th>Loại</th>
            <th>Số Lượng Tồn</th>
            <th>Tương Tác</th>
        </tr>
        <?php
        $query = "SELECT  * FROM `sanphammoi` WHERE `isdeleted` =0";
          $result= mysqli_query($conn,$query);
          if($result){
          while(  $row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $tensanpham=$row['tensanpham'];
            $giasp=$row['giasp'];
            $hinhanh=$row['hinhanh'];
            $mota=$row['mota'];
            $loai=$row['loai'];
            $sltonkho=$row['sltonkho'];

           

            $trangthaiText = '';
            switch ($loai) {
              
                case 0:
                    $trangthaiText = 'Loading...';
                    break;
                case 1:
                    $trangthaiText = 'Robo ';
                    break;
                case 2:
                    $trangthaiText = 'Bear';
                    break;
                case 3:
                    $trangthaiText = 'Vật dụng';
                    break;
                case 4:
                    $trangthaiText = 'Thức Ăn';
                    break;
                case 5:
                    $trangthaiText = 'Thuốc- TPCM';
                    break;
                default:
                    $trangthaiText = 'Đang chờ xử lý';
                    break;
            }

            echo ' 
            <tr>
                <td>' . $id . '</td>
                <td>' . $tensanpham . '</td>
                <td>' . number_format($giasp) . ' VND</td>
                <td>';

            // Kiểm tra nếu hình ảnh là liên kết
            if (strpos($hinhanh, 'https') === 0) {
                echo '<img class="product-image" src="' . $hinhanh . '" alt="Hình ảnh">';
            } else {
                echo '<img class="product-image" src="../../images/' . $hinhanh . '" alt="Hình ảnh">';
            }

            echo '</td>
                  <td>' . $mota . '</td>
                  <td>' . $trangthaiText . '</td>
                  <td>' . $sltonkho . '</td>
                 <td> <button><a href="./show-update-sanpham.php?updateid='.$id.'">Update</a></button>
                 <button><a href="./show-delete-sanpham.php?deleteid='.$id.'">Delete</a></button></td>
            </tr>';
          }
        }
        ?>

    </table>

</body>

</html>