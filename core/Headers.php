<?php

class Headers {
	
	public function __construct() {
		
		if(Config::$CSPEnabled === true) {
			header("Content-Security-Policy-Report-Only: default-src 'none';");
		}

		if(Config::$allow_x_frame_option === true)
			header("X-Frame-Options: SAMEORIGIN");

		if(Config::$allow_x_content_type_option === true)
			header('X-Content-Type-Options: nosniff');
		
		if(Config::$strict_security_transport === true)
			header("Strict-Transport-Security:max-age=63072000");
		
		if(empty(Config::$defaultLocale)) {
			
			setlocale(LC_ALL,NULL);
			
		} else {
			
			if(setlocale(LC_ALL,Config::$defaultLocale) === false) {
				die("Error While Setting Locale, Use Valid Locale. Current invalid locale ->" . Config::$defaultLocale);
			}
			
		}
		
		if(!date_default_timezone_set (Config::$appTimezone)) {
			die("Timezone not valid");
		}
		
		if(Config::$enabledCache === false) {
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
		}
		
		if(Config::$header_xss_filter === true) {
			header("X-XSS-Protection: 0");
		}
		
		if(Config::$allow_cross_origin === true) {
			$this->cross_origin();
		}

        header('Content-type: text/html; charset=' . Config::$charset );
      
	}
	
	
/**
 *  It will allow any GET, POST, or OPTIONS requests from any
 *  origin.
 *
 *  In a production environment, you probably want to be more restrictive, but this gives you
 *  the general idea of what is involved.  For the nitty-gritty low-down, read:
 *
 *  - https://developer.mozilla.org/en/HTTP_access_control
 *  - http://www.w3.org/TR/cors/
 *
 */
 
private function cross_origin() {

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

}
	
	public function start() 
	{
		$core = new Bootstrap();
		$core->start();
	}
	
}