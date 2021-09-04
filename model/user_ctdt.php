<?php
require_once "config/Database.php";
class user_ctdt extends Database{
	public function check_user($username,$password){
		$query = "SELECT * FROM APTECH_USER_CTDT WHERE username = '$username'";
		$result = parent::query($query);
		$row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
		if (isset($row['id']) && $row['password'] == md5($password)){			
			$item['id'] = $row['id'];
			$item['Name'] = $row['Name'];
			$item['username'] = $row['username'];
			$item['status'] = $row['status'];
			$item['role'] = $row['role'];
			return $item;
		}
		return false;
	}
        public function getAll(){
		$query = "SELECT * FROM APTECH_USER_CTDT a
                          left join (SELECT   user_id, MAX(LanDangNhapMoiNhat) as tgian
                          FROM APTECH_LICHSUDANGNHAP
                          GROUP BY user_id) b
                          ON a.id = b.user_id";
		$result = parent::query($query);
		$list = [];
		while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)){
				$item['id'] = $row['id'];
				$item['Name'] = $row['Name'];
				$item['username'] = $row['username'];
                                $item['status'] = $row['status'];
                                $item['role'] = $row['role'];
                                $item['tgian'] = $row['tgian'];
				$list[] = $item;
		}
		return $list;
	}
	public function create($Name,$username,$password,$status,$role){
		$query = "INSERT INTO APTECH_USER_CTDT (Name,username,password,status,role) VALUES (?,?,?,?,?)";
		$params = array($Name,$username,$password,$status,$role);
		return parent::query2($query,$params);
	}
        public function update($Name,$username,$password,$role,$id){
		$query = "UPDATE APTECH_USER_CTDT SET Name =?,username =? ,password =?,role =? WHERE id = ? ";
		$params = array($Name,$username,$password,$role,$id);
		return parent::query2($query,$params);
	}
	public function check_username($username){
            $query = "SELECT * FROM APTECH_USER_CTDT WHERE username = '$username'";
            $result = parent::query($query);
            $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
            if (isset($row['id'])){			
                    $item['id'] = $row['id'];
                    $item['username'] = $row['username'];
                    return $item;
            }
            return false;
        }
        public function change($id,$status){
		if ($status == 1){
			$status_temp = 0;
			$query = "UPDATE APTECH_USER_CTDT SET status=? WHERE id = ? ";
			$params = array($status_temp,$id);
			return parent::query2($query,$params);
		} else if ($status == 0){
			$status_temp = 1;
			$query = "UPDATE APTECH_USER_CTDT SET status=? WHERE id = ? ";
			$params = array($status_temp,$id);
			return parent::query2($query,$params);
		}
	}
        public function change_pass($id,$password){
			$query = "UPDATE APTECH_USER_CTDT SET password=? WHERE id = ? ";
                        $password_temp = md5($password);
			$params = array($password_temp,$id);
			return parent::query2($query,$params);
	}
        public function delete($id){
		$query = "DELETE FROM APTECH_USER_CTDT WHERE id='$id'";
		return parent::query($query);
	}
}
?>