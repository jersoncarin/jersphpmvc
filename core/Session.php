<?php 

class Session {
	
	
	public function get($key) {
		return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
	}
	
	public function set($key, $val) {
		
		if(!is_null($key) && !is_null($val))
		    $_SESSION[$key] = $val;
		
	}
	
	public function remove($key) {
		unset($_SESSION[$key]);
	}
	
	public function destroy() {
		
		session_destroy();
	}
}