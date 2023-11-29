<?php
	//include "../connect.php";
    //thuc hien khi load trang 
    $query = "SELECT * ,SUM(tongtien) as tongtienthang ,MONTH(`ngaydat`) as thang FROM `donhang` WHERE trangthai=4  GROUP BY YEAR(`ngaydat`),MONTH(`ngaydat`)";
    $data= mysqli_query($conn,$query);
    $TongTienpArray = array();
    $ThangArray = array();
    while($row = mysqli_fetch_assoc($data)) {
        $TongTienpArray[] = $row['tongtienthang'];
        $ThangArray[] = $row['thang'];
    }
        $TongTien = json_encode($TongTienpArray);
        $Thang = json_encode($ThangArray);
        $TongTienArray = json_decode($TongTien, true);
        $tong = array_sum($TongTienArray);
        $tongFormatted = number_format($tong, 0, ',', '.');
    // thuc hien khi nhan cap nhat
    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
       if($Thang!=0){
        $Thang = $_POST['thang'];
        $query = "SELECT *, SUM(tongtien) as tongtienthang, MONTH(`ngaydat`) as thang ,YEAR(`ngaydat`) as nam FROM `donhang` WHERE trangthai = 4";
       
        if (!empty($Thang) && !in_array('all', $Thang)) {
            $selectedMonths = implode(',', $Thang);
            $query .= " AND YEAR(`ngaydat`) IN ($selectedMonths)";
        }
        $query .= " GROUP BY YEAR(`ngaydat`), MONTH(`ngaydat`)";
        $data= mysqli_query($conn,$query);
        $TongTienpArray = array();
        $ThangArray = array();
        while($row = mysqli_fetch_assoc($data)) {
            $TongTienpArray[] = $row['tongtienthang'];
            $ThangArray[] = $row['thang'];
        }
        $TongTien = json_encode($TongTienpArray);
        $Thang = json_encode($ThangArray);
        $TongTienArray = json_decode($TongTien, true);
        $tong = array_sum($TongTienArray);

        $tongFormatted = number_format($tong, 0, ',', '.');


       }
    }
    
    
    echo '
    <form method="POST" action="">
        <select name="thang[]"  onchange="updateTrangThai(this)">
            <option value="all"' . (in_array('all', $ThangArray) ? ' selected' : '') . '>Tất cả</option>
            <option value="2022"' . (in_array(2022, $ThangArray) ? ' selected' : '') . '>2022</option>
            <option value="2023"' . (in_array(2023, $ThangArray) ? ' selected' : '') . '>2023</option>
            <option value="2024"' . (in_array(2024, $ThangArray) ? ' selected' : '') . '>2024</option>
            <option value="2025"' . (in_array(2025, $ThangArray) ? ' selected' : '') . '>2025</option>
        </select>
        <button type="submit">Cập nhật</button>
        
    </form>';
    

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê sản phẩm bán ra:
    </title>
</head>

<body>

    <a>Tổng Doanh Năm <?php echo $tongFormatted; ?></a>
    <div>
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const labels = <?php echo $Thang ?>;
    const data = {
        labels: labels,
        datasets: [{
            axis: 'y',
            label: 'Doanh Thu Tháng',
            data: <?php echo $TongTien ?>,
            fill: false,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    </script>
</body>

</html>