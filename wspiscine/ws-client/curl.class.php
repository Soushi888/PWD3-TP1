<?php

// https://tonyspiro.com/curl-get-post-put-and-delete-using-php

class Curl {
	
	public function get($url){

		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = array();                                                   
		$result['info'] = curl_exec($ch);
		$array_curl_info = curl_getinfo($ch);
        $result['code'] = $array_curl_info['http_code'];
		return $result;
	}

	public function post($url, $dataString, $login=""){

		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($ch, CURLOPT_FAILONERROR, false);                                                                    
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
		
		curl_setopt($ch, CURLOPT_USERPWD, $login);	
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		 
		$result = array();
		$result['info'] = curl_exec($ch);
		$array_curl_info = curl_getinfo($ch);
		$result['code'] = $array_curl_info['http_code'];
		return $result;
	}

	public function put($url, $dataString, $login=""){

		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
		curl_setopt($ch, CURLOPT_FAILONERROR, false);                                                                    
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

		curl_setopt($ch, CURLOPT_USERPWD, $login);	
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		 
        $result = array();
		$result['info'] = curl_exec($ch);
		$array_curl_info = curl_getinfo($ch);
		$result['code'] = $array_curl_info['http_code'];
		return $result;
	}

	public function delete($url, $dataString, $login="test:testpwd"){

		$ch = curl_init($url);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
		curl_setopt($ch, CURLOPT_FAILONERROR, false);                                                                    
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

		curl_setopt($ch, CURLOPT_USERPWD, $login);	
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		 
		$result = array();
		$result['info'] = curl_exec($ch);
		$array_curl_info = curl_getinfo($ch);
		$result['code'] = $array_curl_info['http_code'];
		return $result;
	}

}
