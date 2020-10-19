<?php

class Form {
	
	public static function open($args) {
		
		$security = new Security();
		
		$form = "<form";
		
		foreach($args as $key => $val) {
		  if($key != "token")
			$form .= ' ' . $key . '="' . $val . '"';
		}
		
		$form .= ">\n\t\t\t";
		
		echo $form;
		
		if(!is_null($args["token"])) {
			
			$token = "token_" . $args["token"];
		
		    Form::input(array("type" => "hidden", "name" => $token, "value" => Token::getToken($token)));
		
		}
		
	}
	
	public static function validate($token) {
		
		$token = "token_" . $token;
		
		if(Form::checkToken($token)
            && hash_equals($_POST[$token],$_SESSION[$token])) {
             	
			return true;
		}
		
		return false;
	}
	
	private static function checkToken($token) {
		return isset($_POST[$token]) && isset($_SESSION[$token]) ? true : false;
	}
	
	public static function honey_pot() {
		Form::input(array("type" => "text", "name" => "verify_pot", "style" => "display:none"));
	}
	
	public static function verify_honey_pot() {
		return empty($_POST['verify_pot']);
	}
	
	public static function input($args,$noclass = NULL) {
		$security = new Security();
		
		$input = "<input";
		
		foreach($args as $key => $val) {
			
			$input .= ' ' . $key . '="' . $security->xss_clean($val) . '"';
			
		}
		
		if(!is_null($noclass)) {
		  $input .= " " . $noclass . ">\n";
		} else 
		   $input .= ">\n";
		
		echo $input;
		
	}
	
	public static function close() {
		echo "</form>";
	}
	
}