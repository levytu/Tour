<?php
// Số bản ghi hiển thị trên mỗi trang
$recordsPerPage = 5;

// Trang hiện tại (mặc định là trang đầu tiên)
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính toán OFFSET (số bản ghi bỏ qua) dựa trên trang hiện tại
$offset = ($currentPage - 1) * $recordsPerPage;

// Câu truy vấn SQL để lấy dữ liệu từ cơ sở dữ liệu
$query = "SELECT * FROM lichsu_thaydoi ORDER BY sanphammoi_id ASC, thoigian DESC LIMIT $recordsPerPage OFFSET $offset";
$result = mysqli_query($conn, $query);

$currentProductId = null; // Sản phẩm ID hiện tại
echo '<div style="display: flex; justify-content: center; align-items: center;">';
echo '<div style="text-align: center;">';

while ($row = mysqli_fetch_assoc($result)) {
    // Kiểm tra nếu Sản phẩm ID đã thay đổi
    if ($row['sanphammoi_id'] !== $currentProductId) {
        // Nếu đã có sản phẩm trước đó, xuống dòng để tạo khoảng cách
        if ($currentProductId !== null) {
            echo '-------------------------------------<br>';
        }
        
        // Hiển thị thông tin của Sản phẩm ID mới
        echo '<span style="font-weight: bold; color: red; font-size: 16px;">Sản phẩm ID: ' . $row['sanphammoi_id'] . '</span><br>';
        echo 'Tên sản phẩm: ' . $row['tensanpham'] . '<br>';
        echo 'Giá sản phẩm: ' . $row['giasp'] . '<br>';
        echo 'Mô tả: ' . $row['mota'] . '<br>';
        echo 'Loại: ' . $row['loai'] . '<br>';
        echo 'Số lượng tồn kho: ' . $row['sltonkho'] . '<br>';
        echo 'Thời gian: ' . $row['thoigian'] . '<br>';
    } else {
        // Hiển thị thông tin của các bản ghi tiếp theo của cùng một Sản phẩm ID
        echo '-------------------------------------<br>';
        echo 'Tên sản phẩm: ' . $row['tensanpham'] . '<br>';
        echo 'Giá sản phẩm: ' . $row['giasp'] . '<br>';
        echo 'Mô tả: ' . $row['mota'] . '<br>';
        echo 'Loại: ' . $row['loai'] . '<br>';
        echo 'Số lượng tồn kho: ' . $row['sltonkho'] . '<br>';
        echo 'Thời gian: ' . $row['thoigian'] . '<br>';
    }

    $currentProductId = $row['sanphammoi_id']; // Cập nhật Sản phẩm ID hiện tại
}

// Truy vấn để đếm tổng số bản ghi
$countQuery = "SELECT COUNT(*) as total FROM lichsu_thaydoi";
$countResult = mysqli_query($conn, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);
$totalRecords = $countRow['total'];

// Tính toán số trang dựa trên tổng số bản ghi và số bản ghi hiển thị trên mỗi trang
$totalPages = ceil($totalRecords / $recordsPerPage);

// Hiển thị các liên kết phân trang
echo '<div class="pagination">';
if ($totalPages > 1) {
    for ($i = 1; $i <= $totalPages; $i++) {
        // Tạo liên kết cho từng trang
        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
    }
}
echo '</div>';

?>