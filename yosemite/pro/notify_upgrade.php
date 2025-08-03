<?php


require('../config.php');
require('../log.php');
require_once "Mail.php";

mysql_connect("localhost", "root", "z3bral0") or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());

error_reporting(E_ALL ^ E_NOTICE); 

$email = $_REQUEST['regEmail'];
$custom = $_REQUEST['custom'];

log_action("IPN Notification Handle Start For Upgrade".$email);

$ipn_post_data = $_POST;

// Set up request to PayPal
$request = curl_init();
curl_setopt_array($request, array
(
    CURLOPT_URL => PAYPAL_URL,
    CURLOPT_POST => TRUE,
    CURLOPT_POSTFIELDS => http_build_query(array('cmd' => '_notify-validate') + $ipn_post_data),
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HEADER => FALSE,
    CURLOPT_SSL_VERIFYPEER => FALSE
));

log_action("IPN Sending Verification Data to: ". PAYPAL_URL);

// Execute request and get response and status code
$response = curl_exec($request);
$status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

// Close connection
curl_close($request);


if($status == 200 && $response == 'VERIFIED')
{

    log_action("IPN Post Data: ". print_r($ipn_post_data, true));

	if ($ipn_post_data['payment_status'] != 'Completed') {
		log_action("Payment Status Instead Of Completed Is: ". $ipn_post_data['payment_status']);
		return;
	}

	$quantity = 1;
	$priceToMeet = UPGRADE_NET_PRICE + UPGRADE_VAT;
	if ($ipn_post_data['mc_gross'] < $priceToMeet) {
		log_action("Payed Amount Is Not Sufficient: ". $ipn_post_data['mc_gross']);
		return;
	}
    log_action("IPN Successfully Verified");
    
    $name = $ipn_post_data['first_name'] . ' '. $ipn_post_data['last_name'];

    $email = $_POST['payer_email'];   
    $to      = $ipn_post_data['payer_email'];
	$subject = 'Launchpad Manager Upgrade Confirmation';
	$message = "Hi $name,\n\nThanks for upgrading Launchpad Manager.\n\n".
    	"Your registered email is: $email\n";
    
	$token = isset($_POST['option_selection1']) ? $_POST['option_selection1'] : $_POST['option_selection1_1'];
	$message .= "Your licence key is: $token\n\n";

	$query = "INSERT INTO licenses (email, licensekey, purchaseinfo) VALUES('".mysql_escape_string($email)."','". mysql_escape_string($token)."','".mysql_escape_string(print_r($ipn_post_data, true))."'  ) ";
	mysql_query($query) or die(mysql_error()); 	
	
	if (isset($_POST['option_selection2'])) {
		log_action('Decreasing Promotion '.$promoCode);
		decreasePromotion($promoCode);
	}

    $message .= "\n";
    $message .= "To enter the licence key please click on the Help menu then select Register Launchpad Manager. Please note that you need to enter the email address and the key exactly as they are in this email in order to be able to unlock the product.\n";
    $message .= "If you have any problems please use the contact form on the website or reply to this email.\n";
    $message .= "\n";
    $message .=	"Kind regards,\nAttila Miklosi";
	$headers = 'From: '.OWN_EMAIL. "\r\n";
	$headers .= 'Bcc: attila.miklosi@gmail.com'. "\r\n";	
	
	$host = "ssl://smtp.gmail.com";
	$port = "465";
	$username = "miklosi.attila";
	$password = "mokusmalac36";


	$headers = array ('From' => "Attila Miklosi <attila.miklosi@gmail.com>",
          'To' => $to,
          'Subject' => $subject,
          'Bcc' => 'attila.miklosi@gmail.com');
	if ($to != $ipn_post_data['payer_email']) {
		$headers['Cc'] = $ipn_post_data['payer_email'];
	}
	$smtp = Mail::factory('smtp',
	  array ('host' => $host,
		'port' => $port,
		'auth' => true,
		'username' => $username,
		'password' => $password));

	$mail = $smtp->send($to, $headers, $message);

	if (PEAR::isError($mail)) {
	  log_action("Mail Error:" . $mail->getMessage());
	} else {
	  log_action("Message successfully sent!");
	}
    
}
else
{
    log_action("IPN Verification Failed $status $response");
}

?>