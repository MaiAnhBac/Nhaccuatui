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
                    //lấy biến ma đã chọn bên trang thể loại
                    $idchon = $_GET['ma'];
                    // kết nối mysql
                    $connect = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
                    mysqli_query($connect,"set names 'utf-8'");
                    $sql_img = "select * from theloai where id = '".$idchon."'";
                    $imgalbum = mysqli_query($connect,$sql_img);                   
                    while($dong2 = mysqli_fetch_array($imgalbum))
                    {
                        echo "
                            <div class='tieudetl' style='padding-top:20px;padding-left:20px;'>
                                <img class='hinhtdtl' src='".$dong2['imgalbum']."'>
                                <i style='color:white;font-weight:bold;font-style:normal;font-size:25px;position:relative;top:-130px;left:5px;'>$dong2[theloainhac]</i>
                            </div>";      
                    }
                    // lấy tất cả bài hát có id thể loại trùng với id chọn
                    echo"<h2 style='color:#fff;padding-top:20px;padding-left:20px;'>Danh sách bài hát</h2>";
                    $sql_music = "select * from mysusic where loai = '".$idchon."'";
                    $kq = mysqli_query($connect,$sql_music);
                    echo "<div class='scroll-box' style='width:100%;height:565px;overflow-y:scroll;scrollbar-width:none;'>";
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
                        echo "
                        <div class='chitietalbum'>
                            <ul>
                                <li class='dsbaihat'>
                                    <img style='width:60px;height:60px;border-radius:10px;' src='".$dong['image']."'>
                                    <a class='chitietbh1' href='phatnhac.php?bh=$nguon'>
                                        $dong[tenbaihat]
                                    </a>
                                    <i class='tencasi'>$dong[tencasi]</i>
                                    <i class='lnghe fa fa-headphones'><i>    </i>$dong[luotnghe]k</i>
                                </li>
                            </ul>
                                
                        </div>";   
                    }
                    echo"</div>";
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