<?php
require_once "model/mon_hoc.php";
require_once "config/Database.php";
class MonHocController extends Database
{
	private $monhoc;
	function __construct()
	{
		$this->monhoc = new mon_hoc();
	}
	
	function index() {
		if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] >0){	
			$id = $_GET['id'];
			//$data = $this->monhoc->getAll($id);
                        $data_array =  array(
                            "id"         =>  $id
                        );
                        $url = self::$url_api;
                        $get_data = self::callAPI('POST',$url.'?function=getMonHocTheoCTDT',json_encode($data_array));
                        $response = json_decode($get_data, true);
                        $data = $response['data'];
			//$dataMonHoc = $this->monhoc->getMonHoc();
                        $get_data = self::callAPI('GET',$url.'?function=getAllMonHoc', false);
                        $response = json_decode($get_data, true);
                        $dataMonHoc = $response['data'];
			include "view/monhoc/index.php";
		}
	}
	function create() {
		if (isset($_POST['insertdataHP'])){
			$tenMH = $_POST['tenMH'];
			$id = $_POST['id'];
			$thutu = $_POST['thutu'];
			$ten = $_POST['ten'];
			list($ten_mh,$ma_mh) = explode("_____",$tenMH);
                        $data_array =  array(
                              "tenMH"         =>  $ten_mh,
                              "maMH"         => $ma_mh,
                              "idCTDT"   => $id,
                              "thutu"       => $thutu
                        );
                        $url_api = self::$url_api;
                        $make_call = self::callAPI('POST', $url_api.'?function=AddMonHocVaoCTDT', json_encode($data_array));
                        $response = json_decode($make_call, true);
			//$this->monhoc->create($ten_mh,$ma_mh,$id,$thutu);
			$url ="index.php?c=monhoc&id=$id&ten=$ten";
			header('location:'.$url);
		exit();
		}
		
	}
	function update() {
		if (isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){   
			$id = $_POST['id'];
			$thutu = $_POST['value'];
			$data_array =  array(
                            "idMonHoc"      =>  $id,
                            "thutu"         =>  $thutu
                          );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=SuaMonHocCuaCTDT', json_encode($data_array));
                        $response = json_decode($make_call, true);
			echo 1;
		}else{
			echo 0;
		}
	}
	function delete() {

		if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] >0){	
			$id = $_GET['id'];
			$id_ctdt = $_GET['id_ctdt'];
			$ten = $_GET['ten'];
			$data_array =  array(
                            "idMonHoc"         =>  $id
                          );
                $url_api = self::$url_api;
                $make_call = self::callAPI('POST',$url_api.'?function=XoaMonHocCuaCTDT', json_encode($data_array));
                $response = json_decode($make_call, true);
                $url ="index.php?c=monhoc&id=$id_ctdt&ten=$ten";
                header('location:'.$url);
		exit();
		}		
	}
}
?>