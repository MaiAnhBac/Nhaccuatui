<?php
  session_start();
?>
<!-- Trang đăng nhập -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Đăng Nhập</title>
</head>
<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <h1>Đăng nhập</h1>
            <div class="ghi">
                <i class="fa fa-user"></i>
                <input type="text" name="tendangnhap" placeholder="Tên đăng nhập" value="<?php if (isset($_COOKIE['tendangnhap'])) echo $_COOKIE['tendangnhap'];?>">
            </div>
            <div class="ghi">
                <i class="fa fa-lock"></i>
                <input type="password" name="matkhau" placeholder="Mật khẩu" value="<?php if (isset($_COOKIE['matkhau'])) echo $_COOKIE['matkhau']; ?>">
            </div>
            <div class="cbkluu">
                <label><input type="checkbox" name="luu" class="cbk"/>Lưu tài khoản</label>
            </div>
            <input type="submit" class="btndn" value="Đăng Nhập"></input>
            <div class="tao">
                <i>Bạn chưa có tài khoản?</i>
                <a href="dangky.php">
                    Đăng ký
                </a>
            </div>
        </form>
    </div>
    <?php
        if(isset($_POST['tendangnhap']) && isset($_POST['matkhau']))
        {
            $tendn = $_POST['tendangnhap'];
            $matkhau = $_POST['matkhau'] ;
            $kn = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
            mysqli_query($kn,"set names 'utf8'");
            // xây dựng câu lệnh cho kết nối
            $sql_dn = "select * from account where tendangnhap = '".$tendn."'";
            //thực thi câu lệnh
            $thucthi = mysqli_query($kn,$sql_dn) or die ("Không thực hiện được");
            // lấy kết quả trả về 
            if($tendn=="")
            {
                echo "<script type='text/javascript'>alert('Vui lòng nhập tên đăng nhập!');</script>";
            }
            else{         
            if($dong=mysqli_fetch_array($thucthi))
            {
                $gt = $dong['matkhau'];
                if($gt != $matkhau)
                {
                    echo "<script type='text/javascript'>alert('Nhập sai mật khẩu!');</script>";
                }
                else {
                    if(isset($_POST['luu'])){
                        setcookie('tendangnhap',$tendn,time() + 60*60*24*30);
                        setcookie('matkhau',$matkhau,time() + 60*60*24*30);
                    }
                    $_SESSION['dn'] = $tendn;
                    header('location:index.php');
                }
            }
            else echo "<script type='text/javascript'>alert('Tài khoản chưa đăng kí!');</script>";
            }
            // dọn tài nguyên
            mysqli_free_result($thucthi);
            // đóng kết nối
            mysqli_close($kn);
        }      
    ?>
</body>
</html>