<?php
    session_start()
?>
<!-- Thanh menu trái -->
<div class="headerL">
                <a class="logo" href="index.php"><img src="../img/nct.png" alt=""></a>
                <a class="up" href="">Nâng cấp</a>
            </div>
            <div class="login">
                <div class="left">
                    <span>
                        <?php
                            // lấy session tên đăng nhập
                            if(isset($_SESSION['dn']))
                            { 
                                echo '<div class="user"><i class="fa fa-user"></i>'.$_SESSION['dn'].'</div></span>';
                            }
                            else echo "<span><a href='dangnhap.php'>Đăng nhập</a></a></span> | <span><a href='dangky.php'>Đăng ký</a></span>"
                        ?>                 
                </div>
                <i class="fa fa-cog"></i>
            </div>
            <div class="menu">
            <!-- tao thu gon noi dung -->
                <ul>
                    <li class="search">
                        <a href="timkiem.php">
                            <i class="fa fa-search"></i>
                            <p>Tìm kiếm</p>
                        </a>
                    </li>
                    <li class="search">
                        <a href="index.php">
                            <i class="fa fa-home"></i>
                            <p>Trang chủ</p>
                        </a>
                    </li>
                    <li class="compass active">
                        <div class="nd">
                            <i class="fa fa-compass"></i>
                            <p>Khám phá</p>
                            <span class="arow fa fa-chevron-down"></span>
                        </div>
                        <div class="list">
                            <ul>
                                <li><a href="baihat.php">Bài hát</a></li>
                                <!-- <li><a href="">Playlist</a></li> -->
                                <li><a href="theloai.php">Thể loại</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="search">
                        <a href="bxh.php">
                            <i class="fa fa-bar-chart"></i>
                            <p>BXH NCT</p>
                        </a>
                    </li> -->
                    <!-- khi có session đăng nhập sẽ hiện ra chức năng upload -->
                    <?php if(isset($_SESSION['dn']))
                    {
                        echo 
                        "<div class='lb'>
                            <h3>Cá nhân</h3>
                        </div>
                        <ul class='item'>
                            <li>
                                <a href='upload.php'>
                                    <i class='fa fa-cloud-upload'></i>
                                    <p>Upload</p>
                                </a>
                            </li>
                            <li>
                                <a href='playlist.php'>
                                    <i class='fa fa-list'></i>
                                    <p>Playlist</p>
                                </a>
                            </li>
                            <li>
                                <a href='doimatkhau.php'>
                                    <i class='fa fa-key'></i>
                                    <p>Đổi mật khẩu</p>
                                </a>
                            </li>
                            <li>
                                <a href='out.php'>
                                    <i class='fa fa-sign-out'></i>
                                    <p>Đăng xuất</p>
                                </a>
                            </li>
                        </ul>";
                    }
                    ?>
                </ul>
            </div>