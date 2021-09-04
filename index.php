<?php
session_start();
ob_start();
    if (!isset($_SESSION['user'])|| $_SESSION['user'] == null){
        header('Location:login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Quản lý chương trình đào tạo </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="modal fade" id="editpasswordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Đổi mật khẩu </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">

                <input type="hidden" name="userid" id="userid">

                <div class="form-group">
                    <label> Tài khoản </label>
                    <input type="text" name="username" id="username" class="form-control"readonly="">
                </div>
		<div class="form-group">
                    <label> Mật khẩu cũ</label>
                    <input type="password" name="password_old" id="password_old" class="form-control" placeholder="Nhập mật khẩu cũ">
                </div>
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="password_new" id="password_new" class="form-control" placeholder="Nhập mật khẩu mới">
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu mới</label>
                    <input type="password" name="password_new1" id="password_new1" class="form-control" placeholder="Nhập mật khẩu mới">
                </div>
            </div>
             <div class="alert alert-danger d-none">
            </div>
            <div class="alert alert-success d-none">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" id="changepass-btn" class="btn btn-primary">Chỉnh sửa</button>
            </div>
    </div>
  </div>
</div>    
<div id="menu">
  <ul>
    <li><a href="index.php?c=ctdt">Chương trình đào tạo</a></li>
    <li><a href="index.php?c=totnghiep">Xét tốt nghiệp</a></li>
    <?php 
        if (isset($_SESSION['user']) && $_SESSION['user'] != null && $_SESSION['user']['role'] == '2'){
    ?>
        <li><a href="index.php?c=user">Quản lý người dùng</a></li>
    <?php
        }
    ?>  
	<li style="margin-right: 20px;" class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Xin chào: <?php echo $_SESSION['user']['Name']; ?><span class="caret"></span></a>
             <ul class="dropdown-menu">
                 <li><a href="#" class = "btn_editpassword">Đổi mật khẩu</a></li>
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
    </li>
  </ul>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"> </script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"> </script>
  
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  
<style>
/*==Style cơ bản cho website==*/
body {
  font-family: sans-serif;
  color: #333;
}
#menu ul {
  background: #1F568B;
  list-style-type: none;
  text-align: center;
}
#menu li {
  color: #f1f1f1;
  display: inline-block;
  width: 200px;
  height: 40px;
  line-height: 40px;
  margin-left: -5px;
}
#menu a {
  text-decoration: none;
  color: #fff;
  display: block;
}
#menu a:hover {
  background: #F1F1F1;
  color: #333;
}
</style>
<script>

$(document).ready(function () {
    $('.btn_editpassword').on('click', function() { 
        var userid= '<?php echo $_SESSION['user']['id'];?>';
        var username= '<?php echo $_SESSION['user']['username'];?>';
        $('.modal-body #userid').val(userid);
        $('.modal-body #username').val(username);
        $('#editpasswordmodal').modal('show');        
    });
});

</script>
<script language="javascript">
            $(document).ready(function(){
                // Khi người dùng click thay đổi
                $('#changepass-btn').click(function(){
                    // Lấy dữ liệu
                    var data = {
                        userid          : $('#userid').val(),  
                        username        : $('#username').val(),
                        password_old    : $('#password_old').val(),
                        password_new    : $('#password_new').val(),
                        password_new1   : $('#password_new1').val()
                    }
                    // Gửi ajax
                    $.ajax({
                        type : "post",
                        dataType : "JSON",
                        url : "changepass.php",
                        data : data,
                        success : function(result)
                        {
                            // Có lỗi, tức là key error = 1
                            if (result.hasOwnProperty('error') && result.error == '1'){
                                var html = '';

                                // Lặp qua các key và xử lý nối lỗi
                                $.each(result, function(key, item){
                                    // Tránh key error ra vì nó là key thông báo trạng thái
                                    if (key != 'error'){ 
                                        html += '<li>'+item+'</li>';
                                    }
                                });
                                $('.alert-danger').html(html).removeClass('d-none');
                                $('.alert-success').addClass('d-none');
                            }
                            else{ // Thành công
                                $('.alert-success').html('Thay đổi mật khẩu thành công!').removeClass('d-none');
                                $('.alert-danger').addClass('d-none');

                                // 4 giay sau sẽ tắt popup
                                setTimeout(function(){
                                    $('#editpasswordmodal').modal('hide');
                                    // Ẩn thông báo lỗi
                                    $('.alert-danger').addClass('d-none');
                                    $('.alert-success').addClass('d-none');
                                }, 2000);
                                location.reload();
                            }
                        }
                    });
                });
            });
</script>
</body>
</html>
<?php
require_once "controller/ChuongTrinhDaoTaoController.php";
require_once "controller/MonHocController.php";
require_once "controller/TotNghiepController.php";
require_once "controller/UserController.php";

$controller = isset($_GET['c']) ? trim($_GET['c']) : '';
	switch ($controller){
	case "ctdt":
		$ctdt = new ChuongTrinhDaoTaoController();
		if (isset($_GET['m']) && $_GET['m'] == 'create'){	
			$ctdt->create();
		} else if (isset($_GET['m']) && $_GET['m'] == 'update'){	
			$ctdt->update();
		} else if (isset($_GET['m']) && $_GET['m'] == 'delete'){	
			$ctdt->delete();
		}  else if (isset($_GET['m']) && $_GET['m'] == 'change'){	
			$ctdt->change();
		} 
		else {
			$ctdt->index();
		}
		break;
	case "monhoc":
		$monhoc = new MonHocController();
		if (isset($_GET['m']) && $_GET['m'] == 'create'){	
			$monhoc->create();
		} else if (isset($_GET['m']) && $_GET['m'] == 'update'){	
			$monhoc->update();
		} else if (isset($_GET['m']) && $_GET['m'] == 'delete'){	
			$monhoc->delete();
		}
		else {
			$monhoc->index();
		}
		break;
	case "totnghiep":
		$totnghiep = new TotNghiepController();
		if (isset($_GET['m']) && $_GET['m'] == 'search'){	
			$totnghiep->search();
		}
		else {
			$totnghiep->index();
		}
		break;
	case "user":
            if ($_SESSION['user']['role'] == '2'){
		$user = new UserController();	
                if (isset($_GET['m']) && $_GET['m'] == 'change'){	
			$user->change();
		}else if (isset($_GET['m']) && $_GET['m'] == 'update'){	
			$user->update();
		}else if (isset($_GET['m']) && $_GET['m'] == 'delete'){	
			$user->delete();
		}
		else {
			$user->index();
		}
            } else {       
		header('Location:index.php?c=ctdt');
            }
                break;
	default:
		header('Location:index.php?c=ctdt');
		break;
	}
?>
