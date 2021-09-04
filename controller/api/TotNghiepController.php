<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
require_once "config/Database.php";
require_once "model/mon_hoc.php";
require_once "model/tot_nghiep.php";
require_once "model/chuong_trinh_dao_tao.php";
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
			$data = $this->totnghiep->search($keyword,$mon,$checkbox);
			$info = $this->totnghiep->getInfo($keyword);
			$monhoc = $this->totnghiep->getMonHoc($keyword);
			$ctdt = $this->ctdt->getAllMonHoc();
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
			$data = $this->totnghiep->search2($keyword,$tenCTDT,$checkbox);
			$info = $this->totnghiep->getInfo($keyword);
			$monhoc = $this->totnghiep->getMonHoc($keyword);
			$ctdt = $this->ctdt->getAllMonHoc();
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
			$data = $this->totnghiep->search($keyword,$mon,$checkbox);
			$info = $this->totnghiep->getInfo($keyword);
			$monhoc = $this->totnghiep->getMonHoc($keyword);
			$ctdt = $this->ctdt->getAllMonHoc();
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
			$data = $this->totnghiep->search($keyword,$mon,$checkbox);
			$info = $this->totnghiep->getInfo($keyword);
			$monhoc = $this->totnghiep->getMonHoc($keyword);
			$ctdt = $this->ctdt->getAllMonHoc();
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
		function getInfoSinhVien(){
            $mssv = htmlentities(trim(stripslashes($_SESSION['mssv'])));
			$data = $this->totnghiep->getInfo($mssv);
			echo self::PutDataToJson($data);
        }
		function getMonHocCuaSinhVien(){
            $mssv = htmlentities(trim(stripslashes($_SESSION['mssv'])));
			$data = $this->totnghiep->getMonHoc($mssv);
			echo self::PutDataToJson($data);
        }
		function getDataTotNghiepCuaSinhVienTheoMon(){
                        $mssv = htmlentities(trim(stripslashes($_SESSION['mssv'])));
			$mon = htmlentities(trim(stripslashes($_SESSION['idMon'])));
			$checkbox = htmlentities(trim(stripslashes($_SESSION['checkbox'])));
			$data = $this->totnghiep->search($mssv,$mon,$checkbox);
			echo self::PutDataToJson($data);
        }
		function getDataTotNghiepCuaSinhVienTheoCTDT(){
                        $mssv = htmlentities(trim(stripslashes($_SESSION['mssv'])));
			$ctdt = htmlentities(trim(stripslashes($_SESSION['idCTDT'])));
			$checkbox = htmlentities(trim(stripslashes($_SESSION['checkbox'])));
			$data = $this->totnghiep->search2($mssv,$ctdt,$checkbox);
			echo self::PutDataToJson($data);
        }
}
?>
	