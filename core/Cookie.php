<?php

class Cookie {
	
	private $security;
	
	public function __construct($security) 
	{
		// Empty Constructor
		
		$this->security = $security;
	}
	
	public function get($key) {
		if(isset($_COOKIE[$this->security->decrypt($key)]))
			return $this->security->decrypt($_COOKIE[$this->security->decrypt($key)]);
		else
			return false;
	}

	public function destroy($key = NULL) {

		if(!is_null($key)) {

			$this->cookie = $this->security->encrypt($key);
			if (isset($_COOKIE[$this->cookie])) {
				unset($_COOKIE[$this->cookie]); 
				setcookie($this->cookie, null, -1, '/'); 
			}

		} else {

			if (isset($_SERVER['HTTP_COOKIE'])) {
				$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
				foreach($cookies as $cookie) {
					$parts = explode('=', $cookie);
					$name = trim($parts[0]);
					setcookie($name, '', time()-1000);
					setcookie($name, '', time()-1000, '/');
				}
			}
			
		}
	}
	
	public function set($key,$val,$time , $callback = "/") {
		if(!is_null($key) && !is_null($val) && !is_null($time))
		  setcookie($this->security->encrypt($key),$this->security->encrypt($val),$time,$callback);
	}
}