<?php
require_once "config/Database.php";
class tot_nghiep extends Database{
	public function search($id,$mon,$checkbox){
                if ($checkbox == 1){
                    $sql = "AND TC.THI_KQ = '1'";
                }
                else {
                    $sql ="";
                }
		$where_mh ='';
		if	($mon !=''){
			$where_mh = "AND MH.MH_ID ='".$mon."'";
		}
		$query = "SELECT MH.MH_TEN,KT.KT_NGAY,TC.THI_DIEM,TC.THI_KQ,TC.THI_GHICHU,KT.KT_LOAITHI,TC.SV_MSSV,KT.MH_ID,KT.KT_LANTHI,LT.LOAITHI_TEN
					FROM APTECH_TCDTHI TC
					LEFT JOIN APTECH_DMKYTHI KT ON TC.KT_ID = KT.KT_ID
					LEFT JOIN APTECH_DMMONHOC MH ON KT.MH_ID = MH.MH_ID
                                        LEFT JOIN APTECH_DM_LOAITHI LT ON KT.KT_LOAITHI = LT.LOAITHI_ID
					WHERE SV_MSSV ='$id' $where_mh $sql";
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['MH_TEN'] = $row['MH_TEN'];
				$item['KT_NGAY'] = $row['KT_NGAY'];
				$item['THI_DIEM'] = $row['THI_DIEM'];
				$item['THI_KQ'] = $row['THI_KQ'];
				$item['KT_LOAITHI'] = $row['KT_LOAITHI'];
				$item['KT_LANTHI'] = $row['KT_LANTHI'];
				$item['THI_GHICHU'] = $row['THI_GHICHU'];
                                $item['LOAITHI_TEN'] = $row['LOAITHI_TEN'];
				$list[] = $item;
		}
		return $list;
	}
	public function search2($id,$tenCTDT,$checkbox){
            if ($checkbox == 1){
                    $sql = "AND TC.THI_KQ = '1'";
                }
                else {
                    $sql ="";
                }
            $query = "	SELECT MH.MH_TEN,KT.KT_NGAY,TC.THI_DIEM,TC.THI_KQ,TC.THI_GHICHU,KT.KT_LOAITHI,TC.SV_MSSV,KT.MH_ID,KT.KT_LANTHI, MH1.ThuTuHienThi,LT.LOAITHI_TEN
                        FROM APTECH_TCDTHI TC
                        LEFT JOIN APTECH_DMKYTHI KT ON TC.KT_ID = KT.KT_ID
                        LEFT JOIN APTECH_DMMONHOC MH ON KT.MH_ID = MH.MH_ID
                        LEFT JOIN APTECH_DM_LOAITHI LT ON KT.KT_LOAITHI = LT.LOAITHI_ID
                        JOIN APTECH_MON_HOC_CTDT MH1 ON MH1.ma_mh = MH.MH_ID
                        WHERE SV_MSSV ='$id' AND MH1.ctdt_id = '$tenCTDT' $sql ORDER BY MH1.ThuTuHienThi ASC";
            $result = parent::query($query);
            $list = [];
            while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                            $item['MH_TEN'] = $row['MH_TEN'];
                            $item['KT_NGAY'] = $row['KT_NGAY'];
                            $item['THI_DIEM'] = $row['THI_DIEM'];
                            $item['THI_KQ'] = $row['THI_KQ'];
                            $item['KT_LOAITHI'] = $row['KT_LOAITHI'];
                            $item['KT_LANTHI'] = $row['KT_LANTHI'];
                            $item['THI_GHICHU'] = $row['THI_GHICHU'];
                            $item['LOAITHI_TEN'] = $row['LOAITHI_TEN'];
                            $list[] = $item;
            }
            return $list;
	}
	public function getInfo($id){
		$query ="	SELECT SV.SV_MSSV,SV.SV_HOTEN,SV.SV_PORTALID, L.LOP_TEN,KH.KHOA_TEN 
					FROM APTECH_DMSINHVIEN SV
					LEFT JOIN APTECH_DMLOP L ON SV.LOP_ID = L.LOP_ID
					LEFT JOIN APTECH_DMKHOAHOC KH ON L.KHOA_ID= KH.KHOA_ID
					WHERE SV_MSSV ='$id'";	
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['SV_MSSV'] = $row['SV_MSSV'];
				$item['SV_HOTEN'] = $row['SV_HOTEN'];
				$item['SV_PORTALID'] = $row['SV_PORTALID'];
				$item['LOP_TEN'] = $row['LOP_TEN'];
				$item['KHOA_TEN'] = $row['KHOA_TEN'];
				$list[] = $item;
		}
		return $list;
	}
	public function getMonHoc($id){
		$query ="	SELECT DISTINCT MH.MH_TEN,MH.MH_ID
					FROM APTECH_TCDTHI TC
					LEFT JOIN APTECH_DMKYTHI KT ON TC.KT_ID = KT.KT_ID
					LEFT JOIN APTECH_DMMONHOC MH ON KT.MH_ID = MH.MH_ID
					WHERE SV_MSSV ='$id'";	
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['MH_TEN'] = $row['MH_TEN'];
				$item['MH_ID'] = $row['MH_ID'];
				$list[] = $item;
		}
		return $list;
	}
        public function getTenMHbyID($id) {
		$query = "SELECT ten FROM APTECH_CHUONG_TRINH_DAO_TAO WHERE id ='$id'";
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['ten'] = $row['ten'];
				$list[] = $item;
		}
		return $list[0]['ten'];
	}
        public function liveSearch($search) {
                $query = "SELECT info FROM (select concat(SV_MSSV,'-',SV_HOTEN) as info from APTECH_DMSINHVIEN) a WHERE info  LIKE '%$search%'";
                //$stmt = $conn->prepare($sql);
                //$stmt->execute(['country' => '%' . $inpText . '%']);
                //$result = $stmt->fetchAll();
                $result = parent::query($query);
                if ($result) {
                  while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
                    echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['info'] . '</a>';
                  }
                } else {
                  echo '<p class="list-group-item border-1">No Record</p>';
                }
	}
}
?>