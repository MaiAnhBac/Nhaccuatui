<!-- Phần giữa -->
<div id="slnct" class="carousel slide myslide" data-ride="carousel">
    <!-- <ol class="carousel-indicators">
        <li data-target="#slnct" data-slide-to="0" class="active"></li>
        <li data-target="#slnct" data-slide-to="1"></li>
        <li data-target="#slnct" data-slide-to="2"></li>
        <li data-target="#slnct" data-slide-to="3"></li>
    </ol>
        <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img src="../img/lalisa.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img src="../img/rapviet.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img src="../img/diquacauvong.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img src="../img/cuoingaydi.jpg" alt="">
        </div>
        </div>
        <a class="carousel-control-prev" href="#slnct" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slnct" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a> -->
        <!-- bai hat -->
        <div class="newmusic">
            <div class="listalbum">
                <div class="chude">ALBUM ÂM NHẠC</div>
                    <ul>
                        <?php
                            $connect = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
                            $sql_albums = "select * from album";
                            $thuchien = mysqli_query($connect,$sql_albums);
                            while($row = mysqli_fetch_array($thuchien)) 
                            {
                                // lấy id trong bảng album
                                $machon = $row['id'];
                                // lấy đường dẫn ảnh trong csdl, điều hướng qua trang chi tiết
                                echo "<li>
                                        <div class='_1item'>
                                            <img src='".$row['pathalbum']."'>
                                                <a href='chitiet.php?ma=$machon'>
                                                    <span class='while'></span>
                                                    <i class='fa fa-play'></i>
                                                </a>
                                        </div>  
                                        <p class='name'><a href='chitiet.php?ma=$machon' class='ss'>".$row['tenalbum']."</a></p>                                 
                                    </li>";
                            }
                            mysqli_close($connect);
                        ?>
                    </ul>
            </div>
        </div>
</div>