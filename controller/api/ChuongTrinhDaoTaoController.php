<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once "model/chuong_trinh_dao_tao.php";
require_once "config/Database.php";
class ChuongTrinhDaoTaoController extends Database
{
	private $ctdt;
	function __construct()
	{
		$this->ctdt = new chuong_trinh_dao_tao();
	}
	
	function index() {
		$data = $this->ctdt->getAll();
		echo self::PutDataToJson($data);
	}
        function getAllCTDT() {
		$data = $this->ctdt->getAllMonHoc();
		echo self::PutDataToJson($data);
	}
	function create() {
		$ten = htmlentities(trim(stripslashes($_SESSION['ten'])));
		$tt = htmlentities(trim(stripslashes($_SESSION['trangthai'])));
		$ghichu = htmlentities(trim(stripslashes($_SESSION['ghichu'])));
		$thutu = htmlentities(trim(stripslashes($_SESSION['thutu'])));
		$results = $this->ctdt->create($ten,$tt,$ghichu,$thutu);
		if($results) {
			$msg ="Tao CTDT thanh cong";
			echo self::PutDataToJson($msg);
		}
	}
	function update() {
		$id = htmlentities(trim(stripslashes($_SESSION['id'])));
		$ten = htmlentities(trim(stripslashes($_SESSION['ten'])));
		$tt = htmlentities(trim(stripslashes($_SESSION['trangthai'])));
		$ghichu = htmlentities(trim(stripslashes($_SESSION['ghichu'])));
		$thutu = htmlentities(trim(stripslashes($_SESSION['thutu'])));
		$results =$this->ctdt->update($ten,$tt,$ghichu,$thutu,$id);
		if($results) {
			$msg ="Sua CTDT thanh cong";
			echo self::PutDataToJson($msg);
		}
	}
	function delete() {
		$id = htmlentities(trim(stripslashes($_SESSION['id'])));
		$results =$this->ctdt->delete($id);
		if($results) {
                $msg ="Xoa CTDT thanh cong";
                echo self::PutDataToJson($msg);
		}
	}
	function change(){
		$id = htmlentities(trim(stripslashes($_SESSION['id'])));
		$tt = htmlentities(trim(stripslashes($_SESSION['trangthai'])));
		$results =$this->ctdt->change($id,$tt);
		if($results) {
                    $msg ="Thay doi trang thai cua CTDT thanh cong";
                    echo self::PutDataToJson($msg);
		}
	}
}
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                