<?php

class Message {
	
	public static function set($key,$val) {
		
	 if(isset($key) && isset($val)) {
		$session = new Session();
		$session->set($key,$val);
	  }
	
	}
	
	public static function destroy($key) {
		$session = new Session();
		$session->remove($key);
	}
	
	public static function get($key) {
		
	 if(isset($key)) {
		
		$sec = new Security();
		$session = new Session();
		$data = $session->get($key);
		
		return $sec->xss_clean($data);
		
	  }
		
	  return false;
		
	}
	
}