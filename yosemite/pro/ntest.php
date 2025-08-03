<?php

require('../config.php');
require('../log.php');
require '../../vendor/autoload.php';
$apiKey = SENDGRID_APIKEY;
$sendgrid = new \SendGrid($apiKey);

$conn = mysqli_connect("mysql", "root", "z3bral0") or die(mysqli_error($conn));
mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

ini_set('display_errors', 1);
error_reporting(E_ALL);

phpinfo();
    file_put_contents('php://stderr', "Hekkdoeijfweuf wehi");

$email = "a";
$custom = "b";

log_action("IPN Notification Handle Start ".$email);

$ipn_post_data = $_POST;

// Set up request to PayPal



function getPriceForPromo($code) {
	global $conn;
	$query = "SELECT * FROM promos WHERE code='$code' LIMIT 1;";
	$gUser = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$verify = mysqli_num_rows($gUser);
	if ($verify>0) {
		$row = mysqli_fetch_array( $gUser );
		return $row['price'];
	} else {
		return -1;
	}
}

function decreasePromotion($promoCode) {
	global $conn;
	$query = "UPDATE promos SET remaining = remaining - 1 WHERE code='$promoCode';";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
}

	$quantity = 1;
	$promoCode = 0;
	$priceToMeet = NET_PRICE + VAT;
	if (isset($_POST['option_selection2'])) {
		$priceToMeet = getPriceForPromo($promoCode);
	}
	log_action("IPN Successfully Verified");

	$name = "JANOS JANOS";

	$email = "attila.miklosi@gmail.com";
	$to      = "attila.miklosi@gmail.com";
	$subject = 'Launchpad Manager Order Confirmation';
	$message = "Hi $name,\n\nThanks for purchasing Launchpad Manager.\n\n".
		"Your registered email is: $email\n";

	$token = "tok";
	$message .= "Your licence key is: $token\n\n";

	$query = "INSERT INTO licenses (email, licensekey, purchaseinfo) VALUES('".mysqli_escape_string($conn, $email)."','". mysqli_escape_string($conn, $token)."','".mysqli_escape_string(print_r($ipn_post_data, true))."'  ) ";
	mysqli_query($conn, $query) or die(mysqli_error($conn));

	if (isset($_POST['option_selection2'])) {
		log_action('Decreasing Promotion '.$promoCode);
		decreasePromotion($promoCode);
	}

	$message .= "\n";
	$message .= "To enter the licence key please click on the Help menu then select Register Launchpad Manager. Please note that you need to enter the email address and the key exactly as they are in this email in order to be able to unlock the product.\n";
	$message .= "If you have any problems please use the contact form on the website or reply to this email.\n";
	$message .= "\n";
	$message .=	"Kind regards,\nAttila Miklosi";

	log_action("Sending mail to ".$to);
	try {
		$email = new \SendGrid\Mail\Mail();
		$email->setFrom("attila.miklosi@gmail.com", "Attila Miklosi");
		$email->setSubject($subject);
		$email->addTo($to);
		$email->addBcc("attila.miklosi@gmail.com");

		$email->addContent("text/plain", $message);
		$response = $sendgrid->send($email);
		log_action("Notification sent properly to ". $to);
	} catch (Exception $e) {
		log_action('Sending email exception: '.  $e->getMessage(). "\n");
	}
?>