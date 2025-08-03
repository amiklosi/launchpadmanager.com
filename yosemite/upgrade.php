<?php 		
	require_once('../config.php');
	require_once('../log.php');
	
	mysql_connect("localhost", "root", "z3bral0") or die(mysql_error());
	mysql_select_db(DB_NAME) or die(mysql_error());

	function eligibleForUpgrade($key) {
		$query = "SELECT * FROM licenses_legacy WHERE licensekey='$key' LIMIT 1;";
		$gUser = mysql_query($query) or die(mysql_error());
		$verify = mysql_num_rows($gUser);
		return ($verify>0);
	}

	if(isset($_GET['key'])){
		$key = $_GET['key'];

		if (eligibleForUpgrade($key)) {

			$notifyURL = urlencode(OWN_SERVER. "/notify_upgrade.php?".$params);
			$successURL = urlencode(OWN_SERVER. "/success.php?".$params);
			$cancelURL = urlencode(OWN_SERVER. "/cancel.php?".$params);
			
			$price = UPGRADE_NET_PRICE + UPGRADE_VAT;
			
			$url = PAYPAL_URL.'?'. 
				'cmd=_xclick&'.
				'business='.urlencode(PAYPAL_RECEIVER).'&'.
				'item_name='.urlencode('Launchpad Manager Upgrade').'&'.
				'item_number=1&'.
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
		} else {
			echo "Not eligible";
		}
	}
?>
	
