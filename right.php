<?php
            $connect = mysqli_connect("localhost", "root", "", "demoweb") or die("Không kết nối được");
            mysqli_query($connect, "set names 'utf-8'");
            $sql_bxh = "select * from mysusic ORDER BY luotnghe DESC LIMIT 10";
            $kq = mysqli_query($connect, $sql_bxh);
            echo "<h1 style='color:#fff;font-weight:bold;margin-left:47px;margin-right:-5px;padding:0;'>Bảng xếp hạng</h1>";
            echo "<div class='scroll-box' style='width:100%;height:890px;overflow-y:scroll;margin-top:-30px;'>";
            echo "
                <li style='list-style:none;'>
                    <i style='position:relative;bottom:-61px;font-style:normal;font-weight:bold;font-size:30px;left:14px;color:#DCD800'>1</i>
                    <i style='position:relative;bottom:-145px;font-style:normal;font-weight:bold;font-size:30px;left:-4px;color:#00A6AD'>2</i>
                    <i style='position:relative;bottom:-227px;font-style:normal;font-weight:bold;font-size:30px;left:-22px;color:#5BBD2B'>3</i>
                    <i style='position:relative;bottom:-307px;font-style:normal;font-weight:bold;font-size:20px;left:-39px;color:white'>4</i>
                    <i style='position:relative;bottom:-390px;font-style:normal;font-weight:bold;font-size:20px;left:-53px;color:white'>5</i>
                    <i style='position:relative;bottom:-470px;font-style:normal;font-weight:bold;font-size:20px;left:-67px;color:white'>6</i>
                    <i style='position:relative;bottom:-551px;font-style:normal;font-weight:bold;font-size:20px;left:-81px;color:white'>7</i>
                    <i style='position:relative;bottom:-633px;font-style:normal;font-weight:bold;font-size:20px;left:-96px;color:white'>8</i>
                    <i style='position:relative;bottom:-715px;font-style:normal;font-weight:bold;font-size:20px;left:-109px;color:white'>9</i>
                    <i style='position:relative;bottom:-798px;font-style:normal;font-weight:bold;font-size:20px;left:-128px;color:white'>10</i>
                </li>";
            while ($dong = mysqli_fetch_array($kq)) {
                // lấy đường dẫn của bài hát
                $nguon = $dong['pathbaihat'];
                echo "  
                    <div class='bxh'>
                        <img class='imgbxh' src='$dong[image]'>
                        <div class='tenbxh'>
                            <a class='link' href='phatnhac.php?bh=$nguon'>" . $dong['tenbaihat'] . "</a>
                            <i>" . $dong['tencasi'] . "</i>
                            <i class='luotnghebxh'>Số lượt nghe: $dong[luotnghe]K</i>
                        </div>                                        
                    </div>";
            }
            echo "</div>";
            mysqli_close($connect);
            ?>