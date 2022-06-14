<!doctype html>
<html lang="en">

<head>
    <title>Bảng Xếp Hạng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
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
</script>

<body>
    <div class="music">
        <div class="c-left">
            <!-- Sử dụng mã lệnh thanh menu trái -->
            <?php include("left.php") ?>
        </div>
        <div class="c-mid">
        </div>
        <div class="c-right">
            <!-- ///////////////////// -->
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