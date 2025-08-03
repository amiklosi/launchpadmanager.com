<?php 		
	mysql_connect("localhost", "root", "z3bral0") or die(mysql_error());
	mysql_select_db("launchpadmanager") or die(mysql_error());

	$promoPrice = 0;	

	function remainingPromosFor($code) {
		global $promoPrice;
		$query = "SELECT * FROM promos WHERE code='$code' LIMIT 1;";
		$gUser = mysql_query($query) or die(mysql_error());
		$verify = mysql_num_rows($gUser);
		if ($verify>0) {
			$row = mysql_fetch_array( $gUser );
			$promoPrice = $row['price'];
			return $row['remaining'];
		} else {
			return -1;
		}
	}
	
	function decreasePromotion($promoCode) {
		$query = "UPDATE promos SET remaining = remaining - 1 WHERE code='$promoCode';";
		$result = mysql_query($query) or die(mysql_error());
	}
	
	if(isset($_GET['code']) && isset($_GET['key'])){
		$key = $_GET['key'];
		$code = $_GET['code'];
		$remaining = remainingPromosFor($_GET['code']);
		if ($remaining > 0) {
			require('../config.php');

			$notifyURL = urlencode(OWN_SERVER. "/notify.php?".$params);
			$successURL = urlencode(OWN_SERVER. "/success.php?".$params);
			$cancelURL = urlencode(OWN_SERVER. "/cancel.php?".$params);
			
			$amount = NET_PRICE;
			$vat = VAT * $quantity;
			
			$url = PAYPAL_URL.'?'. 
				'cmd=_xclick&'.
				'business='.urlencode(PAYPAL_RECEIVER).'&'.
				'item_name='.urlencode('Launchpad Manager').'&'.
				'item_number=1&'.
				"quantity=1&".
				"amount=$promoPrice&".
				"tax=0&".
				'currency_code=USD&'.
				(PAYPAL_TEST ? 'test_ipn=1&' : '').
				"notify_url=$notifyURL&".
				"return=$successURL&".
				"cancel_return=$cancelURL&".
				"on0=Licence Key:&".
				"os0=".urlencode($key)."&".
				"on1=Promo Code:&".
				"os1=$code"
				;
				
			header( "Location: $url" ) ;			
		} else
		{
			echo "Sorry this promotional key does not work any more";
		}
	}
?>
	
