<?php 
/*
@Author: 	Ricardopxl
@URL: 		https://digitag.cl
@Date: 		20-02-2020
*/
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	set_time_limit(0);
	header('Content-Type: application/json');
	
	require('connector.class.php');

	if (!isset($_GET['query'])) {
		$arreglo = array('status'=>false,'data'=>'not_query_param');
		die(json_encode($arreglo));	
	}

	/**
	* GET DATA, please, sanitize the next query.
	**/
	$query = $_GET['query'];
	
	try {

		/**
		* Configuration available for this code
		**/
		$connector = new ConnectorPS();
		$connector->endPoint = 'https://1234.cl/api/';
		$connector->authorization = 'MYTOKENASDFGHJKLJHGFD';
		
		/*BUILD PARAMS TO SEARCH*/
		$params = array(
					'language' 	=> 1,
					'query' 	=> $query,
					'limit'		=> '0,100',
					'display'	=> 'full'
				);

		$response = $connector->find('search',$params);
		$response = json_decode($response);

		/**
		* Validate if responses has product
		**/
		if (!isset($response->products) AND empty($response->products)) {
			$arreglo = array('status'=>false,'data'=>'empty');
			die(json_encode($arreglo));
		}

		$arreglo = array('status'=>true,'data'=>$response->products);
		die(json_encode($arreglo));

	} catch (Exception $e) {
		if (!isset($response->products) AND empty($response->products)) {
			$arreglo = array('status'=>false,'data'=>'empty');
			die(json_encode($arreglo));
		}		
	}
?>
