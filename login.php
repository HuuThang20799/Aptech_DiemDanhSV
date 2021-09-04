<?php
session_start();
require_once "model/user_ctdt.php";
require_once "model/lich_su_dang_nhap.php";
$message='';
	if (isset($_POST['btnLogin'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$u = new user_ctdt();
                $login_log = new lich_su_dang_nhap();
		$rs = $u->check_user($username,$password);
		if ($rs != false && isset($rs['id']) && $rs['status'] == '1' ){
                    $_SESSION['user'] = $rs;
                    $user_id = $rs['id'];
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $thoigian = date('m/d/Y H:i:s', time());
                    $result = $login_log->create($user_id,$thoigian);
                    //header('Location:index.php?c=ctdt');
                    header('Location:hindex.php');
                    exit();
		} else if (isset($rs['status']) && $rs['status']== '0'){
			$message = "Tài khoản đã bị vô việu hóa, vui lòng liên hệ Admin";
		} else {                
                    $message = "Sai tên đăng nhập hoặc mật khẩu";
                }
		
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Đăng nhập</title>
 <!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords"/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme  -->
<link rel="stylesheet" href="css/style_login.css">
   <!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  </head>
  <body>
<div class="login-form w3_form">
  <!--  Title-->
      <div class="login-title w3_title">
           <h1>ứng dụng hỗ trợ xét tốt nghiệp</h1>
      </div>
           <div class="login w3_login">
                <h2 class="login-header w3_header">Đăng nhập</h2>
		<div class="w3l_grid">
                <form class="login-container" action="login.php" method="post">
                <input type="text" placeholder="Tên đăng nhập" Name="username" required="" >
                <input type="password" placeholder="Mật khẩu" Name="password" required="">
                <input type="submit" name ="btnLogin" value="Đăng nhập">
		<p style="color:red;"><?php echo $message;?></p>
                </form>
		</div>
	    </div> 
</div>
</body>
</html>