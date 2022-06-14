<!doctype html>
<html lang="en">
  <head>
    <title>Thể loại</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
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
                $connect = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
                $sql_theloai = "select * from theloai";
                $thuchien = mysqli_query($connect,$sql_theloai);
                echo "<h1 style='color:white;margin-left:20px;'>Thể loại</h1>";
                while($row = mysqli_fetch_array($thuchien)) 
                {
                    $machon = $row['id'];
                    echo "
                    <a href='chitiettl.php?ma=$machon' class='ss1'>
                        <img class='imgbh' style='border-radius:10px;' src='$row[imgalbum]'>
                        <p class='tentl'>$row[theloainhac]</p>
                        <i class='fa fa-play'></i>
                    </a>";
                }
                mysqli_close($connect);
              ?>
            </div>
            <div class="c-right">
              <?php include("right.php")?>
            </div>
        </div>
              <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        $(document).ready(function(){
        $('.compass.active .list').slideDown();
        $('.nd').click(function(){
            $(this).parent().toggleClass('active')
            $(this).parent().children('.list').slideToggle();
            });
        });
    </script>
    </body>
</html>