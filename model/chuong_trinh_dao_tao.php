<?php
require_once "config/Database.php";
class chuong_trinh_dao_tao extends Database{
	public function getAll(){
		$query = "SELECT * FROM APTECH_CHUONG_TRINH_DAO_TAO ORDER BY thutu ASC";
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['id'] = $row['id'];
				$item['ten'] = $row['ten'];
				$item['tt'] = $row['tt'];
				$item['ghichu'] = $row['ghichu'];
				$item['thutu'] = $row['thutu'];
				$list[] = $item;
		}
		return $list;
	}public function getAllMonHoc(){
		$query = "SELECT id,ten FROM APTECH_CHUONG_TRINH_DAO_TAO WHERE tt='1'";
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['id'] = $row['id'];
				$item['ten'] = $row['ten'];
				$list[] = $item;
		}
		return $list;
	}
	public function create($ten,$tt,$ghichu,$thutu){
		$query = "INSERT INTO APTECH_CHUONG_TRINH_DAO_TAO (ten,tt,ghichu,thutu) VALUES (?,?,?,?)";
		$params = array($ten,$tt,$ghichu,$thutu);
		return parent::query2($query,$params);
	}
	public function update($ten,$tt,$ghichu,$thutu,$id){
		$query = "UPDATE APTECH_CHUONG_TRINH_DAO_TAO SET ten =?,tt=?,ghichu =?,thutu =? WHERE id = ? ";
		$params = array($ten,$tt,$ghichu,$thutu,$id);
		return parent::query2($query,$params);
	}
	public function delete($id){
		$query = "DELETE FROM APTECH_CHUONG_TRINH_DAO_TAO WHERE id='$id'";
		return parent::query($query);
	}
	public function change($id,$tt){
		if ($tt == 1){
			$tt_temp = 0;
			$query = "UPDATE APTECH_CHUONG_TRINH_DAO_TAO SET tt=? WHERE id = ? ";
			$params = array($tt_temp,$id);
			return parent::query2($query,$params);
		} else if ($tt == 0){
			$tt_temp = 1;
			$query = "UPDATE APTECH_CHUONG_TRINH_DAO_TAO SET tt=? WHERE id = ? ";
			$params = array($tt_temp,$id);
			return parent::query2($query,$params);
		}
	}
}
?>