<!-- Trang đăng ký -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/dangky.css">
    <title>Đăng Kí</title>
</head>
<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <h1>Đăng ký</h1>
            <div class="ghi">
                <input type="text" name ="mail" placeholder="Nhập email">
            </div>
            <div class="ghi">
                <input type="text" name="taikhoan" placeholder="Tên đăng nhập">
            </div>
            <div class="ghi">
                <input type="password" name="pass" placeholder="Nhập mật khẩu">
            </div>
            <div class="ghi">
                <input type="password" name="repass" placeholder="Nhập lại mật khẩu">
            </div>
            <input type="submit" class="btndk" value="Đăng Ký"></input>
            <div class="tao">
                <i>Bạn đã có tài khoản?</i>
                <a href="dangnhap.php">
                    Đăng nhập
                </a>
            </div>
        </form>
    </div>
    <?php
        // nếu 3 biến tồn tại, thì mới thực hiện
        if(isset($_POST['mail']) && isset($_POST['taikhoan']) && isset($_POST['pass']) && isset($_POST['repass']))
        {
            $email = $_POST['mail'];
            $tendangnhap = $_POST['taikhoan'];
            $pass = $_POST['pass'];
            $repass = $_POST['repass'];
            $ketnoi = mysqli_connect("localhost","root","","demoweb") or die ("Không kết nối được");
            // quy định bảng mã cho kết nối
            mysqli_query($ketnoi,"set names 'utf8'");
            // xây dựng câu lệnh cho kết nối
            $sql_dk = "insert into account(tendangnhap,matkhau,email) values('".$tendangnhap."','".$pass."','".$email."')";
            //thực thi câu lệnh
            $regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
            if(!preg_match($regex, $email))
            {
                echo "<script type='text/javascript'>alert('Email không hợp lệ!');</script>";
            }
            else
            {
                if($pass != $repass)
                {
                        echo "<script type='text/javascript'>alert('Mật khẩu nhập lại không đúng!');</script>";
                }
                else
                {
                    //kiểm tra tk đăng kí có trùng hay không
                    $sql_sosanh = "select *from account where tendangnhap ='".$tendangnhap."'";
                    $kiemtra = mysqli_query($ketnoi,$sql_sosanh);
                    if($tendangnhap == "")
                    {
                        echo "<script type='text/javascript'>alert('Không được bỏ trống tên đăng nhập !');</script>";
                    }
                    else
                    {
                        if(($dong=mysqli_fetch_array($kiemtra)))
                            echo "<script type='text/javascript'>alert('Tên đăng nhập đã tồn tại!');</script>";                 
                        else
                        {
                            //thêm vào bảng
                            $ketqua = mysqli_query($ketnoi,$sql_dk) or die ("Không thực hiện được");
                            if($ketqua)
                            {
                                echo "<script type='text/javascript'>alert('Đăng kí thành công!');</script>";
                            }
                            else 
                            {
                                echo "<script type='text/javascript'>alert('Đăng kí không thành công!');</script>";
                            }
                        }
                    }
                }
            }
            // dọn tài nguyên
            // đóng kết nối
            mysqli_close($ketnoi);
        }
    ?>
</body>
</html>