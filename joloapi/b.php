<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//$mobile=$_REQUEST['mobile'];
//$operator=$_REQUEST['operator'];
//$amount=$_REQUEST['amount'];

//generating random unique orderid for your reference
//$uniqueorderid = substr(number_format(time() * rand(),0,'',''),0,10); 

$ch = curl_init();
$timeout = 100; // set to zero for no timeout

$myHITurl ="https://joloapi.com/api/findplan.php?userid=PinkStar&key=563904175433643&opt=28&cir=1&type=json";

//$myHITurl ="http://joloapi.com/api/recharge.php?mode=1&userid=PinkStar&key=563904175433643&operator=$operator&service=$mobile&amount=$amount&orderid=$uniqueorderid";
curl_setopt ($ch, CURLOPT_URL, $myHITurl);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
$curl_error = curl_errno($ch);
curl_close($ch);
//dump output of api if you want during test
echo "<pre>";print_r($file_contents);die;
#echo '&&&&&&&&&'."$file_contents";die;
// lets extract data from output for display to user and for updating databse
$maindata = explode(",", $file_contents);
$countdatas = count($maindata);
if($countdatas > 2){
//recharge is success
$joloapiorderid = $maindata[0]; //it is joloapi.com generated order id
$txnstatus = $maindata[1]; //it is status of recharge SUCCESS,FAILED
$operator= $maindata[2]; //operator code
$service= $maindata[3]; //mobile number
$amount= $maindata[4]; //amount
$mywebsiteorderid= $maindata[5]; //your website order id
$errorcode= $maindata[6]; // api error code
$operatorid= $maindata[7]; //original operator transaction id
$myapibalance= $maindata[8]; //my joloapi.com remaining balance
$myapiprofit= $maindata[9]; //my earning on this recharge
$txntime= $maindata[10]; // recharge time
}else{
//recharge is failed
$txnstatus = $maindata[0]; //it is status of recharge FAILED
$errorcode= $maindata[1]; // api error code
}
if($curl_error=='28'){
//Request timeout, consider recharge status as pending/success
$txnstatus = "PENDING";
}
if($txnstatus=='SUCCESS'){
//YOUR REST QUERY HERE
	echo "Done Recharge";

}
if($txnstatus=='PENDING'){
//YOUR REST QUERY HERE
}
if($txnstatus=='FAILED'){
//YOUR REST QUERY HERE
	echo "Done Pending";
}
//display the result to customer
echo"<br/><br/>joloapi order ID: $joloapiorderid";
echo"<br/>";
echo"Recharge Status: $txnstatus";
echo"<br/>";
echo"Operator: $operator";
echo"<br/>";
echo"Number: $service";
echo"<br/>";
echo"Amount: $amount";
echo"<br/>";
echo"MY order id: $mywebsiteorderid";
echo"<br/>";
echo"Operator Txn ID: $operatorid";
echo"<br/>";
echo"Error No.: $errorcode";
echo"<br/>";
?>
