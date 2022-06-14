<!doctype html>
<html lang="en">

<head>
    <title>Bài Hát</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/new.css">
    <!-- Bootstrap CSS -->
</head>
<script>
    // khi lăn scroll thì sẽ ẩn list
    $(window).scroll(function() {
        hideOptionsMenu();
    });
    // post dl từ bên baihat sang xuly để xử lí thêm vào
    $(document).on("change", "select.playlist", function() { // element select, class playlist
        var select = $(this); // this: options value
        var playlistId = select.val();
        var songId = select.prev(".songId").val(); //prev: phan tu ngang hang truoc this (option)

        $.post('xuly.php', { playlistId: playlistId , songId: songId })
            .done(function(error) {
                if (error != "") {
                    alert(error);
                    return;
                }
                hideOptionsMenu();
                select.val("");
            });
    });
    // option menu
    function hideOptionsMenu() {
        var menu = $(".optionsMenu");
        if (menu.css("display") != "none") {
            menu.css("display", "none");
        }
    }
    ///////////////////////
    function showOptionsMenu(button) {
        var songId = $(button).prevAll(".songId").val(); // lay value cua input type hidden, class songId
        console.log(songId);
        var menu = $(".optionsMenu");
        var menuWidth = menu.width();
        menu.find(".songId").val(songId);

        var scrollTop = $(window).scrollTop(); //Distance from top of window to top of document
        var elementOffset = $(button).offset().top; //Distance from top of document

        var top = elementOffset - scrollTop;
        var left = $(button).position().left;

        menu.css({
            "top": top + "px",
            "left": left - menuWidth + "px",
            "display": "inline"
        });

    }
</script>

<body>
    <div class="music">
        <div class="c-left">
            <!-- Sử dụng mã lệnh thanh menu trái -->
            <?php include("left.php") ?>
        </div>
        <div class="c-mid">
            <?php
            $connect = mysqli_connect("localhost", "root", "", "demoweb") or die("Không kết nối được");
            mysqli_query($connect, "set names 'utf-8'");
            $sql_baihat = "select * from mysusic ORDER BY albums";
            $kq = mysqli_query($connect, $sql_baihat);
            echo"<h1 style='color:#fff;font-weight:bold;margin-left:30px;'>Danh sách bài hát</h1>";
            echo "<div class='scroll-box' style='width:100%;height:860px;overflow-y:scroll;'>";
            echo"
                <li style='width:100%;font-size:20px;font-weight:bold;list-style:none;color:#fff;display:flex;align-items:center;padding-top:10px;'>
                        <div style='position:relative;left:25px'>Tiêu đề</div>
                        <div style='position:relative;left:480px'>Tên ca sĩ</div>
                        <div style='position:relative;left:945px'>Lượt nghe</div>
                </li>";
            while ($dong = mysqli_fetch_array($kq)) {
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
            mysqli_close($connect);
            ?>
        </div>
        <div class="c-right">
            <?php include("right.php")?>
        </div>
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    </div>
    <nav class="optionsMenu">
        <input type="hidden" class="songId">
        <?php
            $connect = mysqli_connect("localhost", "root", "", "demoweb") or die("Không kết nối được");
            echo '<select class="item playlist">
                    <option value = "" >Thêm vào playlist</option>';
            $query = mysqli_query($connect, "SELECT * FROM playlist  WHERE  uscreate='" . $_SESSION['dn'] . "'");
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $name = $row['tenplist'];
                echo "<option value ='$id'>$name</option>";
            }
            echo "</select>";
            mysqli_close($connect); 
        ?>
    </nav>
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