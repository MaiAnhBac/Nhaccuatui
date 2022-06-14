<!doctype html>
<html lang="en">
  <head>
    <title>Lịch Sử Nghe Nhạc</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="0;url=lichsu.php">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/new.css">
    <!-- Bootstrap CSS -->
  </head>
    <body>
        <div class="music">
            <div class="c-left">
                <!-- Sử dụng mã lệnh thanh menu trái -->
                <?php include("left.php") ?>
            </div>
            <div class="c-mid">
                <?php
                    if(isset($_SESSION['dn'])){
                        $id = $_GET['id'];
                        $connect = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
                        $sql = "delete from lichsu where id = $id and user = '".$_SESSION['dn']."'";
                        $thuchien = mysqli_query($connect,$sql);
                    }
                ?>
            </div>
    </body>
</html>