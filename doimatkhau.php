<!DOCTYPE html>
<html lang="en">
<head>
<title>Đổi mật khẩu</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/new.css">
    <link rel="stylesheet" href="../css/doimk.css">
    <!-- Bootstrap CSS -->
</head>
<body>
    <div class="music">
        <div class="c-left">
            <!-- Sử dụng mã lệnh thanh menu trái -->
            <?php include("left.php") ?>
        </div>
        <div class="c-mid">
            <form class="doimk" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <h1>Đổi mật khẩu</h1>
                <div style='position:relative;top:-10px;font-size:20px;' align = "center">
                    <h2 style='color:#7FFF00;'><?php if(isset($_SESSION['dn'])){ echo "Chào  ".$_SESSION['dn'];}?></h2>
                </div>
                <div class="ghi">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="matkhaucu" placeholder="Nhập mật khẩu cũ">
                </div>
                <div class="ghi">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="matkhaumoi" placeholder="Nhập mật khẩu mới">
                </div>
                <div class="ghi">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="rematkhaumoi" placeholder="Nhập lại mật khẩu mới">
                </div>
                <input type="submit" class="btndn" value="Thay đổi"></input>
                <div class="tao">
                    <a href="dangnhap.php">
                        Đăng nhập lại
                    </a>
                </div>
            </form>
        </div>
        <div class="c-right">
            <?php include("right.php")?>
        </div>
    </div>
    <?php
        if(isset($_SESSION['dn']) && isset($_POST['matkhaucu']) && isset($_POST['matkhaumoi']) && isset($_POST['rematkhaumoi']))
        {
            // lấy dl từ form
            $mkc = $_POST['matkhaucu'];
            $mkm1 = $_POST['matkhaumoi'];
            $mkm2 = $_POST['rematkhaumoi'];
            // lấy dữ liệu từ biến session
            $tendn = $_SESSION['dn'];
            // kết nối mysql
            $connect = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
            mysqli_query($connect,"set names 'utf-8'");
            $sql_dmk = "select * from account where tendangnhap = '".$tendn."'";
            $kq = mysqli_query($connect,$sql_dmk);
            if($dong = mysqli_fetch_array($kq))
            {
                if($dong['matkhau'] == $mkc)
                {
                    if($mkm1 == $mkm2)
                    {
                        // update lại mk mới vào csdl
                        $sql_doimatkhau = "update account set matkhau = '".$mkm1."' where tendangnhap = '".$tendn."'";
                        if(mysqli_query($connect,$sql_doimatkhau))
                        {
                            echo "<script type='text/javascript'>alert('Đổi mật khẩu thành công!');</script>";
                        }
                        else echo "<script type='text/javascript'>alert('Không đổi được mật khẩu!');</script>";
                    }
                    else echo "<script type='text/javascript'>alert('Mật khẩu nhập lại không đúng!');</script>";
                }
                else echo "<script type='text/javascript'>alert('Mật khẩu cũ không đúng!');</script>";
            }
            mysqli_close($connect);
        }
    ?>
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