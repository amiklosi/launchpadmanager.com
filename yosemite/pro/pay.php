<?php 	
	require_once('../config.php');
	require_once('../log.php');
	if(isset($_GET['key'])){
		$key = $_GET['key'];

		$notifyURL = urlencode(OWN_SERVER. "/pro/notify.php?");
		$successURL = urlencode(OWN_SERVER. "/pro/success.php?");
		$cancelURL = urlencode(OWN_SERVER. "/pro/cancel.php?");
		
		$price = NET_PRICE + VAT;
		
		$url = PAYPAL_URL.'?'. 
			'cmd=_xclick&'.
			'business='.urlencode(PAYPAL_RECEIVER).'&'.
			'item_name='.urlencode('Launchpad Manager Yosemite').'&'.
			'item_number=2&'.
			"quantity=1&".
			"amount=$price&".
			"tax=0&".
			'currency_code=USD&'.
			(PAYPAL_TEST ? 'test_ipn=1&' : '').
			"notify_url=$notifyURL&".
			"return=$successURL&".
			"cancel_return=$cancelURL&".
			"on0=Licence Key:&".
			"os0=".urlencode($key)
			;
			
		header( "Location: $url" ) ;
	}
?>
	
