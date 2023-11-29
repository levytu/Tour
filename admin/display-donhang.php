<?php
// Kết nối cơ sở dữ liệu ở đầu tệp
// ...
include "../../connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị id và trangthai từ yêu cầu POST
    $id = $_POST['id'];
    $trangthai = $_POST['trangthai'];

    // Thực hiện câu truy vấn UPDATE để cập nhật trạng thái đơn hàng
    $query = "UPDATE `donhang` SET `trangthai` = '$trangthai' WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Trạng thái đã được cập nhật thành công
        echo "success";
    } else {
        // Xảy ra lỗi trong quá trình cập nhật
        echo "error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <h2>Đơn Hàng</h2>
    <!-- <a href="./show-donhang.php" class="btn-GTthemsan">Thêm Sản phẩm mới</a> -->

    <table>
        <tr>
            <th>ID Đơn Hàng</th>
            <th>ID Người dùng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Số Lượng</th>
            <th>Tổng Tiền</th>
            <th>Ngày Đặt</th>
            <th>Trạng thái đơn hàng</th>
            <th>Tương Tác</th>
            <th>Chi Tiết</th>
        </tr>
        <?php
      

        $query = 'SELECT * FROM `donhang`  ORDER BY id DESC';
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $iduser = $row['iduser'];
                $diachi = $row['diachi'];
                $sodienthoai = $row['sodienthoai'];
                $email = $row['email'];
                $soluong = $row['soluong'];
                $tongtien = $row['tongtien'];
                $ngaydat = $row['ngaydat'];
                $trangthai = $row['trangthai'];

                $trangthaiText = '';
                switch ($trangthai) {
                  
                    case 0:
                        $trangthaiText = 'Đơn hàng đang chờ xử lý';
                        break;
                    case 1:
                        $trangthaiText = 'Đơn hàng đã được xác nhận ';
                        break;
                    case 2:
                        $trangthaiText = 'Đơn hàng đang trên đường vận chuyển';
                        break;
                    case 3:
                        $trangthaiText = 'Đơn hàng đã bị hủy';
                        break;
                    case 4:
                        $trangthaiText = 'Giao thành công';
                        break;
                    default:
                        $trangthaiText = 'Đang chờ xử lý';
                        break;
                }

                echo '
                <tr>
                    <td>' . $id . '</td>
                    <td>' . $iduser . '</td>
                    <td>' . $diachi . '</td>
                    <td>' . $sodienthoai . '</td>
                    <td>' . $email . '</td>
                    <td>' . $soluong . '</td>
                    <td>' . $tongtien . '</td>
                    <td>' . $ngaydat . '</td>
                    <td>' . $trangthaiText . '</td>
    
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="' . $id . '">
                            <select name="trangthai" onchange="updateTrangThai(this)">
                            
                                <option value="0"' . ($trangthai == 0 ? ' selected' : '') . '>Đơn hàng đang chờ xử lý</option>
                                <option value="1"' . ($trangthai == 1 ? ' selected' : '') . '>Xác nhận đơn hàng</option>
                                <option value="2"' . ($trangthai == 2 ? ' selected' : '') . '>Đang giao</option>
                                <option value="3"' . ($trangthai == 3 ? ' selected' : '') . '>Đã Hủy</option>
                                <option value="4"' . ($trangthai == 4 ? ' selected' : '') . '>Giao Thành Công</option>
                            </select>
                            <button type="submit">Cập nhật</button>
                        </form>
                    </td>
                    <td> <button><a href="./show-chitiet-sanpham.php?chitietid='.$id.'">Xem Chi Tiết</a></button></td>
                </tr>';
            }
        }
        ?>
    </table>

    <script>
    function updateTrangThai(selectElement) {
        var id = selectElement.form.elements["id"].value;
        var trangthai = selectElement.value;

        $.ajax({

            url: "./update-trangthaidonhang.php",
            type: "POST",
            data: {
                id: id,
                trangthai: trangthai
            },
            success: function(response) {
                console.log("Trạng thái đã được cập nhật thành công.");
            },
            error: function(xhr, status, error) {
                console.log("Đã xảy ra lỗi trong quá trình cập nhật trạng thái.");
            }
        });
    }
    </script>
</body>

</html>