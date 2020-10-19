<?php

class Token {
	
    private static function getRandomize() {
		    $length = 50;
		    $token = "";
		    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		    $codeAlphabet.= "0123456789";
		    $max = strlen($codeAlphabet);
		
		    for ($i=0; $i < $length; $i++) {
		        $token .= $codeAlphabet[random_int(0, $max-1)];
		    }
		
		    return $token;
	}
	
	public static function get($token_name) {
		$session = new Session();
		return $session->get("token_" . $token_name);
	}
	
	public static function getToken($token_name) {
		$session = new Session();
		if(empty($session->get($token_name)))
			$session->set($token_name, Token::getRandomize());
		return $session->get($token_name);
	}
	
}