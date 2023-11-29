<?php
include "../connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['trangthai'])) {
        $id = $_POST['id'];
        $trangthai = $_POST['trangthai'];

        $query = 'UPDATE `donhang` SET `trangthai`="' . $trangthai . '" WHERE `id` =' . $id;
        $data = mysqli_query($conn, $query);
        if ($data == true) {
            $arr = [
                'success' => true,
                'message' => "Cập nhật trạng thái đơn hàng thành công!"
            ];
        } else {
            $arr = [
                'success' => false,
                'message' => "Cập nhật trạng thái đơn hàng thất bại!"
            ];
        }

        echo json_encode($arr);
    }
}
?>