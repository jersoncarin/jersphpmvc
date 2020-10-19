<?php

class Files {
	
	public function __construct() 
	{
		// Empty Constructor
	}
	
	public function get($name,$tmp = NULL,$size = NULL,$type = NULL,$error = NULL) {
		
		$len = "['" . $name . "']";
		
		if(!is_null($tmp)) {
			$len .= "['" . $tmp . "']";
		} else if(!is_null($size)) {
			$len .= "['". $size . "']";
		} else if(!is_null($type)) {
			$len .= "['" . $type . "']";
		} else if(!is_null($error)) {
			$len .= "['" . $error . "']";
		}
		
		eval('$value = $_FILES'. $len . ';'); 

		return $value;
	}
	
}
