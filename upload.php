<!doctype html>
<html lang="en">
<head>
<title>Upload</title>
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
            <form class='upload' method="post" enctype="multipart/form-data">
                <h1 style="color:white; margin-left:135px;">Upload</h1>
                <label>Nhập tên bài hát</label>
                <input type="text" name="title"><br>           
                <label>Nhập tên ca sĩ</label>
                <input type="text" name="tencasi"><br>
                <label>Chọn albums</label>
                <!-- lấy album đưa vào dropdownlist -->
                <?php
                $connect = mysqli_connect("localhost", "root", "", "demoweb") or die("Không kết nối được");
                    echo '<select style="width:177px; height:30px;border-radius: 5px;" name="albums">
                            <option value = "" >Chọn Album</option>';
                    $query = mysqli_query($connect, "SELECT * FROM album");
                    while ($row = mysqli_fetch_array($query)) {
                        $id = $row['id'];
                        $name = $row['tenalbum'];
                        echo "<option value ='$id'>$name</option>";
                    }
                    echo "</select>";
                    mysqli_close($connect); 
                ?><br>
                <label>Chọn thể loại</label>
                <!-- lấy thể loại đưa vào dropdownlist -->
                <?php
                $connect = mysqli_connect("localhost", "root", "", "demoweb") or die("Không kết nối được");
                    echo '<select style="width:177px;height:30px;border-radius: 5px;" name="theloai">
                            <option value = "" >Chọn thể loại</option>';
                    $query = mysqli_query($connect, "SELECT * FROM theloai");
                    while ($row = mysqli_fetch_array($query)) {
                        $id = $row['id'];
                        $name = $row['theloainhac'];
                        echo "<option value ='$id'>$name</option>";
                    }
                    echo "</select>";
                    mysqli_close($connect); 
                ?>
                <br>
                <label>Chọn bài hát</label>
                <input class="ipfile" type="File" name="file"/>
                <input class="submitul" type="submit" name="submit" value="Upload"><br>
            </form>
            <?php 
                if(isset($_SESSION['dn'])){
                $connect = mysqli_connect("localhost","root","","demoweb"); 
                if (isset($_POST["submit"]))
                {
                    $title = $_POST["title"];
                    $albums = $_POST["albums"];
                    $tencasi = $_POST["tencasi"];
                    $theloai = $_POST["theloai"];
                    // tên file
                    $pname ="music/".$_FILES["file"]["name"]; 
                    // lấy phần chính
                    $phanchinh = explode('.',$pname);
                    //lấy phần mở rộng
                    $phanmr = end($phanchinh);
                    // kiểm tra có phải là file .mp3 hay không
                    if($phanmr=='mp3')
                    {
                        // upload
                        move_uploaded_file($_FILES["file"]["tmp_name"],$pname);        
                        // đưa vào csdl
                        $sql_upload = "INSERT into mysusic(tenbaihat,pathbaihat,tencasi,albums,loai,image) VALUES('$title','$pname','$tencasi','$albums','$theloai','image/user.png')";
                            {
                                if($title == "")
                                { 
                                    echo "<i class='thongbaoul'>Vui lòng nhập tên bài hát</i>";
                                }
                                else
                                {
                                    if($tencasi == "")
                                    {
                                        echo "<i class='thongbaoul'>Vui lòng nhập tên ca sĩ</i>";
                                    }
                                    else
                                    {
                                        if($albums =="")
                                        {
                                            echo "<i class='thongbaoul'>Vui lòng nhập tên albums</i>";
                                        }
                                        else
                                        {
                                            if(mysqli_query($connect,$sql_upload)){
                                        
                                            echo "<i class='thongbaoul'>Upload thành công</i>";
                                            }
                                            else{
                                                echo "Upload không thành công";
                                            }
                                        }
                                    }
                                }
                            }
                        } 
                        else echo "<i class='thongbaoul'>Vui lòng chọn tệp .mp3</i>";
                }
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
