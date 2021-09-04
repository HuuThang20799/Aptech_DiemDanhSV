<?php
class Database {
	protected $serverName = "localhost\\SQLEXPRESS01";
	protected $Database = "QuanLy";
	protected $users = "sa";
	protected $password = "thang1999";
	public $temp123="thang";
        
    public static $url_api = "http://localhost/12/QuanLyCTDT/api_server.php";
	public function __construct()
	{
		$connectionInfo = array("Database"=>$this->Database, "UID"=>$this->users, "PWD"=>$this->password,"CharacterSet"  => 'UTF-8');
		$this->conn = sqlsrv_connect( $this->serverName, $connectionInfo );
		if  ($this->conn === false ) {
			die( print_r( sqlsrv_errors(), true));
		}
		return $this->conn;
	}
	public function query($queryCommand){
		$result = NULL;
		if (!empty($queryCommand)) {
			$result = sqlsrv_query($this->conn,$queryCommand);
		}
		return $result;
	}
	public function query2($queryCommand,$params){
		$result = NULL;
		if (!empty($queryCommand)&& !empty($params)) {
			$result = sqlsrv_query($this->conn,$queryCommand,$params);
		}
		return $result;
	}
        public function PutDataToJson($data, $err = false) {
            $json = Array(
                'msg' => '',
                'data' => Array()
            );
            if(!empty($data)){
                if($err){
                    $json['msg'] = "error";
    //                $json['data'] = $data;
                    $json['data'] = isset($data[0])? $data[0] : $data;
                }else{
                    $json['msg'] = "OK";
                    $json['data'] = $data;
                }
            }else{ 
                $json['msg'] = "error";
            }
            return json_encode($json);
        }
        function callAPI($method, $url, $data){
            $curl = curl_init();
            switch ($method){
               case "POST":
                  curl_setopt($curl, CURLOPT_POST, 1);
                  if ($data)
                     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  break;
               case "PUT":
                  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                  if ($data)
                     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                  break;
               default:
                  if ($data)
                     $url = sprintf("%s?%s", $url, http_build_query($data));
            }
            // OPTIONS:
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
               'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // EXECUTE:
            $result = curl_exec($curl);
            if(!$result){die("Connection Failure");}
            curl_close($curl);
            return $result;
         }
}
?>