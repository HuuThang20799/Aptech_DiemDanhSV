
<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Max-Age: 1000");
	header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
	header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
	header('content-type: application/json; charset=utf-8');
	$serverName = "localhost,1999"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"QuanLy", "UID"=>"sa", "PWD"=>"thang1999","ConnectionPooling"=>0,"CharacterSet"=>"UTF-8");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);

	if( !$conn ) {
    	echo "Connection could not be established.<br />";
    	die( print_r( sqlsrv_errors(), true));
	}	
	$result = array(); 
	$getMethod=$_SERVER['REQUEST_METHOD'];
	//print($getMethod);
	if(isset($_POST['txtID_LOP'])){
		$idLop= $_POST['txtID_LOP'];
	}
	else{
		$getMethod='NOT_INPUT';
		$objFailed= new stdClass;
		$objFailed->Check= new stdClass;
		$objFailed->Check->status= new stdClass;
		$objFailed->Check->status= 'not-input';
	}
	// echo $id;
	// echo $pass;
	switch ($getMethod) {
		case 'POST':
			getData($idLop);
			break;
		case 'NOT_INPUT':
			echo json_encode($objFailed);
			break;	
		default:
			# code...
			break;
	}

	function getData(string $idLop){
		global $conn;
		global $id;
		global $pass;
		// $jsonResult0 = (object) array('result' => 0);
		// $jsonResult1 = (object) array('result' => 1);

		$sqlString = "SELECT DISTINCT * FROM APTECH_DIEMDANHSV WHERE LOP_ID='$idLop'";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query($conn, $sqlString, $params, $options);
		$sumRowResultQuery= sqlsrv_num_rows($stmt);

		do {
	    	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
	   		$result[] =$row;
	    	}
		} while (sqlsrv_next_result($stmt));
		$objJOSN=new stdClass; 
		if($sumRowResultQuery <= 0){
			$objJOSN->Check=0;
			echo json_encode($objJOSN);
		}
		else{
			$objJOSN->recordset= new stdClass;
			$objJOSN->recordset=$result;
			$objJOSN->Check=1;
			echo json_encode($objJOSN);
		}
	}
?>
