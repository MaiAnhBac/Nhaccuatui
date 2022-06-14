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
                        echo "<img src='$dong[image]'>";
                        echo "$dong[tencasi]";
                        echo "<audio controls autoplay loop><source src='".$dong['pathbaihat']."' type='audio/mpeg'></audio>";
                    }
                    //cập nhật lượt nghe
                    $sql_update = "UPDATE mysusic SET luotnghe = luotnghe + 1 WHERE pathbaihat = '".$baihat."'";
                    $capnhatluotnghe = mysqli_query($connect,$sql_update);
                    //in ra danh sách bài hát của playlist                  
                    if(isset($_GET['idpls'])){
                        $idplaylist = $_GET['idpls'];       
                    $sql_dsbh = "select mysusic.pathbaihat,mysusic.id,mysusic.tenbaihat,mysusic.image,mysusic.tencasi,playlist.id,playlist.tenplist,playlist.uscreate,addplaylist.musicadd,addplaylist.playlistadd
                                 from mysusic,playlist,addplaylist where mysusic.id = addplaylist.musicadd and playlist.id = addplaylist.playlistadd and playlistadd = $idplaylist";
                    $dsbh = mysqli_query($connect,$sql_dsbh);
                    echo "<table align = 'center'>";
                    echo "<tr><td colspan = '2' align = 'center'>Danh Sách Phát Playlist </td></tr>";
                    while($dong = mysqli_fetch_array($dsbh))
                    {
                        // lấy đường dẫn của bài hát
                        $nguon = $dong['pathbaihat'];
                        $idpls = $dong['playlistadd'];
                        echo "<tr>
                        <td><a href='phatnhacpls.php?bh=$nguon&idpls=$idpls'>".$dong['tenbaihat']."</td><td>".$dong['tencasi']."</td></tr>";               
                    }
                    echo "</table>";
                    }
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