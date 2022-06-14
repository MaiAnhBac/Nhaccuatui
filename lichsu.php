<!doctype html>
<html lang="en">
  <head>
    <title>Lịch Sử Nghe Nhạc</title>
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
                    if(isset($_SESSION['dn'])){
                        $connect = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
                        mysqli_query($connect,"set names 'utf-8'");
                        $sql_lichsu = "select mysusic.image,mysusic.tenbaihat,mysusic.tencasi,mysusic.luotnghe,lichsu.id from mysusic,lichsu 
                                        where mysusic.pathbaihat = lichsu.duongdan and lichsu.user = '".$_SESSION['dn']."' ORDER BY lichsu.id DESC";
                        $kq = mysqli_query($connect,$sql_lichsu);
                        while($dong = mysqli_fetch_array($kq))
                        { 
                            echo "<img src='".$dong['image']."'>$dong[tenbaihat]-$dong[tencasi]-$dong[luotnghe]<a href='xoals.php?id=$dong[id]'>Xóa</a><br>";
                        }
                        echo "<a href='xoaallls.php'>Xóa tất cả</a>";
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