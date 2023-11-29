<?php
// Check if a specific month and year are selected

?>

<?php
	//include "../connect.php";
    
    global $flag;
    $flag = false;
	$query = "SELECT sanphammoi.tensanpham, SUM(chitietdonhang.soluong) AS SoLuongDaBan,MONTH(`ngaydat`) as thang, YEAR(`ngaydat`) as nam
    FROM chitietdonhang
    INNER JOIN sanphammoi ON sanphammoi.id = chitietdonhang.idsp
    INNER JOIN donhang ON donhang.id = chitietdonhang.iddonhang
    WHERE donhang.trangthai = 4 
    GROUP BY chitietdonhang.idsp";
	$data= mysqli_query($conn,$query);
    $tenspArray = array();
    $soluongArray = array();
    $ThangArray = array();
    $NamArray = array();
    while($row = mysqli_fetch_assoc($data)) {
        $tenspArray[] = $row['tensanpham'];
        $soluongArray[] = $row['SoLuongDaBan'];
        $ThangArray[] = $row['thang'];
        $NamArray[] = $row['nam'];
    }
    $tensp = json_encode($tenspArray);
    $soluong = json_encode($soluongArray);
    $Thang = json_encode($ThangArray);
    $Nam = json_encode($NamArray);


    if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    
        if($Thang!=0 && $Nam!=0){
        
            $Thang = $_POST['thang'];
            $Nam = $_POST['nam'];
            $selectedMonths = implode(',', $Thang);
            $selectedYears = implode(',', $Nam);
            echo '|dong 42 ';
            echo  $selectedMonths;
            echo $selectedYears;
            $query = "SELECT sanphammoi.tensanpham, SUM(chitietdonhang.soluong) AS SoLuongDaBan,MONTH(`ngaydat`) as thang, YEAR(`ngaydat`) as nam
            FROM chitietdonhang
            INNER JOIN sanphammoi ON sanphammoi.id = chitietdonhang.idsp
            INNER JOIN donhang ON donhang.id = chitietdonhang.iddonhang
            WHERE donhang.trangthai = 4 
            ";
            if($selectedYears=='all' && $selectedMonths=='all'){// lấy tất cả năm và tháng
                echo  " |dong 52 lay tat ca ";
                echo  $selectedMonths;
                echo $selectedYears;
                $query .= " GROUP BY chitietdonhang.idsp";
            }
            else if (!empty($Thang) && !empty($Nam) ) {//lọc theo tháng năm
                if(!in_array('all', $Thang )&& !in_array('all', $Nam) ){
                    $flag = true;
                    $selectedMonths = implode(',', $Thang);
                    $selectedYears = implode(',', $Nam);
                    echo '|dang chay dong 54 ';
                    echo $selectedMonths;
                    echo $selectedYears;
                    
                    $query .= "AND MONTH(`ngaydat`) IN ($selectedMonths) AND YEAR(`ngaydat`) IN ($selectedYears) GROUP BY chitietdonhang.idsp";
    
                    //tinh so luong san pham tung thang nam
                    $queryTong = "SELECT SUM(chitietdonhang.soluong) AS TongSoLuongDaBan
                    FROM chitietdonhang
                    INNER JOIN sanphammoi ON sanphammoi.id = chitietdonhang.idsp
                    INNER JOIN donhang ON donhang.id = chitietdonhang.iddonhang
                    WHERE donhang.trangthai = 4
                    AND MONTH(`ngaydat`) IN ($selectedMonths)
                    AND YEAR(`ngaydat`) IN ($selectedYears)";
    
                    $dataTong = mysqli_query($conn, $queryTong);
                    $rowTong = mysqli_fetch_assoc($dataTong);
                    $tongSoLuongDaBan = $rowTong['TongSoLuongDaBan'];
                }else if( in_array('all', $Thang )&& !in_array('all', $Nam)){
                    $flag = true;
                    $selectedMonths = implode(',', $Thang);
                    $selectedYears = implode(',', $Nam);
                    echo 'dang chay dong 75';
                    echo $selectedMonths;
                    echo $selectedYears;
                    
                    $query .= "AND  YEAR(`ngaydat`) IN ($selectedYears) GROUP BY chitietdonhang.idsp";
    
                    //tinh so luong san pham tung thang nam
                    $queryTong = "SELECT SUM(chitietdonhang.soluong) AS TongSoLuongDaBan
                    FROM chitietdonhang
                    INNER JOIN sanphammoi ON sanphammoi.id = chitietdonhang.idsp
                    INNER JOIN donhang ON donhang.id = chitietdonhang.iddonhang
                    WHERE donhang.trangthai = 4
                  
                    AND YEAR(`ngaydat`) IN ($selectedYears)";
    
                    $dataTong = mysqli_query($conn, $queryTong);
                    $rowTong = mysqli_fetch_assoc($dataTong);
                    $tongSoLuongDaBan = $rowTong['TongSoLuongDaBan'];
                }
                
            } // nếu không chọn theo tháng năm thì sẽ trả ra tất cả  
          
            $data= mysqli_query($conn,$query);
            $tenspArray = array();
            $soluongArray = array();
            $ThangArray = array();
            $NamArray = array();
            while($row = mysqli_fetch_assoc($data)) {
                $tenspArray[] = $row['tensanpham'];
                $soluongArray[] = $row['SoLuongDaBan'];
                $ThangArray[] = $row['thang'];
                $NamArray[] = $row['nam'];
            }
            $tensp = json_encode($tenspArray);
            $soluong = json_encode($soluongArray);
            $Thang = json_encode($ThangArray);
            $Nam = json_encode($NamArray);
        }
        
        
    }
    //form 
    

    
	 
?>
<!-- dropdown list  -->
<form method="POST" action="">
    <select name="thang[]" onchange="updateTrangThai(this)">
        <option value="all" <?php echo (in_array('all', $ThangArray) ? ' selected' : ''); ?>>Tất cả</option>
        <?php
    for ($i = 1; $i <= 12; $i++) {
        if (!in_array('all', $ThangArray) && in_array($i, $ThangArray)) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        echo "<option value=\"$i\" $selected>$i</option>";
    }
    ?>
    </select>
    <select name="nam[]" onchange="updateTrangThai(this)">
        <option value="all" <?php echo (in_array('all', $NamArray) ? ' selected' : ''); ?>>Tất cả</option>
        <?php
        $currentYear = date('Y'); // Năm hiện tại
        $pastYears = 5; // Số năm trước
        $futureYears = 5; // Số năm tương lai
        for ($i = -$pastYears; $i <= $futureYears; $i++) {
            $year = $currentYear + $i;
            $selected = (in_array($year, $NamArray) ? ' selected' : '');
            echo "<option value=\"$year\" $selected>$year</option>";
        }
    ?>
    </select>

    <button type="submit">Lọc</button>
</form>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê sản phẩm bán ra:
    </title>
</head>

<body>
    <h3>Số Sản Phẩm đã bán: <?php 
    if($flag ==true ){
        echo $tongSoLuongDaBan;
            
    }else{

        $queryTong = "SELECT SUM(SoLuongDaBan) AS TongSoLuongDaBan
        FROM (
            SELECT SUM(chitietdonhang.soluong) AS SoLuongDaBan
            FROM chitietdonhang
            INNER JOIN sanphammoi ON sanphammoi.id = chitietdonhang.idsp
            INNER JOIN donhang ON donhang.id = chitietdonhang.iddonhang
            WHERE donhang.trangthai = 4 
            GROUP BY chitietdonhang.idsp
        ) AS subquery";
        
        $dataTong = mysqli_query($conn, $queryTong);
        $rowTong = mysqli_fetch_assoc($dataTong);
        echo $rowTong['TongSoLuongDaBan'];
        
    }
     ?></h3>
    <div>
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const labels = <?php echo $tensp ?>;
    const data = {
        labels: labels,
        datasets: [{
            axis: 'y',
            label: 'Số Lượng Đã Bán Ra',
            data: <?php echo $soluong ?>,
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
        data,
        options: {
            indexAxis: 'y',
        }
    };
    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    </script>
</body>

</html>