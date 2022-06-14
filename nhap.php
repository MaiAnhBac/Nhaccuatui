<!doctype html>
<html lang="en">
<head>
<title></title>
<!-- Required meta tags -->
<meta charset="utf-8">
</head>
<body>
            <form method="post">
                <label>Chọn albums</label>
                <select style="width:177px; height:30px;border-radius: 5px;" name="hocki">
                    <option value="Học kì 1" selected="selected">Học kì 1</option>
                    <option value="Học kì 2">Học kì 2</option>
                    <option value="Học kì 3">Học kì 3</option>
                    <option value="Học kì 4">Học kì 4</option>
                    <option value="Học kì 5">Học kì 5</option>
                </select><br>
                <input type="submit" name="submit" value="Upload"><br>
            </form>
            <?php 
                $connect = mysqli_connect("localhost","root","","demoweb"); 
                if (isset($_POST["submit"]))
                {
                    $title = $_POST["hocki"];
                    $sql_upload = "select * from ..... where .... = $title";
                    while($dong = mysqli_fetch_array($sql_upload)){
                        echo " in mấy cái trong bảng ra theo như đề ";

                    }
                }
                mysqli_close($connect);
            ?>
    </body>
</html>
