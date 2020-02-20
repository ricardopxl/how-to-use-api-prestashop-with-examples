<?php  
/*
@Author: 	Ricardopxl
@URL: 		https://digitag.cl
@Date: 		20-02-2020
*/
	class ConnectorPS 
	{
		public $endPoint = 'http://url/api/';
		public $authorization = "YOUR_TOKEN_AUTHORIZATION";
		public $outPut = array('output_format'=>'JSON'); # RECOMENDED FOR THIS CODE
		
		public function find($action=null,$params)
		{
			$params = http_build_query(array_merge($params,$this->outPut));
			$url = $this->endPoint.$action."?".$params;
			return $this->getCurl($url);
			// return $this->getCurl($this->endPointurl,$action."?".$params);
		}

		private function getCurl($url,$event='')
		{
			$ch = curl_init();
			$url = $url.$event;
			curl_setopt($ch, CURLOPT_USERPWD, $this->authorization.":");
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$resp = curl_exec($ch);
			curl_close($ch);

			return $resp;
		}

		private function postCurl($url, $event = "", $json = "")
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url.$event);
			
			if (!empty($json)) 
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($json));
			}

			$authorization = "token: ".$this->token;
			curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec($ch);
			curl_close ($ch);

			return $server_output;
		}
	}
?>
