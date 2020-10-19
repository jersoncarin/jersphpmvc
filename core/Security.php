<?php


class Security {
	
	public function __construct() {
		//Empty Constructor
	}
	
	private function encrypt_decrypt($action, $string) {
	    $output = false;
	
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'Q9qZtuXnHoTKXIK';
	    $secret_iv = 'L8ZsrKnHZRZxtXD';
	
	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	
	    if ( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    } else if( $action == 'decrypt' ) {
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }
	
	    return $output;
	}
	
	public function encrypt($string) {
		return $this->encrypt_decrypt("encrypt",$string);
	}
	
	public function decrypt($string) {
		return $this->encrypt_decrypt("decrypt",$string);
	}
	
	public function xss_clean($string) {
		return htmlspecialchars($string, ENT_QUOTES, Config::$charset);
	}

	public static function clean_xss($string) {
		return htmlspecialchars($string, ENT_QUOTES, Config::$charset);
	}
	
	public function remove_script($script_str) {
	    $script_str = htmlspecialchars_decode($script_str);
	    $search_arr = array('<script', '</script>');
	    $script_str = str_ireplace($search_arr, $search_arr, $script_str);
	    $split_arr = explode('<script', $script_str);
	    $remove_jscode_arr = array();
	    foreach($split_arr as $key => $val) {
	        $newarr = explode('</script>', $split_arr[$key]);
	        $remove_jscode_arr[] = ($key == 0) ? $newarr[0] : $newarr[1];
	    }
	    return implode('', $remove_jscode_arr);
	}
	
	public function print_clean_json($array) {
		header('Content-Type: application/json');
		echo json_encode($array,JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS);
	}
}