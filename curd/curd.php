<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
include'../config/config.php';
include'../../config/config.php';
class Curd {
	public $mysqli = null;
	// Class constructor override
	public function __construct() {
		$this->mysqli = new mysqli ( DB_SERVER, DB_USER, DB_PASS, DBNAME );
	
		if ($this->mysqli->connect_errno) {
			echo "Error MySQLi: (" & nbsp . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
			exit ();
		} else {
			//echo "connected";die;
		}
		//$this->mysqli->set_charset("utf8");
	}
	
	// select database to use
	public function selectDB($dbname) {
		$selectedDB = $this->mysqli->select_db ( $dbname );
		return $selectedDB;
	}
	
	// Class deconstructor override
	public function __destruct() {
		$this->CloseDB ();
	}
	
	/**
	 * This method is authentigate the user and password from header
	 */
	
	// Clean data in and out of the database
	public function cleanQuery($data) {
		if (is_array ( $data )) {
			// for array
			foreach ( $data as $key => $value ) {
				if (get_magic_quotes_gpc ()) // prevents duplicate backslashes
					$data [$key] = stripslashes ( $value );
				
				if (! is_numeric ( $value ))
					$data [$key] = mysql_escape_string ( $value );
			} // end foreach
		} else {
			// for string only
			if (get_magic_quotes_gpc ())
				$data = stripslashes ( $data );
			
			if (! is_numeric ( $data ))
				$data = mysql_escape_string ( $data );
		}
		return $data;
	}
	
	// runs a sql query with array output
	public function runQueryList($query) {
		//echo "--".$query;
		if ($resultset = $this->mysqli->query ( $query )) {
			if ($resultset->num_rows > 0) {
				
				$data = array ();
				while ( $row = $resultset->fetch_assoc () ) {
					$data [] = array_change_key_case ( $row );
				}
			} else {
				$data = NULL;
			}
		} else {
			$data = die ( $this->mysqli->errno );
		}
		$resultset->close ();
		return $data;
	}
	
	// runs a sql query
	public function runQuery($query) {
		$result = $this->mysqli->query ( $query );
		return $result;
	}
	
	// runs multiple sql queres
	public function runMultipleQueries($query) {
		$result = $this->mysqli->multi_query ( $query );
		return $result;
	}
	
	// Close database connection
	public function CloseDB() {
		$this->mysqli->close ();
	}
	
	// Escape the string get ready to insert or update
	public function clearText($text) {
		$text = trim ( $text );
		return $this->mysqli->real_escape_string ( $text );
	}
	
	// Get the last insert id
	public function lastInsertID() {
		return $this->mysqli->insert_id;
	}
	
	// Gets the total count and returns integer
	public function totalCount($fieldname, $tablename, $where = "") {
		$q = "SELECT count(" . $fieldname . ") FROM " . $tablename . " " . $where;
		
		$result = $this->mysqli->query ( $q );
		$count = 0;
		if ($result) {
			while ( $row = mysqli_fetch_array ( $result ) ) {
				$count = $row [0];
			}
		}
		return $count;
	}
public function userAuthentigation($data ,$tablename ,$is_user){
	$statusArr= array('status' => 'Failed','msg'=>'Initial Value');
	if(null==$data && empty($data)){
		$statusArr['status']=false;
		$statusArr['msg']='Not able to get the user creadentials';
		return $statusArr;
	}
	$userAuth=Curd::userAuth($data,$tablename , $is_user);
	if($userAuth){
	return 	$statusArr['msg']='successfully Login';
	}else{
	return 	$statusArr['msg']='Wrong user name or password';
	}
	return $statusArr;
}

private function userAuth($data = array(), $tablename , $is_user){
	if(!empty($data)){
		if($is_user == '1'){
			$authQuery ="select username,userpassword from $tablename where username='".$data['username']."' and
				userpassword ='".$data['password']."' and status= '".$is_user."'";
			$resultset = $this->mysqli->query($authQuery);
			if($resultset->num_rows > 0){
				$getData ="select user_id,username from $tablename where username='".$data['username']."'";
				$login_res =$this->runQueryList($getData);
				if($login_res){
					$getUserimg = "select userimage_name from ".puad." where user_id='".$login_res[0]['user_id']."'";
					$userimgreslt =$this->runQueryList($getUserimg);
					//print_r($userimgreslt);die;
					$_SESSION['username'] = $login_res[0]['username'];
					$_SESSION['userid'] = $login_res[0]['user_id'];
					$_SESSION['userimg']=$userimgreslt[0]['userimage_name'];
					$_SESSION['success']='You are login successfully.!';
					if($data['username'] =='admin' && $data['password']=='admin'){
						$_SESSION['login_as']='1';
					}else{
						$_SESSION['login_as']='2';
					}
				$update_login ="update $tablename set `last_login`= now() where user_id ='".$login_res[0]['user_id']."'";
					$this->mysqli->query ($update_login);
					return  true;
				}
				
			}else{
				return false;
			}
		}else{
			$authQuery ="select username,userpassword from $tablename where username='".$data['username']."' and
				userpassword ='".$data['password']."' and status= '".$is_user."'";
			$resultset = $this->mysqli->query($authQuery);
			if($resultset->num_rows > 0){
				$getData ="select id,username,image_name from $tablename where username='".$data['username']."'";
				$login_res =$this->runQueryList($getData);
				#print_r($login_res);die;
				if($login_res){
					$_SESSION['username'] = $login_res[0]['username'];
					$_SESSION['userid'] = $login_res[0]['id'];
					$_SESSION['login_as']='2';
					$_SESSION['image_url']=$login_res[0]['image_name'];
				$update_login ="update $tablename set `last_login`= now() where id ='".$login_res[0]['id']."'";
					$this->mysqli->query ($update_login);
					return  true;
				}
				
			}else{
				return false;
			}
		}
		
		
	}else{
		return false;
	}
}

public function deleteData($id , $tablename){
	if(!empty($id)&& $tablename!=""){
	$deleteQuery ="delete from $tablename where id ='".$id."'";
		$resultset = $this->mysqli->query ($deleteQuery);
		#var_dump($resultset);die;
			if($resultset){
				return 	$statusArr['msg']='Record deleted successfully';
			}
	}else{
		return 	$statusArr['msg']='Record not deleted successfully check parameters';
	}
}
public function deleteRecord( $data ,$id , $tablename){
	if(!empty($data)&& !empty($id) && $tablename!=""){
		$query='';$que='';
		foreach ($data as $key => $value) {
			if($key!="" && $value!=""){
				$query.="$key = '$value' ,";
			}	
		}
		$que = rtrim($query,',');
		$updateQuery ="update $tablename set $que where id ='".$id."'";
		$resultset = $this->mysqli->query($updateQuery);
		if($resultset){
			return 	$statusArr['msg']='Record deleted successfully';
		}
	}else{
		return 	$statusArr['msg']='Record not deleted successfully check parameters';
	}
}
	
	
	
	
public function updateData( $data ,$id , $tablename){
	if(!empty($data)&& !empty($id) && $tablename!=""){
		$query='';$que='';
		foreach ($data as $key => $value) {
			if($key!="" && $value!=""){
				$query.="$key = '$value' ,";
			}	
		}
		$que = rtrim($query,',');
		$updateQuery ="update $tablename set $que where id ='".$id."'";
		$resultset = $this->mysqli->query($updateQuery);
		if($resultset){
			return 	$statusArr['msg']='Record updated successfully';
		}
	}else{
		return 	$statusArr['msg']='Record not updated successfully check parameters';
	}
}

public function insertData( $data,$tablename){
	if(!empty($data) && $tablename!=""){
		$query='';$que='';
		foreach ($data as $key => $value) {
			if($key!="" && $value!=""){
				$query.=" `$key` = '$value' ,";
			}
		}
		$que = rtrim($query,',');
		$updateQuery ="insert into $tablename set $que";
		$resultset = $this->mysqli->query ($updateQuery);
		if($resultset){
			return 	true;
		}
	}else{
		return 	$statusArr['msg']='Record not inserted successfully check parameters';
	}
}


public function insert_multipledata($data,$tablename){
    $user_id= $_SESSION['user_id']?:'demo';//die;
    //$user_id='demo';
    if(!empty($data) && $tablename!=""){
        $query="INSERT into $tablename (`user_id`,`employer_name`,`designation`,`role_desc`,`exp_from`,`exp_to`) values ";$que='';
        foreach ($data as $key1 => $value1) {
            $query.="('{$user_id}',";
            foreach ($value1 as $key=>$value){
                if($key!="" && $value!=""){
                    $query.="'{$value}'".",";
                    //print_r($value);
                }
            }
            $query=rtrim($query,',');
            $query.="),";
                
        }
       $query=rtrim($query,',');
        $resultset = $this->mysqli->query ($query);
        if($resultset){
			return 	true;
		}
	}else{
		return 	$statusArr['msg']='Record not inserted successfully check parameters';
	}
}


public function error_msg($type , $var){
		if($type == 'registration'){
			$msg = 'Filed should not be blank';
			return  $msg;
		}else if($type =='email' && !empty($var)){
			if (!filter_var($var, FILTER_VALIDATE_EMAIL) === false) {
				$msg =1;
			} else{
				$msg = 'Enter valid email id';
			}
			return $msg;
		}
}

public function random_id_gen($length){
        //the characters you want in your id
        $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $max = strlen($characters) - 1;
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }

	private function printData($data) {
		echo "<pre>";
		return print_r ( $data );
	}
	
	// Check duplicate entry exists or not
	
	public function CheckDuplicate($data ,$catid, $columnbane, $table){
		$ischeck=false;
		$checkDuplicate ="select $columnbane from $table where $columnbane ='".$data."' and $columnbane ='".strtolower($data)."' and id!='".$catid."'";
			$resultset = $this->mysqli->query($checkDuplicate);
			if($resultset->num_rows > 0){
				return true;
			}
	}
   public function CheckAddDuplicate($data ,$catid, $columnbane, $table){
   		$checkDuplicate ="select $columnbane from $table where $columnbane ='".$data."' and $columnbane ='".strtolower($data)."' and  depart_id ='".$catid."'";
			$resultset = $this->mysqli->query($checkDuplicate);
			if($resultset->num_rows > 0){
				return true;
			}
   }
	public function CheckAddDuplicates($data,$columnbane, $table){
   		$checkDuplicate ="select $columnbane from $table where $columnbane ='".$data."' and $columnbane ='".$data."'";
			$resultset = $this->mysqli->query($checkDuplicate);
			if($resultset->num_rows > 0){
				return true;
			}
   }
	
	public function CheckDuplicateLocation($data ,$catid, $columnbane, $table,$locType){
		$ischeck=false;
		 	$checkDuplicate ="select $columnbane from $table where $columnbane ='".$data."' and $columnbane ='".strtolower($data)."' and location_id!='".$catid."' and location_type='".$locType."'";
			$resultset = $this->mysqli->query($checkDuplicate);
			if($resultset->num_rows > 0){
				return true;
			}
	}
	
	public function CheckAddDuplicatesBiller($data,$columnbane, $table){
   		$checkDuplicate ="select $columnbane from $table where $columnbane ='".$data."'";
			$resultset = $this->mysqli->query($checkDuplicate);
			if($resultset->num_rows > 0){
				return true;
			}
   }
	
	
	public function updateDataLocation( $data ,$id , $tablename,$locType){
		if(!empty($data)&& !empty($id) && $tablename!=""){
			$query='';$que='';
			foreach ($data as $key => $value) {
				if($key!="" && $value!=""){
					$query.="$key = '$value' ,";
				}	
			}
			$que = rtrim($query,',');
			$updateQuery ="update $tablename set $que where location_id ='".$id."' and location_type='".$locType."'";
			$results = $this->mysqli->query($updateQuery);
			if($results){
				return true;
			}
		}
}
	
	public function updateDataMultiple( $data ,$id , $tablename,$columnname){
		if(!empty($data)&& !empty($id) && $tablename!=""){
			$query='';$que='';
			foreach ($data as $key => $value) {
				if($key!="" && $value!=""){
					$query.="$key = '$value' ,";
				}	
			}
			$que = rtrim($query,',');
			$updateQuery ="update $tablename set $que where ".$columnname." ='".$id."'";
			$results = $this->mysqli->query($updateQuery);
			if($results){
				return true;
			}
		}
}
	
	public function updateDataMultiplenew( $data ,$id , $tablename,$columnname){
		if(!empty($data)&& !empty($id) && $tablename!=""){
			$query='';$que='';
			foreach ($data as $key => $value) {
					$query.="$key = '$value' ,";	
			}
			$que = rtrim($query,',');
			$updateQuery ="update $tablename set $que where ".$columnname." ='".$id."'";
			$results = $this->mysqli->query($updateQuery);
			if($results){
				return true;
			}
		}
}
	
	public function CheckDataExists_id($query){
		if ($resultset = $this->mysqli->query($query)){
			if ($resultset->num_rows > 0) {
				return true;
			}
		}
	}
   public function getDetailsQuery($data=array(),$query){
   			if(!empty($data) && $query!=""){
				echo "hello";die;
			}
   }
}

?>
