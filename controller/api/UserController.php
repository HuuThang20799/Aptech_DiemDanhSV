<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once "config/Database.php";
require_once "model/mon_hoc.php";
require_once "model/tot_nghiep.php";
require_once "model/chuong_trinh_dao_tao.php";
require_once "model/user_ctdt.php";
class UserController extends Database
{
	protected $user;
	function __construct()
	{
		$this->user = new user_ctdt();
	}
        function index() {
		$data = $this->user->getAll();
		echo self::PutDataToJson($data);
	}
	function create() {
            $errors = array(
                'error' => 0
            );
            $Name = $_POST['Name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_renew = $_POST['password_renew'];
            $status = '1';
            $role = $_POST['role']; 
            if (empty($username)){
                    $errors['username'] = 'Bạn chưa nhập Tên tài khoản đăng nhập';
            }
            if (empty($password)){
                    $errors['password'] = 'Bạn chưa nhập mật khẩu';
            }
            if (strlen($password) < 8){
                    $errors['password'] = 'Mật khẩu tối thiểu phải có 8 kí tự';
            }
            if (empty($password_renew)){
                    $errors['password_renew'] = 'Bạn chưa nhập lại mật khẩu';
            }
            if ($password != $password_renew ){
                    $errors['password_renew'] = 'Nhập lại mật khẩu chưa chính xác';
            }
            if (empty($Name)){
                    $errors['Name'] = 'Bạn chưa nhập Tên người dùng';
            }
            if (count($errors) > 1){
                    $errors['error'] = 1;
                    die (json_encode($errors));
            }
            $rs = $this->user->check_username($username);
            if ($rs != false && isset($rs['id'])){
                    if ($rs['username'] == $username){
                            $errors['username'] = 'Tên đăng nhập đã tồn tại';
                    }
            } 
            if (count($errors) > 1){
                $errors['error'] = 1;
                die (json_encode($errors));
            }
            $password = md5($_POST['password']);
            $this->user->create($Name,$username,$password,$status,$role);
            die (json_encode($errors));	
        }
        function change(){
            $id = htmlentities(trim(stripslashes($_SESSION['id'])));
            $status = htmlentities(trim(stripslashes($_SESSION['status'])));
            $results =$this->user->change($id,$status);
            if($results) {
                    $msg ="Cap nhat trang thai user thanh cong";
                    echo self::PutDataToJson($msg);
            }
	}
        function delete() {
            $id = htmlentities(trim(stripslashes($_SESSION['id'])));
            $results =  $this->user->delete($id);
            if($results) {
                    $msg ="Xoa user thanh cong";
                    echo self::PutDataToJson($msg);
            }
	}
        function update() {
            $errors = array(
                'error' => 0
            );
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password_new = $_POST['password'];
            $password_new1 = $_POST['password_renew'];
            $Name = $_POST['Name'];
            $role = $_POST['role'];
            if (empty($password_new)){
                    $errors['password_new'] = 'Bạn chưa nhập mật khẩu mới';
            }
            if (strlen($password_new) < 8){
                    $errors['password_new'] = 'Mật khẩu tối thiểu phải có 8 kí tự';
            }
            if (empty($password_new1)){
                    $errors['password_new1'] = 'Bạn chưa nhập lại mật khẩu mới';
            }
            if ($password_new != $password_new1 ){
                    $errors['password_old'] = 'Nhập lại mật khẩu chưa chính xác';
            }
            if (empty($Name)){
                    $errors['Name'] = 'Bạn chưa nhập Tên người dùng';
            }
            if (count($errors) > 1){
                $errors['error'] = 1;
                die (json_encode($errors));
            }
            $password = md5($password_new);
            $this->user->update($Name,$username,$password,$role,$id);
            die (json_encode($errors));	
        }
        function change_pass() {
            $errors = array(
                'error' => 0
            );
            $userid = $_POST['userid'];
            $username = $_POST['username'];
            $password_old = $_POST['password_old'];
            $password_new = $_POST['password_new'];
            $password_new1 = $_POST['password_new1'];
            if (empty($password_old)){
                    $errors['password_old'] = 'Bạn chưa nhập mật khẩu cũ';
            }
            if (empty($password_new)){
                    $errors['password_new'] = 'Bạn chưa nhập mật khẩu mới';
            }
            if (strlen($password_new) < 8){
                    $errors['password_new'] = 'Mật khẩu tối thiểu phải có 8 kí tự';
            }
            if (empty($password_new1)){
                    $errors['password_new1'] = 'Bạn chưa nhập lại mật khẩu mới';
            }

            if ($password_new != $password_new1 ){
                    $errors['password_old'] = 'Nhập lại mật khẩu chưa chính xác';
            }
            if (count($errors) > 1){
                    $errors['error'] = 1;
                    die (json_encode($errors));
            }
            $rs = $this->user->check_user($username,$password_old);
            if ($rs == false){
               $errors['login'] = 'Mật khẩu không chính xác';

            } 
            if (count($errors) > 1){
                $errors['error'] = 1;
                die (json_encode($errors));
            }
            $this->user->change_pass($userid,$password_new);
            die (json_encode($errors));	
        }
		function createUser() {
			$Name = htmlentities(trim(stripslashes($_SESSION['Name'])));
			$username = htmlentities(trim(stripslashes($_SESSION['username'])));
			$password = htmlentities(trim(stripslashes($_SESSION['password'])));
			$status = htmlentities(trim(stripslashes($_SESSION['status'])));
			$role = htmlentities(trim(stripslashes($_SESSION['role'])));
			$password_md5 = md5($password);
            $results = $this->user->create($Name,$username,$password_md5,$status,$role);
			if($results) {
			$msg ="Them user thanh cong";
			echo self::PutDataToJson($msg);
			}
		}
		function updateUser() {
			$id = htmlentities(trim(stripslashes($_SESSION['id'])));
			$Name = htmlentities(trim(stripslashes($_SESSION['Name'])));
			$username = htmlentities(trim(stripslashes($_SESSION['username'])));
			$password = htmlentities(trim(stripslashes($_SESSION['password'])));
			$role = htmlentities(trim(stripslashes($_SESSION['role'])));
			$password_md5 = md5($password);
                        $results = $this->user->update($Name,$username,$password_md5,$role,$id);
			if($results) {
			$msg ="Chinh sua thong tin user thanh cong";
			echo self::PutDataToJson($msg);
			}
		}
		function check_user() {
			$username = htmlentities(trim(stripslashes($_SESSION['username'])));
			$password = htmlentities(trim(stripslashes($_SESSION['password'])));
                        $results = $this->user->check_user($username,$password);
                        $msg ="";
			if($results) {
                            $msg ="get Data user thanh cong";
                            echo self::PutDataToJson($msg);
                            echo self::PutDataToJson($results);
			} else {
                           $msg ="error";
                           echo self::PutDataToJson($msg); 
                        }
		}
		function check_username() {
			$username = htmlentities(trim(stripslashes($_SESSION['username'])));
                        $results = $this->user->check_username($username);
			if($results) {
                            $msg ="User da ton tai";
                            echo self::PutDataToJson($msg);
			} else {
                            $msg ="Co the su dung user nay";
			echo self::PutDataToJson($msg);
                        }
		}
		function change_password() {
			$userid = htmlentities(trim(stripslashes($_SESSION['id'])));
			$password = htmlentities(trim(stripslashes($_SESSION['password'])));
			$results = $this->user->change_pass($userid,$password);
			if($results) {
			$msg ="Thay doi mat khau thanh cong";
			echo self::PutDataToJson($msg);
			}
		}
}		
?>