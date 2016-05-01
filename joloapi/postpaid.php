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
$myHITurl="https://joloapi.com/api/findoperator.php?userid=PinkStar&key=563904175433643&mob=8826858460&type=text";
//$myHITurl ="http://joloapi.com/api/cbill.php?mode=1&userid=PinkStar&key=563904175433643&operator=$operator&service=$mobile&amount=$amount&orderid=$uniqueorderid&type=text";
curl_setopt ($ch, CURLOPT_URL, $myHITurl);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch);
$curl_error = curl_errno($ch);
curl_close($ch);
//dump output of api if you want during test
echo "<pre>";print_r($file_contents);die;
?>