<?php
require_once "model/tot_nghiep.php";
require_once "model/chuong_trinh_dao_tao.php";
require_once "config/Database.php";
class TotNghiepController extends Database
{
	private $totnghiep;
	private $ctdt;
	function __construct()
	{
		$this->totnghiep = new tot_nghiep();
		$this->ctdt = new chuong_trinh_dao_tao();
	}
	
	function index() {
		$data =null;
		include "view/totnghiep/index.php";
	}
	function search() {
		if (isset($_GET['keyword']) && $_GET['keyword'] != ''){
                        if (isset($_GET['checkbox'])){
                            $checkbox =1;
                        }
                        else {
                            $checkbox = 0;
                        }
                        $string = $_GET['keyword'];
                        $char = "-";
                        $checkstring = strpos($string, $char);
                        if ($checkstring == true) {
                            $a =explode("-",$string);
                            $keyword = $a[0];
                        } else {
                            $keyword = $_GET['keyword'];
                        }
			$mon ='';
			//$data = $this->totnghiep->search($keyword,$mon,$checkbox);
                        $data_array =  array(
                              "mssv"          =>  $keyword,
                              "idMon"         =>  $mon,
                              "checkbox"      =>  $checkbox
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getDataTotNghiepCuaSinhVienTheoMon', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $data = isset($response['data']) ?$response['data'] :'';
			//$info = $this->totnghiep->getInfo($keyword);
                        $data_array =  array(
                              "mssv"         =>  $keyword
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getInfoSinhVienByMSSV', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $info = isset($response['data']) ?$response['data'] :'';
			//$monhoc = $this->totnghiep->getMonHoc($keyword);
                        $data_array =  array(
                              "mssv"         =>  $keyword
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getMonHocCuaSinhVienByMSSV', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $monhoc = isset($response['data']) ?$response['data'] :'';
                        $url = self::$url_api;
                        $get_data = self::callAPI('GET',$url.'?function=getAllCTDT', false);
                        $response = json_decode($get_data, true);
                        $ctdt = isset($response['data']) ?$response['data'] :'';
			//$ctdt = $this->ctdt->getAllMonHoc();
			include "view/totnghiep/index.php";
		} else if (isset($_GET['tenCTDT']) && $_GET['tenCTDT'] != ''){
                        if (isset($_GET['checkbox'])){
                            $checkbox =1;
                        }
                        else {
                            $checkbox = 0;
                        }
			$string = $_GET['keyword1'];
                        $char = "-";
                        $checkstring = strpos($string, $char);
                        if ($checkstring == true) {
                            $a =explode("-",$string);
                            $keyword = $a[0];
                        } else {
                            $keyword = $_GET['keyword1'];
                        }
			$tenCTDT =$_GET['tenCTDT'];
                                                $data_array =  array(
                              "mssv"          =>  $keyword,
                              "idCTDT"        =>  $tenCTDT,
                              "checkbox"      =>  $checkbox
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getDataTotNghiepCuaSinhVienTheoCTDT', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $data = isset($response['data']) ?$response['data'] :'';
			//$info = $this->totnghiep->getInfo($keyword);
                        $data_array =  array(
                              "mssv"         =>  $keyword
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getInfoSinhVienByMSSV', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $info = isset($response['data']) ?$response['data'] :'';
			//$monhoc = $this->totnghiep->getMonHoc($keyword);
                        $data_array =  array(
                              "mssv"         =>  $keyword
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getMonHocCuaSinhVienByMSSV', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $monhoc = isset($response['data']) ?$response['data'] :'';
                        $url = self::$url_api;
                        $get_data = self::callAPI('GET',$url.'?function=getAllCTDT', false);
                        $response = json_decode($get_data, true);
                        $ctdt = isset($response['data']) ?$response['data'] :'';
//			$data = $this->totnghiep->search2($keyword,$tenCTDT,$checkbox);
//			$info = $this->totnghiep->getInfo($keyword);
//			$monhoc = $this->totnghiep->getMonHoc($keyword);
//			$ctdt = $this->ctdt->getAllMonHoc();
			include "view/totnghiep/index.php";
		} else if (isset($_GET['tenMH']) && $_GET['tenMH'] != ''){
                        if (isset($_GET['checkbox'])){
                            $checkbox =1;
                        }
                        else {
                            $checkbox = 0;
                        }
			$string = $_GET['keyword1'];
                        $char = "-";
                        $checkstring = strpos($string, $char);
                        if ($checkstring == true) {
                            $a =explode("-",$string);
                            $keyword = $a[0];
                        } else {
                            $keyword = $_GET['keyword1'];
                        }
			$mon = $_GET['tenMH'];
                                                $data_array =  array(
                              "mssv"          =>  $keyword,
                              "idMon"         =>  $mon,
                              "checkbox"      =>  $checkbox
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getDataTotNghiepCuaSinhVienTheoMon', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $data = isset($response['data']) ?$response['data'] :'';
			//$info = $this->totnghiep->getInfo($keyword);
                        $data_array =  array(
                              "mssv"         =>  $keyword
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getInfoSinhVienByMSSV', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $info = isset($response['data']) ?$response['data'] :'';
			//$monhoc = $this->totnghiep->getMonHoc($keyword);
                        $data_array =  array(
                              "mssv"         =>  $keyword
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getMonHocCuaSinhVienByMSSV', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $monhoc = isset($response['data']) ?$response['data'] :'';
                        $url = self::$url_api;
                        $get_data = self::callAPI('GET',$url.'?function=getAllCTDT', false);
                        $response = json_decode($get_data, true);
                        $ctdt = isset($response['data']) ?$response['data'] :'';
//			$data = $this->totnghiep->search($keyword,$mon,$checkbox);
//			$info = $this->totnghiep->getInfo($keyword);
//			$monhoc = $this->totnghiep->getMonHoc($keyword);
//			$ctdt = $this->ctdt->getAllMonHoc();
			include "view/totnghiep/index.php";
		} else if (isset($_GET['tenMH']) && $_GET['tenCTDT'] == ''){
                        if (isset($_GET['checkbox'])){
                            $checkbox =1;
                        }
                        else {
                            $checkbox = 0;
                        }
			$string = $_GET['keyword1'];
                        $char = "-";
                        $checkstring = strpos($string, $char);
                        if ($checkstring == true) {
                            $a =explode("-",$string);
                            $keyword = $a[0];
                        } else {
                            $keyword = $_GET['keyword1'];
                        }
			$mon ='';
                                                $data_array =  array(
                              "mssv"          =>  $keyword,
                              "idMon"         =>  $mon,
                              "checkbox"      =>  $checkbox
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getDataTotNghiepCuaSinhVienTheoMon', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $data = isset($response['data']) ?$response['data'] :'';
			//$info = $this->totnghiep->getInfo($keyword);
                        $data_array =  array(
                              "mssv"         =>  $keyword
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getInfoSinhVienByMSSV', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $info = isset($response['data']) ?$response['data'] :'';
			//$monhoc = $this->totnghiep->getMonHoc($keyword);
                        $data_array =  array(
                              "mssv"         =>  $keyword
                        );
                        $url = self::$url_api;
                        $make_call = self::callAPI('POST',$url.'?function=getMonHocCuaSinhVienByMSSV', json_encode($data_array));
                        $response = json_decode($make_call, true);
                        $monhoc = isset($response['data']) ?$response['data'] :'';
                        $url = self::$url_api;
                        $get_data = self::callAPI('GET',$url.'?function=getAllCTDT', false);
                        $response = json_decode($get_data, true);
                        $ctdt = isset($response['data']) ?$response['data'] :'';
//			$data = $this->totnghiep->search($keyword,$mon,$checkbox);
//			$info = $this->totnghiep->getInfo($keyword);
//			$monhoc = $this->totnghiep->getMonHoc($keyword);
//			$ctdt = $this->ctdt->getAllMonHoc();
			include "view/totnghiep/index.php";
		}
		else 
			header('Location:index.php?c=totnghiep');
	}
        function liveSearch(){
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $this->totnghiep->liveSearch($search);
            }
        }
}
?>
	