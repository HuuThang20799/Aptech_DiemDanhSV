<?php
require_once "config/Database.php";
class lich_su_dang_nhap extends Database{
	public function create($userid,$thoigian){
		$query = "INSERT INTO APTECH_LICHSUDANGNHAP(user_id,LanDangNhapMoiNhat) VALUES (?,?)";
		$params = array($userid,$thoigian);
		return parent::query2($query,$params);
	}
}
?>