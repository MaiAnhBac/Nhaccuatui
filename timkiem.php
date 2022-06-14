<!doctype html>
<html lang="en">

<head>
    <title>Tìm kiếm</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
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
            echo
            '<form class="tk"  action="" method ="GET">
                <input type="text" name="search" placeholder="Nhập từ khóa cần tìm">                  
                <button>Tìm</button>
            </form>';
            if (isset($_GET['search'])) {
                $connect = mysqli_connect("localhost", "root", "", "demoweb");
                if (isset($_GET["search"]) && !empty($_GET["search"])) {
                    // lấy giá trị từ ô search
                    $key = $_GET["search"];
                    // câu lệnh sql tìm kiếm
                    $sql_timkiem = "SELECT * FROM mysusic WHERE tenbaihat LIKE '%$key%' OR tencasi LIKE '%$key%'";
                    $result = mysqli_query($connect, $sql_timkiem);
                    while ($row = mysqli_fetch_array($result)) {
                        $luotnghe = $row["luotnghe"];
                        $tenbaihat = $row["tenbaihat"];
                        $tencasi = $row["tencasi"];
                        $nguon = $row['pathbaihat'];
                        $image = $row['image'];
                        echo
                        "<h2 style='color:white;margin-left:17px;margin-top:30px;'>Kết quả tìm kiếm</h2>
                                        <div class='kq'>
                                            <img class='imgbh' src='$image'>
                                            <div class='tenbh'>
                                                <a class='link' href='phatnhac.php?bh=$nguon'>" . $tenbaihat . "</a>
                                                <i>" . $tencasi . "</i>
                                                <i>Số lượt nghe: $luotnghe</i>
                                            </div>                                        
                                        </div>";
                        // thêm vào ls tìm kiếm
                        if ($tenbaihat == $key) {
                            echo "";
                        } else {
                            $sql_search = "insert into lstimkiem(pathbh) values ('" . $tenbaihat . "')";
                            $result_search = mysqli_query($connect, $sql_search);
                            $sql_updateluottk = "UPDATE lstimkiem SET luottimkiem = luottimkiem + 1 where pathbh = '" . $tenbaihat . "'";
                            $capnhatluottk = mysqli_query($connect, $sql_updateluottk);
                        }
                    }
                    //ẩn lịch sử tìm kiếm khi có kq tìm kiếm
                    if ($result == true) {
                        echo
                        "<script>
                                        $(function(){
                                            $('.show').hide();
                                        });
                                    </script>";
                    }
                } else echo "<h6>Nhập tên bài hát hoặc tên ca sĩ</h6>";
                mysqli_close($connect);
            }
            // đổ ra khi ấn vào chức năng tìm kiếm
            $connect = mysqli_connect("localhost", "root", "", "demoweb");
            $sql_show = "select DISTINCT mysusic.luotnghe,mysusic.pathbaihat,mysusic.tenbaihat,mysusic.tencasi,mysusic.image,lstimkiem.pathbh from mysusic,lstimkiem 
                                where mysusic.tenbaihat = lstimkiem.pathbh ORDER BY luottimkiem DESC LIMIT 6";
            $result_show = mysqli_query($connect, $sql_show);
            echo "<div class='show'>";
            echo "<h2 style='margin-top:5px;margin-left:10px'>Tìm kiếm nổi bật</h2>";
            while ($dong = mysqli_fetch_array($result_show)) {
                $nguon = $dong['pathbaihat'];
                echo "<div class='kq'>
                        <img class='imgbh' src='$dong[image]'>
                        <div class='tenbh'>
                            <a class='link' href='phatnhac.php?bh=$nguon'>" . $dong['tenbaihat'] . "</a>
                            <i>" . $dong['tencasi'] . "</i>
                            <i>Số lượt nghe: $dong[luotnghe]</i>
                        </div>                                        
                    </div>";
            }
            mysqli_close($connect);
            echo "</div>";
            ?>
        </div>
        <div class="c-right">
            <?php include("right.php")?>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        $(document).ready(function() {
            $('.compass.active .list').slideDown();
            $('.nd').click(function() {
                $(this).parent().toggleClass('active')
                $(this).parent().children('.list').slideToggle();
            });
        });
    </script>
</body>

</html>