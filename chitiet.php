<!doctype html>
<html lang="en">
  <head>
    <title>Albums</title>
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
                        //lấy id album đã chọn bên trang mid.php
                        $idchon = $_GET['ma'];
                        // kết nối mysql
                        $connect = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
                        mysqli_query($connect,"set names 'utf-8'");
                        // đếm số bài hát của albums
                        $sql_dem = "SELECT COUNT(*) as bang FROM mysusic WHERE albums = '".$idchon."'";
                        $dem = mysqli_query($connect,$sql_dem);
                        $row = mysqli_fetch_assoc($dem);
                        // kết nối lấy ảnh của album
                        $sql_img = "select * from album where id = '".$idchon."'";
                        $imgalbum = mysqli_query($connect,$sql_img);
                        // hinh
                        while($dong2 = mysqli_fetch_array($imgalbum))
                        {
                            echo "
                            <div class='tieudetl' style='padding-top:20px;padding-left:10px;'>
                                <img class='hinhtdtl' src='".$dong2['pathalbum']."'>
                                <div class='ctchude'>
                                    <i class='tdtl'>$dong2[tenalbum]:</i>
                                    <i style='color:#fff; font-style:normal;font-weight:bold;font-size:20px;'>$row[bang] Bài hát</i>
                                </div>";
                        }
                        echo"</div>"; 
                        // kết nối lấy tất cả bài hát trong bảng mysusic có id album trùng với id chọn
                        $sql_albums = "select * from mysusic where albums = '".$idchon."'";
                        $kq = mysqli_query($connect,$sql_albums);
                        echo"
                            <ul>
                                <li style='width:100%;font-size:20px;font-weight:bold ; list-style:none;color:#fff; display:flex;justify-content:space-between;align-items: center;'>
                                    <div>Tiêu đề</div>
                                    <div style='position: relative;left:-30px'>Tên ca sĩ</div>
                                    <div style='position: relative;left:-80px'>Lượt nghe</div>
                                </li>
                            </ul>
                    ";
                        while($dong = mysqli_fetch_array($kq))
                        {
                            $nguon = $dong['pathbaihat'];
                            // setcookie('baihat',$nguon,time() + 120);
                            //điều hướng qua thẻ phát nhạc
                        echo "
                            <div class='chitietalbum'>
                                <ul>
                                    <li class='dsbaihat'>
                                        <img style='width:60px;height:60px;border-radius:10px;' src='".$dong['image']."'>
                                        <a class='chitietbh1' href='phatnhac.php?bh=$nguon'>
                                            $dong[tenbaihat]
                                        </a>
                                        <i class='tencasi'>$dong[tencasi]</i>
                                        <i class='lnghe fa fa-headphones'><i> </i>$dong[luotnghe]K</i>
                                    </li>
                                </ul>
                                    
                            </div>";
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