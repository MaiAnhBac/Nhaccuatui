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
                <?php
                if(isset($_GET['bh'])){
                    // lấy đường dẫn bài bát
                    $baihat = $_GET['bh'];
                    $connect = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
                    mysqli_query($connect,"set names 'utf-8'");
                    $sql_phatnhac = "select * from mysusic where pathbaihat = '".$baihat."'";
                    $kq = mysqli_query($connect,$sql_phatnhac);
                    while($dong = mysqli_fetch_array($kq))
                    {
                        // thẻ phát nhạc
                        echo "<div class='phatnhac'>
                            <img class='imgphatnhac' src='$dong[image]'>
                            <div class='chitietpn'>
                                <i class='tieudepn'>ĐANG PHÁT</i><br>
                                <i class='pntenbh'>Bài hát: $dong[tenbaihat]</i><br>
                                <i class='pntencasi'>Ca sĩ: $dong[tencasi]</i><br>
                                <i class='luotnghepn'>Lượt nghe: $dong[luotnghe]K</i>
                            </div>";
                            echo "<audio controls autoplay loop><source src='".$dong['pathbaihat']."' type='audio/mpeg'></audio>";
                        echo "</div>";
                    }
                    echo"<h1 style='color:#fff;font-weight:bold;margin-left:30px;'>Danh sách phát</h1>";
                    echo "<div class='scroll-box' style='width:100%;height:570px;overflow-y:scroll;'>";
                    echo"
                        <li style='width:100%;font-size:20px;font-weight:bold;list-style:none;color:#fff;display:flex;align-items:center;padding-top:10px;'>
                            <div style='position:relative;left:25px'>Tiêu đề</div>
                            <div style='position:relative;left:480px'>Tên ca sĩ</div>
                            <div style='position:relative;left:945px'>Lượt nghe</div>
                        </li>";
                    //cập nhật lượt nghe
                    $sql_update = "UPDATE mysusic SET luotnghe = luotnghe + 1 WHERE pathbaihat = '".$baihat."'";
                    $capnhatluotnghe = mysqli_query($connect,$sql_update);
                    //in ra danh sách bài hát
                    $sql_dsbh = "select * from mysusic";
                    $dsbh = mysqli_query($connect,$sql_dsbh);
                    while($dong = mysqli_fetch_array($dsbh))
                    {
                        // lấy đường dẫn của bài hát
                        $nguon = $dong['pathbaihat'];
                        echo "  
                        <li class='tracklistRow' style='margin-left:25px;height:50px;'>
                            <img style='width:50px;height:50px;box-sizing: border-box;border-radius:10px;' src='$dong[image]'/>
                            <div class='trackInfo'>
                                <a href='phatnhac.php?bh=$nguon'><span class='trackName'>".$dong['tenbaihat']."</span></a>
                            </div>
                            <div class='Info'>
                                <span class='artistName'>" . $dong['tencasi'] . "</span>
                            </div>
                            <div class='iconluotnghe'>
                                <i style='color:#fff' class='iconln fa fa-headphones'>  $dong[luotnghe]K</i>
                            </div>
                            <div class='trackOptions'>
                                <input type='hidden' class='songId' value='" . $dong['id'] . "'>
                                <button class='optionsButton' onclick='showOptionsMenu(this)'><i class='iconbh fa fa-ellipsis-h'></i></button>
                            </div>
                        </li>";           
                    }
                    echo "</div>";
                    // lịch sử nghe
                    if(isset($_SESSION['dn'])){
                    $sql_lichsu = "insert into lichsu(duongdan,user) values('".$baihat."','".$_SESSION['dn']."')";
                    $updatelichsu = mysqli_query($connect,$sql_lichsu);
                    mysqli_close($connect);
                    }
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