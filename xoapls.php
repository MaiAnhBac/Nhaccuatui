<!doctype html>
<html lang="en">
  <head>
    <title>Trang chủ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="0;url=playlist.php">
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
                    $connect = mysqli_connect("localhost","root","","demoweb");
                    // xóa playlist
                    $sql = "delete from playlist where id = $id";
                    $thuchien = mysqli_query($connect,$sql);
                    // xóa toàn bộ bài hát trong playlist vừa xóa
                    $sql_delete = "delete from addplaylist where playlistadd = $id";
                    $thuchien2 = mysqli_query($connect,$sql_delete);          
                    mysqli_close($connect);                  
                }            
                ?>
            </div>
        </script>
    </body>
</html>