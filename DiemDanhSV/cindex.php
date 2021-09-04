<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style_dd.css" >
    <title>Quản lý điểm danh</title>

	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.js"></script>
	<script type="text/javascript">
                $(document).ready(
        function(){
            $('input:submit').attr('disabled',true);
            $('input:file').change(
                function(){
                    if ($(this).val()){
                        $('input:submit').removeAttr('disabled'); 
                    }
                    else {
                        $('input:submit').attr('disabled',true);
                    }
                });
        });
    </script>
</head>
<body>
    <div class="main">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Aptech</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" 
					aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Import File</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Quản Trị</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Thống Kê</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown link
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action 1</a></li>
                        <li><a class="dropdown-item" href="#">Action 2</a></li>
                        <li><a class="dropdown-item" href="#">Action 3</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>
		
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
				<h5><a href="./image/MauExcel1.PNG">Xem định dạng file excel mẫu</a> (Dữ liệu phải được đặt ở sheet có tên 'Sheet1')</h5> <br>
                <label for="myEmail">Chose a your file .xlsx</label>
                <input type="file" name="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" 
					style="border: 2px solid black;" > <br/>
			
                <input type="submit" name="btnSend" class="btn btn-primary" value="Import"  
					disabled style="background-color: aqua;color:black;border: 2px solid black" />
			</div>
        </form>
		
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
		integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>


<?php
	require_once("../config/Database.php");
	require('Classes/PHPExcel.php');
	//tạo biến liên kết /config/Database.php
	$temp=new Database;
	$conn=$temp->__construct();

	// random MH_ID trong trường hợp file excel không truyền MH_ID 
	$length = 5;
	$randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, $length);
	
	if(isset($_POST['btnSend'])){
		$file = $_FILES['file']['tmp_name'];
		$objReader= PHPExcel_IOFactory::createReaderForFile($file);
		$objReader->setLoadSheetsOnly('Sheet1'); //Dữ liệu được load từ sheet có tên 'Sheet1'

		$objExcel= $objReader->load($file);
		$sheetData= $objExcel->getActiveSheet()->toArray('null',true,true,true);
		//Số hàng tối da trong file
		$rowMax=$objExcel->setActiveSheetIndex()->getHighestRow();
		// Vị trí row bắt dầu danh sách học viên
		$Start_Value=9;
		// Vị trí row kết thúc danh sách học viên
		$End_Value=$rowMax-5;
		
		//print($randomletter);
		// Dùng vòng lặp để lấy dữ liệu từng row insert vào database
		for($row=$Start_Value;$row<=$End_Value;$row++){
			$ArrayGV_ID= explode(':', $sheetData[1]['A']);
			if(strtoupper(trim($ArrayGV_ID[0])) == 'TEACHER')
				$GV_ID=trim($ArrayGV_ID[1]);
			
			$ArrayLopID= explode(':', $sheetData[2]['A']);
			if(strtoupper(trim($ArrayLopID[0])) == 'BATCH' )
				$LOP_ID=trim($ArrayLopID[1]);

			$ArrayKH_ID= explode(':', $sheetData[6]['A']);
			if(strtoupper(trim($ArrayKH_ID[0])) == 'CURRICULUM' )
				$KH_ID=trim($ArrayKH_ID[1]);

			$ArrayMH_ID= explode(':',$sheetData[4]['A']);
			//print("day la: ".$ArrayMH_ID[2]);
			if(empty($ArrayMH_ID[2])){
				$MH_ID=strtoupper($randomletter);
				$MH_TEN=trim($ArrayMH_ID[1]);
				print($MH_ID);
			}
			else
				if(strtoupper(trim($ArrayMH_ID[0])) == 'COURSE / MODULE'){
					$MH_ID=trim($ArrayMH_ID[1]);
					$MH_TEN=trim($ArrayMH_ID[2]);
				}
			

			$ArrayTime= explode(':', $sheetData[3]['A']);
			if(strtoupper(trim($ArrayTime[0]))=='TIME')
				$Time=trim($ArrayTime[1].$ArrayTime[2].$ArrayTime[3]);

			$ArrayStartDate= explode(':', $sheetData[5]['A']);
			if(strtoupper(trim($ArrayStartDate[0]))=='START DATE')
				$StartDate=trim($ArrayStartDate[1]);

			$RollNumber= trim($sheetData[$row]['B']);
			$HoTen= trim($sheetData[$row]['D']);
			$SessionCode= trim($sheetData[$rowMax-3]['E']);
			$TotalPresent= 0;

			$sqlStringGV="insert into APTECH_GIANGVIEN(GV_ID,GV_TEN) values('$GV_ID','$GV_ID')";
			$sqlStringMH="insert into APTECH_DMMONHOC(MH_ID,MH_TEN) values('$MH_ID','$MH_TEN')";
			$sqlStringKH="insert into APTECH_DMKHOAHOC(KHOA_ID,KHOA_TEN) values('$KH_ID','$KH_ID')";
			$sqlStringLH="insert into APTECH_DMLOP(LOP_ID,LOP_TEN,KHOA_ID,LH_UserName) 
							values('$LOP_ID','$LOP_ID','$KH_ID','$GV_ID')";
			$sqlStringSV="insert into APTECH_DMSINHVIEN(SV_MSSV,LOP_ID,SV_HOTEN,SV_GIOITINH) 
							values('$RollNumber','$LOP_ID',N'$HoTen',1)";

			$sqlStringDD="insert into APTECH_DIEMDANHSV(			
				LOP_ID,SV_MSSV,SV_TEN,LH_UserName,KHOA_ID,MH_ID,MH_TEN,T1,T2,L1,T3,L2,T4,L3,T5,L4,T6,L5,T7,
				L6,T8,L7,T9,L8,T10,L9,T11,L10,Remarks,FacultyName,TotalPresent,
				SessionCode,Date,StartDate,FrameTime)
					values('$LOP_ID','$RollNumber',N'$HoTen','$GV_ID','$KH_ID','$MH_ID','$MH_TEN',0,0,0,0,0,
					0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','',0,'$SessionCode',' ','$StartDate','$Time')";
			
			$params = array();
    		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    		$stmt = sqlsrv_query( $conn, $sqlStringGV , $params, $options );
    		$stmt1 = sqlsrv_query( $conn, $sqlStringMH , $params, $options );
    		$stmt2 = sqlsrv_query( $conn, $sqlStringKH , $params, $options );
    		$stmt3 = sqlsrv_query( $conn, $sqlStringLH , $params, $options );
			$stmt4 = sqlsrv_query( $conn, $sqlStringSV , $params, $options );
			$stmt5 = sqlsrv_query( $conn, $sqlStringDD , $params, $options );
		}
		//print_r($sheetData);
        echo '<script language="javascript">';
        echo 'alert("Import Successfully!")';
        echo '</script>';
	}
?>
