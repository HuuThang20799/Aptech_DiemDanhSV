
<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Max-Age: 1000");
	header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
	header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
	header('content-type: application/json; charset=utf-8');

	$serverName = "sql.bsite.net\MSSQL2016"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"theshine20799_", "UID"=>"theshine20799_", "PWD"=>"huuthang20799","ConnectionPooling"=>0,"CharacterSet"=>"UTF-8");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);

	if( !$conn ) {
    	echo "Connection could not be established.<br />";
    	die( print_r( sqlsrv_errors(), true));
	}
	//else
	//	echo "Successfully!";
	$result = array();
	$getMethod=$_SERVER['REQUEST_METHOD'];
	//print($getMethod);

	switch ($getMethod) {
		case 'GET':
			getData();
			break;
		case 'POST':
			getData();
			break;
		default:
			# code...
			break;
	}

	function getData(){
		global $conn;
		$objJOSN=new stdClass; 
		$sql = "SELECT * FROM APTECH_DMMONHOC";
		$stmt = sqlsrv_query($conn, $sql);
		do {
	    	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
	   		$result[] =$row;
	    	}
		} while (sqlsrv_next_result($stmt));
		$objJOSN=new stdClass; 
		$objJOSN->recordset=$result;
		//header('Content-type:Access-Control-Allow-Origin: *');
		echo json_encode($objJOSN);
	}
?>
