<?php
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
		  //$data = $this->ctdt->getAll();
                $url = self::$url_api;
                $get_data = self::callAPI('GET',$url.'?function=getAllDataCTDT', false);
                $response = json_decode($get_data, true);
                $data = $response['data'];
		include "view/ctdt/index.php";
	}
	function create() {
		if (isset($_POST['insertdata'])){
			$ten = $_POST['ten'];
			$tt = $_POST['tt'];
			$ghichu = $_POST['ghichu'];
			$thutu = $_POST['thutu'];
		}
                $data_array =  array(
                              "ten"         => $ten,
                              "trangthai"   => $tt,
                              "ghichu"      => $ghichu,
                              "thutu"       => $thutu
                  );
                $url = self::$url_api;
                $make_call = self::callAPI('POST', $url.'?function=createCTDT', json_encode($data_array));
                $response = json_decode($make_call, true);
		header('Location:index.php?c=ctdt');
		exit();
	}
	function update() {
		if (isset($_POST['updatedata'])){   
			$id = $_POST['update_id'];
			$ten = $_POST['ten'];
			$tt = $_POST['tt'];
			$ghichu = $_POST['ghichu'];
			$thutu = $_POST['thutu'];
		}
                $data_array =  array(
                              "id"         =>  $id,
                              "ten"         => $ten,
                              "trangthai"   => $tt,
                              "ghichu"      => $ghichu,
                              "thutu"       => $thutu
                  );
                $url = self::$url_api;
                $make_call = self::callAPI('POST', $url.'?function=updateCTDT', json_encode($data_array));
                $response = json_decode($make_call, true);
		header('Location:index.php?c=ctdt');
		exit();
	}
	function delete() {
		if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] >0){	
			$id = $_GET['id'];
		}
                $data_array =  array(
                    "id"         =>  $id
                  );
                $url = self::$url_api;
                $make_call = self::callAPI('POST',$url.'?function=deleteCTDT', json_encode($data_array));
                $response = json_decode($make_call, true);
		header('Location:index.php?c=ctdt');
		exit();
	}
	function change(){

		if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] >0 && isset($_GET['tt'])){	
			$id = $_GET['id'];
			$tt = $_GET['tt'];
		}
                $data_array =  array(
                    "id"         =>  $id,
                    "trangthai"         =>  $tt
                  );
                $url = self::$url_api;
                $make_call = self::callAPI('POST',$url.'?function=changeTrangThaiCuaCTDT', json_encode($data_array));
                $response = json_decode($make_call, true);
		header('Location:index.php?c=ctdt');
		exit();
	}
}
?>