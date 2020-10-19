<?php

class Loader {
	
	public static function get($className) {
		
		$path = $className[0] == '/' ? substr($className,1) : $className;
		$class = explode("/",$path);
        $output = $class[count($class)-1];
        
        if(file_exists(PATH . $path . ".php")) {
         	require PATH . $path . ".php";
             return new $output();
        } else {
        	die("Not found");
            return false;
        }
			
		
	}
	
	
}