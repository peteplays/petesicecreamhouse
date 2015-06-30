<?php 
/*
http://peteplays.com/petesicecreamhouse/service
order_service.php

@author: plays.dev@gmail.com
19 June 2015

this program will add an order or view orders from site . petesicecreamhouse

REQUIRED:
config.php
opt - write | read
data

CODE:
0 - system error
1 - complete
2 - nothing was done / exiting
3 - error getting data

Revisions:


*/
include '../config.php';

date_default_timezone_set('America/New_York');

function reply($code, $message, $data) {
	$response = array();
	$response["code"] = $code;
	$response["message"] = $message;
	if( $data != null ) {
		$response["data"] = $data;
	}	
	echo json_encode($response);
	exit(0);
}

$opt = '';
//--check for writing record or reading records
if( isset( $_GET['opt'] ) && $_GET['opt'] != '' ) {
	$opt = $_GET['opt'];
} else {
	reply(4, "opt must be set.", null);
}
//--change DB search parameter
if( isset( $_GET['vendor'] ) && $_GET['vendor'] != '' ) {
	$vendor = $_GET['vendor'];
} else {
	$vendor = 'UI_send';
}
//--connect to db
try{
	$url = $_ENV['OPENSHIFT_MONGODB_DB_URL'];
	$mongo = new Mongo($url);
}catch(Exception $e) {
	reply(0.1, "DB is not available. Please try again later. Error: ", $e->getMessage());
}	
try {
	$db_dev = $mongo->$G_dev_db;
} catch(Exception $e) {
	reply(0.2, "DB is not available. Please try again later. Error: ", $e->getMessage());
}
try {
	$coll_pich = $db_dev->$G_pich_collection;
} catch(Exception $e) {
	reply(0.3, "Collection is not available. Please try again later. Error: ", $e->getMessage());
}

if( $opt == 'write' ) {
	$doc = array();
	$key_check == 0;
	//--get data
	$getting_data = file_get_contents('php://input');
	if( $getting_data === false ) {
		reply(3.1, "Error getting the data in body from POST.", null);
	} else if( strlen($getting_data) <= 0 ) {
		reply(3.2, "Error - data in body is zero length in POST.", null);
	} else {	
		parse_str($getting_data, $doc);
	}

	try {
		$input = array();
		//--pass doc to input to write to db
		$input['product'] = $doc['product'];
		$input['price'] = $doc['price'];
		$input['ice_cream_type'] = $doc['icecream_type'];
		if( isset($doc['cone_type']) && $doc['cone_type'] != '' && $doc['cone_type'] != 'none' ) {
			$input['cone_type'] = $doc['cone_type'];
		}
		if( isset( $doc['soda_type'] ) && $doc['soda_type'] != '' ) {
			$input['soda_type'] = $doc['soda_type'];
		}
		if( isset( $doc['milk_type'] ) && $doc['milk_type'] != '' ) {
			$input['milk_type'] = $doc['milk_type'];
		}
		$input['vendor'] = $doc['vendor'];
		$input['dts'] = date(DATE_W3C);
		//--write input to db
		$coll_pich->insert($input);
		reply(1, "Record Written", null);
	} catch(Exception $e) {
		reply(0.4, "Could not write to collection. Error: ", $e->getMessage());
	}
}

if( $opt == 'read' ) {
	try{
		$master_output = array();
		$rec_num = 0;
		//--search db
		$search = array( 'vendor' => $vendor );
		$date_sort = array( 'dts' => -1 );
		$cursor = $coll_pich->find( $search )->sort( $date_sort );
		//--read records
		while( $cursor->hasNext() ) {
			$db_data = $cursor->getNext();
			if ( $db_data ) {
				$record = array();
				$rec_num++;
				$record['product'] = $db_data['product'];
				$record['price'] = $db_data['price'];
				$record['ice_cream_type'] = $db_data['ice_cream_type'];
				if( isset($db_data['cone_type']) && $db_data['cone_type'] != '' ) {
					$record['cone_type'] = $db_data['cone_type'];
				}
				if( isset($db_data['soda_type']) && $db_data['soda_type'] != '' ) {
					$record['soda_type'] = $db_data['soda_type'];
				}
				if( isset($db_data['milk_type']) && $db_data['milk_type'] != '' ) {
					$record['milk_type'] = $db_data['milk_type'];
				}
				$record['vendor'] = $db_data['vendor'];
				$record['rec_num'] = $rec_num;
				//--gather records for output
				array_push($master_output, $record);				
			}
		}
		reply(1, "Complete. Viewing ".$rec_num." records.", $master_output);
	}catch(Exception $e) {
		reply(0.5, "Could not read the collection. Error: ", $e->getMessage());
	}
}
//--shouldnt get here
reply(2, "Nothing Doing... exiting...", null);
?>