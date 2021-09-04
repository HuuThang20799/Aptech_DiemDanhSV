<?php
require_once "model/user_ctdt.php";
require_once "config/Database.php";
class UserController extends Database
{
	private $user;
	function __construct()
	{
		$this->user = new user_ctdt();
	}
        function index() {
		//$data = $this->user->getAll();
                $url = self::$url_api;
                $get_data = self::callAPI('GET',$url.'?function=getAllUser', false);
                $response = json_decode($get_data, true);
                $data = $response['data'];
		include "view/user/index.php";
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
            $data_array =  array(
                    "username"         =>  $username
                );
            $url = self::$url_api;
            $make_call = self::callAPI('POST',$url.'?function=checkUsername', json_encode($data_array));
            $response = json_decode($make_call, true);
            $data = isset($response['data']) ?$response['data'] :'';
            //$rs = $this->user->check_username($username);
            if ($data == "User da ton tai"){
                $errors['username'] = 'Tên đăng nhập đã tồn tại';
            } 
            if (count($errors) > 1){
                $errors['error'] = 1;
                die (json_encode($errors));
            }
            $password = $_POST['password'];
            $data_array =  array(
                    "Name"         =>  $Name,
                    "username"     =>  $username,
                    "password"     =>  $password,
                    "status"       =>  $status,
                    "role"           =>  $role
                );
            $url = self::$url_api;
            $make_call = self::callAPI('POST',$url.'?function=createUser', json_encode($data_array));
            //$this->user->create($Name,$username,$password,$status,$role);
            die (json_encode($errors));	
        }
        function change(){
            if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] >0 && isset($_GET['status'])){	
                $id = $_GET['id'];
                $status = $_GET['status'];
                    $data_array =  array(
                        "id"         =>  $id,
                        "trangthai"  =>  $status
                    );
                $url = self::$url_api;
                $make_call = self::callAPI('POST',$url.'?function=doiTrangThaiUser', json_encode($data_array));
                $response = json_decode($make_call, true);
            }
            header('Location:index.php?c=user');
            exit();
	}
        function delete() {
            if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] >0){	
                    $id = $_GET['id'];
                    $data_array =  array(
                        "id"         =>  $id
                    );
                $url = self::$url_api;
                $make_call = self::callAPI('POST',$url.'?function=deleteUser', json_encode($data_array));
                $response = json_decode($make_call, true);
            }
            header('Location:index.php?c=user');
            exit();
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
            $password = $password_new;
            $data_array =  array(
                    "Name"         =>  $Name,
                    "username"         =>  $username,
                    "password"         =>  $password,
                    "role"         =>  $role,
                    "id"         =>  $id
                );
            $url = self::$url_api;
            $make_call = self::callAPI('POST',$url.'?function=updateUser', json_encode($data_array));
            //$this->user->update($Name,$username,$password,$role,$id);
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
            $data_array =  array(
                    "username"         =>  $username,
                    "password"         =>  $password_old
                );
            $url = self::$url_api;
            $make_call = self::callAPI('POST',$url.'?function=checkUser', json_encode($data_array));
            $response = json_decode($make_call, true);
            $data = isset($response['data']) ?$response['data'] :'';
            //$rs = $this->user->check_user($username,$password_old);
            if ($data == "error"){
               $errors['login'] = 'Mật khẩu không chính xác';

            } 
            if (count($errors) > 1){
                $errors['error'] = 1;
                die (json_encode($errors));
            }
            $data_array =  array(
                    "id"           =>  $userid,
                    "password"     =>  $password_new
                );
            $url = self::$url_api;
            $make_call = self::callAPI('POST',$url.'?function=doiMatKhauUser', json_encode($data_array));
            //$this->user->change_pass($userid,$password_new);
            die (json_encode($errors));	
        }
}		
?>