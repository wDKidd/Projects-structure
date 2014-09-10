<?php
$SERVER_ip = $_SERVER['HTTP_HOST'];
$base_path = '';

if($SERVER_ip=='192.168.1.127'){
	$base_path = 'http://192.168.1.127/Kayla_Testing/smacss_structure/';
}
elseif($SERVER_ip=='demo.designguru.co.za' || $SERVER_ip=='www.demo.designguru.co.za' || $SERVER_ip=='www.designguru.co.za/demo' || $SERVER_ip=='designguru.co.za/demo'){ //demo path
	$base_path = 'http://demo.designguru.co.za/pictivate/v1/';
}
else{ //client
	$base_path = '';
}
?>