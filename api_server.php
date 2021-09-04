<?php
session_start();
require_once "controller/api/ChuongTrinhDaoTaoController.php";
require_once "controller/api/MonHocController.php";
require_once "controller/api/TotNghiepController.php";
require_once "controller/api/UserController.php";
//$mode = htmlentities(trim(stripslashes($_REQUEST['mode'])));
$controller = htmlentities(trim(stripslashes($_REQUEST['function'])));
	switch ($controller){
	case "getAllDataCTDT":
            $ctdt = new ChuongTrinhDaoTaoController();
            $ctdt->index();
            break;
        case "getAllCTDT":
            $ctdt = new ChuongTrinhDaoTaoController();
            $ctdt->getAllCTDT();
            break;
	case "createCTDT":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['ten'] = $data->ten;
			$_SESSION['trangthai'] = $data->trangthai;
			$_SESSION['ghichu'] = $data->ghichu;
			$_SESSION['thutu'] = $data->thutu;
            $ctdt = new ChuongTrinhDaoTaoController();
            $ctdt->create();
            break;
	case "updateCTDT":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['id'] = $data->id;
			$_SESSION['ten'] = $data->ten;
			$_SESSION['trangthai'] = $data->trangthai;
			$_SESSION['ghichu'] = $data->ghichu;
			$_SESSION['thutu'] = $data->thutu;
            $ctdt = new ChuongTrinhDaoTaoController();
            $ctdt->update();
            break;	
	case "deleteCTDT":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['id'] = $data->id;
                        $ctdt = new ChuongTrinhDaoTaoController();
                        $ctdt->delete();
                        break;
	case "changeTrangThaiCuaCTDT":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['id'] = $data->id;
			$_SESSION['trangthai'] = $data->trangthai;
            $ctdt = new ChuongTrinhDaoTaoController();
            $ctdt->change();
            break;
	case "getMonHocTheoCTDT":
                $data = json_decode(file_get_contents("php://input"));
                $_SESSION['id'] = $data->id;
                $monhoc = new MonHocController();
                $monhoc->index();
            break;
	case "getAllMonHoc":
	    $monhoc = new MonHocController();
            $monhoc->dataMonHoc();
            break;
	case "AddMonHocVaoCTDT":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['tenMH'] = $data->tenMH;
			$_SESSION['maMH'] = $data->maMH;
			$_SESSION['idCTDT'] = $data->idCTDT;
			$_SESSION['thutu'] = $data->thutu;
			$monhoc = new MonHocController();
            $monhoc->create();
            break;
	case "SuaMonHocCuaCTDT":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['idMonHoc'] = $data->idMonHoc;
			$_SESSION['thutu'] = $data->thutu;
			$monhoc = new MonHocController();
            $monhoc->update();
            break;	
	case "XoaMonHocCuaCTDT":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['idMonHoc'] = $data->idMonHoc;
			$monhoc = new MonHocController();
                        $monhoc->delete();
            break;	
	case "getInfoSinhVienByMSSV":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['mssv'] = $data->mssv;
			$totnghiep = new TotNghiepController();
            $totnghiep->getInfoSinhVien();
            break;	
	case "getMonHocCuaSinhVienByMSSV":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['mssv'] = $data->mssv;
			$totnghiep = new TotNghiepController();
            $totnghiep->getMonHocCuaSinhVien();
            break;
	case "getDataTotNghiepCuaSinhVienTheoMon":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['mssv'] = $data->mssv;
			$_SESSION['idMon'] = $data->idMon;
			$_SESSION['checkbox'] = $data->checkbox;
			$totnghiep = new TotNghiepController();
            $totnghiep->getDataTotNghiepCuaSinhVienTheoMon();
            break;
	case "getDataTotNghiepCuaSinhVienTheoCTDT":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['mssv'] = $data->mssv;
			$_SESSION['idCTDT'] = $data->idCTDT;
			$_SESSION['checkbox'] = $data->checkbox;
			$totnghiep = new TotNghiepController();
            $totnghiep->getDataTotNghiepCuaSinhVienTheoCTDT();
            break;
	case "getAllUser":
            $user = new UserController();	
            $user->index();
            break;
	case "getInfoUserByUsernameAndPassword":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['username'] = $data->username;
			$_SESSION['password'] = $data->password;
			$user = new UserController();	
                        $user->check_user();
            break;		
	case "createUser":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['Name'] = $data->Name;
			$_SESSION['username'] = $data->username;
			$_SESSION['password'] = $data->password;
			$_SESSION['status'] = $data->trangthai;
			$_SESSION['role'] = $data->role;
			$user = new UserController();	
            $user->createUser();
            break;
	case "updateUser":
			$data = json_decode(file_get_contents("php://input"));
                        $_SESSION['id'] = $data->id;
			$_SESSION['Name'] = $data->Name;
			$_SESSION['username'] = $data->username;
			$_SESSION['password'] = $data->password;
			$_SESSION['role'] = $data->role;
			$user = new UserController();	
                    $user->updateUser();
            break;
	case "checkUser":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['username'] = $data->username;
			$_SESSION['password'] = $data->password;
			$user = new UserController();	
            $user->check_user();
            break;	
	case "checkUsername":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['username'] = $data->username;
			$user = new UserController();	
            $user->check_username();
            break;	
	case "doiMatKhauUser":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['id'] = $data->id;
			$_SESSION['password'] = $data->password;
			$user = new UserController();	
            $user->change_password();
            break;		
	case "doiTrangThaiUser":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['id'] = $data->id;
			$_SESSION['status'] = $data->trangthai;
			$user = new UserController();	
            $user->change();
            break;
	case "deleteUser":
			$data = json_decode(file_get_contents("php://input"));
			$_SESSION['id'] = $data->id;
			$user = new UserController();	
            $user->delete();
            break;
	default:
		break;
	}
?>