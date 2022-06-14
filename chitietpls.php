<!doctype html>
<html lang="en">

<head>
    <title>Trang chủ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/new.css">
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

        $.post('xuly.php', {
                playlistId: playlistId,
                songId: songId
            })
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
    ///////////
    function removeFromPlaylist(button, playlistId) {
        var songId = $(button).prevAll(".songId").val();
        $.post("removePls.php", {
                playlistId: playlistId,
                songId: songId
            })
            .done(function(error) {
                if (error != "") {
                    alert(error);
                    return;
                }
                location.reload();
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
            //chi tiết playlist theo id
            $id = $_GET['id'];
            $connect = mysqli_connect("localhost", "root", "", "demoweb");
            $sql_ctpls = "Select * from playlist where id = '" . $id . "'"; 
            $createpls2 = mysqli_query($connect, $sql_ctpls);
            while ($dong = mysqli_fetch_array($createpls2)) {
                echo "
                        <div class='tieudetl' style='padding-top:20px;padding-left:20px;'>
                            <img class='hinhtdtl' src='image/playlist.jpg'>
                            <i style='color:white;font-weight:bold;font-style:normal;font-size:25px;position:relative;top:-130px;left:15px;'>$dong[tenplist]</i>
                        </div>
                        <a href='xoapls.php?id=$dong[id]' 
                            style='text-decoration:none;color:black;position:relative;top:-115px;left:287px;border:1px solid white;padding:5px;background:white;border-radius:7px;'>
                            Xóa playlist
                        </a>";
            }
            //lấy nhạc đã thêm vào playlist dựa vào id
            $sql_musicpls = "Select mysusic.tencasi,mysusic.luotnghe,mysusic.image,mysusic.pathbaihat,mysusic.id,mysusic.tenbaihat,addplaylist.musicadd,addplaylist.playlistadd
                                 from mysusic,addplaylist where playlistadd = '" . $id . "' and mysusic.id = addplaylist.musicadd";
            $createpls = mysqli_query($connect, $sql_musicpls);
            echo"<h2 style='color:#fff;font-weight:bold;margin-left:30px;'>Danh sách bài hát</h2>";
            echo"
                <li style='width:100%;font-size:20px;font-weight:bold;list-style:none;color:#fff;display:flex;align-items:center;padding-top:10px;'>
                        <div style='position:relative;left:25px'>Tiêu đề</div>
                        <div style='position:relative;left:480px'>Tên ca sĩ</div>
                        <div style='position:relative;left:945px'>Lượt nghe</div>
                </li>";
            while ($dong2 = mysqli_fetch_array($createpls)) {
                $nguon = $dong2['pathbaihat'];
                $idpls = $dong2['playlistadd'];
                echo "
                        <li class ='tracklistRow' style='margin-left:25px;height:50px;'>
                            <img style='width:50px;height:50px;box-sizing: border-box;border-radius:10px;' src='$dong2[image]'/>
                            <div class='trackInfo'>
                                <a href='phatnhacpls.php?bh=$nguon&idpls=$idpls'><span class='trackName'>" . $dong2['tenbaihat'] . "</span></a>
                                <span class='artistName'></span>
                            </div>
                            <div class='Info'>
                                <span class='artistName'>" . $dong2['tencasi'] . "</span>
                            </div>
                            <div class='iconluotnghe'>
                                <i style='color:#fff' class='iconln fa fa-headphones'>  $dong2[luotnghe]K</i>
                            </div>
                            <div class='trackOptions'>
                                <input type='hidden' class='songId' value='" . $dong2['id'] . "'>
                                <button class='optionsButton' onclick='showOptionsMenu(this)'><i class='iconbh fa fa-ellipsis-h'></i></button>
                            </div>
                        </li>";
            }
            mysqli_close($connect);
            ?>
        </div>
        <div class="c-right">
            <?php include("right.php")?>
        </div>
    </div>
    <nav class="optionsMenu">
        <input type="hidden" class="songId">
        <?php
        if (isset($_GET['id'])) {
            $playlistId = $_GET['id'];
        } 
        ?>
        <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">
            <i style="font-style:normal;font-size:20px;position:relative;top:4px;left:4px;">Xóa bài hát</i>
        </div>
    </nav>
</body>

</html>