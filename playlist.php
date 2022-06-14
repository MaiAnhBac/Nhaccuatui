<!doctype html>
<html lang="en">
  <head>
    <title>Trang chủ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/new.css">
  </head>
    <body>
        <div class="music">
            <div class="c-left">
                <!-- Sử dụng mã lệnh thanh menu trái -->
                <?php include("left.php") ?>
                </div>
            <div class="c-mid">
                <form  class = "tk" action="" method ="GET">
                    <input type="text" name="playlist" placeholder="Tên playlist">
                    <button>Tạo</button>
                </form>
                <?php
                if(isset($_SESSION['dn'])){
                    if(isset($_GET['playlist'])){
                        //kết nối tạo playlist add vào csdl
                        $connect=mysqli_connect("localhost","root","","demoweb");
                        if(isset($_GET["playlist"]) && !empty($_GET["playlist"]))
                        {
                            // lấy giá trị từ ô playlist
                            $key = $_GET["playlist"];
                            // câu lệnh sql thêm vào bảng playlist
                            $sql_playlist = "insert into playlist(tenplist,uscreate) values ('".$key."','".$_SESSION['dn']."')";
                            $createpls = mysqli_query($connect,$sql_playlist);                          
                        }
                        else echo "<h3 style='padding:0;margin:0;position:relative;top:10px;left:10px;'>Nhập tên playlist</h3>";
                        mysqli_close($connect);
                    }
                    //in ra những playlist tương đương với session đăng nhập
                    $connect = mysqli_connect("localhost","root","","demoweb");
                    $sql_playlists = "Select * from playlist where uscreate = '".$_SESSION['dn']."'";
                    $showpls = mysqli_query($connect,$sql_playlists);
                    while($dong = mysqli_fetch_array($showpls)){
                        $goc = $dong['id'];
                        echo "
                            <a href='chitietpls.php?id=$goc' class='ss2'>
                                <img class='imgpls' style='border-radius:10px;' src='image/playlist.jpg'>
                                <p class='tentl2'>$dong[tenplist]</p>
                                <i class='fa fa-play'></i>
                            </a>";
                    }
                    mysqli_close($connect);
                }
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