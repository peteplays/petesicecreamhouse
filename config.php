<?php 
/*
http://peteplays.com/petesicecreamhouse
config.php

@author: plays.dev@gmail.com
19 June 2015

CONTENTS:
DB info
pages
service
pricing data
product data
function to: display all currency with $ and 2 decimal places


Revisions:


*/

//--db and collection
$G_dev_db = 'site';
$G_pich_collection = 'petesicecreamhouse';

//--pages
$base_url = '/';
$pich_url = '/petesicecreamhouse/';

//--service
$order_service_url = $pich_url.'service/order_service.php';

//--get pricing data
$price_JSON = file_get_contents('data/prices.json');
$G_price_data = json_decode($price_JSON);

//--get product data
$product_JSON = file_get_contents('data/products.json');
$G_product_data = json_decode($product_JSON);

//--display all currency with $ and 2 decimal places
function show_currency_correctly($pass_num) {
	$currency_formatted = '';
	$cents = strstr($pass_num, '.');
	if( $cents ) {
		$dollars = strstr($pass_num, '.', true);		
		if( strlen($cents) <= 3 ) {
			if( strlen($cents) == 2 ) {
				$cents .= '0';
			}
			if( strlen($cents) == 1 ) {
				$cents .= '00';
			}	
		}
		$currency_formatted = '$'.$dollars.$cents;
	} else {
		$currency_formatted = '$'.$pass_num.'.00';
	}	
	return $currency_formatted;
}

?>