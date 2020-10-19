<?php

class Request {
	
	public function __construct() 
	{
		// Empty Constructor
	}
	
	public function get($key) {
		return isset($_GET[$key]) ? $_GET[$key] : NULL;
	}
	
	public function post($key) {
		return isset($_POST[$key]) ? $_POST[$key] : NULL;
	}
	
	public function server($request) {
		return isset($_SERVER[strtoupper($request)]) ? $_SERVER[strtoupper($request)] : NULL;
	} 
	
	public function request($key) {
		return isset($_REQUEST[$key]) ? $_REQUEST[$key] : NULL;
	}
	
	private static function url() {
		if(isset($_SERVER['HTTPS'])){
           $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
		    }
		    else{
		        $protocol = 'http';
		    }
		  return empty(Config::$baseURL) ? $protocol . "://" . $_SERVER['HTTP_HOST'] : Config::$baseURL;
	}
	
	public static function base_url($query) {
		$first_el = $query[0];
		
		if($first_el != "/") 
           $query = "/" . $query;
		
		return Request::url() . $query;
	}
	
	public static function redirect($query,$delay = NULL) {
		
	 if(is_null($delay)) {
		header("Location:" . $query);
	  } else {
		header( "refresh:" . $delay . "; url=" . $query);
	  }
	
	}
	
}