<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once "config/Database.php";
require_once "model/mon_hoc.php";
class MonHocController extends Database
{
	private $monhoc;
	function __construct()
	{
		$this->monhoc = new mon_hoc();
	}
	
	function index() {
		$id = htmlentities(trim(stripslashes($_SESSION['id'])));
		$data = $this->monhoc->getAll($id);
		echo self::PutDataToJson($data);
	}
	function dataMonHoc() {
		$dataMonHoc = $this->monhoc->getMonHoc();
		echo self::PutDataToJson($dataMonHoc);
	}
	function create() {
			$ten_mh = htmlentities(trim(stripslashes($_SESSION['tenMH'])));
			$ma_mh = htmlentities(trim(stripslashes($_SESSION['maMH'])));
			$id = htmlentities(trim(stripslashes($_SESSION['idCTDT'])));
			$thutu = htmlentities(trim(stripslashes($_SESSION['thutu'])));
			$results = $this->monhoc->create($ten_mh,$ma_mh,$id,$thutu);
		if($results) {
			$msg ="Them mon hoc vao CTDT thanh cong";
			echo self::PutDataToJson($msg);
		}
	}
	function update() {
		$id = htmlentities(trim(stripslashes($_SESSION['idMonHoc'])));
		$thutu = htmlentities(trim(stripslashes($_SESSION['thutu'])));
		$results = $this->monhoc->update($thutu,$id);
		if($results) {
			$msg ="Sua mon hoc cua CTDT thanh cong";
			echo self::PutDataToJson($msg);
		}
	}
	function delete() {
		$id = htmlentities(trim(stripslashes($_SESSION['idMonHoc'])));
		$results =	$this->monhoc->delete($id);
		if($results) {
			$msg ="Xoa mon hoc cua CTDT thanh cong";
			echo self::PutDataToJson($msg);
		}
	}
}
?>