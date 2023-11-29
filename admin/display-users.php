<!DOCTYPE html>
<html lang="en">

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

    <h1>Tài khoản người dùng</h1>
    <table>
        <tr>
            <th>Mã Khách Hàng</th>
            <th>Email </th>
            <th>Mật Khẩu</th>
            <th>Tên Người Dùng</th>
            <th>Điện Thoại</th>
            <th>Chi Tiết</th>
        </tr>


        <?php
    $query="SELECT * FROM `user`";
    $result = mysqli_query($conn,$query);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $id=$row["id"];
            $email=$row["email"];
            $password=$row["password"];
            $username=$row["username"];
            $phone=$row["phone"];
            echo'
            <tr>
                <td>'.$id.'</td>
                <td>'.$email.'</td>
                <td>'.$password.'</td>
                <td>'.$username.'</td>
                <td>'.$phone.'</td>
                <td><button><a href ="./show-hoadon-user.php?iduser='.$id.'">Chi Tiết</a> </button></td>
            </tr>
        ';
        }
       
    }
    ?>
    </table>
</body>

</html>