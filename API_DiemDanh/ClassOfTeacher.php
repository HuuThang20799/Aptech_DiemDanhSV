
<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Max-Age: 1000");
	header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
	header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
	header('content-type: application/json; charset=utf-8');
	$serverName = "localhost\\SQLEXPRESS01"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"QuanLy", "UID"=>"sa", "PWD"=>"thang1999","ConnectionPooling"=>0,"CharacterSet"=>"UTF-8");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);

	if( !$conn ) {
    	echo "Connection could not be established.<br />";
    	die( print_r( sqlsrv_errors(), true));
	}	
	$result = array(); 
	$getMethod=$_SERVER['REQUEST_METHOD'];

	$id= $_POST['txtIDACCOUNT'];
	
	switch ($getMethod) {
		case 'POST':
			getData($id);
			break;

		default:
			# code...
			break;
	}

	function getData(string $id){
		global $conn;
		global $id;
		$jsonResult0 = (object) array('result' => 0);
		$jsonResult1 = (object) array('result' => 1);

		$sqlString = "SELECT DISTINCT LOP_ID,MH_TEN FROM APTECH_DIEMDANHSV WHERE LH_UserName='$id'";
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
		$objJOSNFailed=new stdClass; 

		if($sumRowResultQuery <= 0){
			$objJOSNFailed->recordset= new stdClass;
			$objJOSNFailed->Check=0;
			echo json_encode($objJOSNFailed);
		}
		else{
			$objJOSN->recordset= new stdClass;
			$objJOSN->recordset=$result;
			$objJOSN->Check=1;
			echo json_encode($objJOSN);
		}
	}
?>
