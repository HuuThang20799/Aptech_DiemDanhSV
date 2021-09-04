<?php
require_once "config/Database.php";
class mon_hoc extends Database{
	public function getAll($id){
		$query = "SELECT * FROM APTECH_MON_HOC_CTDT WHERE ctdt_id = '$id' ORDER BY ThuTuHienThi ASC";
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['id'] = $row['id'];
				$item['ten_mh'] = $row['ten_mh'];
				$item['ThuTuHienThi'] = $row['ThuTuHienThi'];
				$list[] = $item;
		}
		return $list;
	}
	public function getMonHoc() {
		$query = "SELECT MH_TEN,MH_ID FROM APTECH_DMMONHOC ORDER BY MH_TEN ASC";
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['MH_ID'] = $row['MH_ID'];
				$item['MH_TEN'] = $row['MH_TEN'];
				$list[] = $item;
		}
		return $list;
	}
	public function create($ten_mh,$ma_mh,$id,$thutu){
		$query = "INSERT INTO APTECH_MON_HOC_CTDT (ten_mh,ma_mh,ctdt_id,ThuTuHienThi) VALUES (?,?,?,?)";
		$params = array($ten_mh,$ma_mh,$id,$thutu); 
		return parent::query2($query,$params);
	}
	public function update($thutu,$id){
		$query = "UPDATE APTECH_MON_HOC_CTDT SET ThuTuHienThi =? WHERE id = ? ";
		$params = array($thutu,$id);
		return parent::query2($query,$params);
	}
	public function delete($id){
		$query = "DELETE FROM APTECH_MON_HOC_CTDT WHERE id='$id'";
		return parent::query($query);
	}
}
?>