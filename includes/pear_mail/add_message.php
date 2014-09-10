<?php
switch($_GET['a']){
	case 0 : //test
		$message = '<html><head></head><body>MAIL SENT</body></html>';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: sender@designguru.co.za' . "\r\n";

		$result = mail('designguru.sa29@gmail.com', 'Test Email from Website', $message, $headers);
		
		if($result>0){
			echo '1';
		}
		else{
			echo '0';
		}
	break;
	
	case 1 : //Website Enquiry
		include_once('process/pages/web_enquiry.php');
		
		$result = 0; //the result of the mail being sent
		$to = 'designguru.sa29@gmail.com';
		
		$client = 'Client Name';
		$subject = 'Enquiry from website - '.$client;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$_POST['email']. "\r\n";
		
		if ($_POST['email']){
			$result = mail($to, $subject, $sending, $headers);
		}
		
		if($result>0){ echo '1'; }
		else{ echo '0'; }
	break;	
}
?> 