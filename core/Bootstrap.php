<?php

class Bootstrap
{
	
	public function start() 
	{
		
		// set flag for null value or not exists
		$flag = FALSE;
		
		$url = $_SERVER['REQUEST_URI'];
	   //Check if the url contains only a "/" , if it's true then redirect to homepage or default page otherwise
	   if($url == '/') {
		
		  //Default page or home page
		  $controllerName = Config::$defaultHomePage;
		  $controller = new $controllerName();
		  $controller->index();
		
		} else {
			     
			    $url = explode("/", ltrim(rtrim($url,"/"), "/"));
			
			    //Get the controllerName through shifting the url
				$controllerName = ucfirst(array_shift($url));
				
				//Check if controllers is exists otherwise
				if (file_exists(PATH . 'controllers/'.$controllerName.'.php')) {
					
					//Create an new instance
					$controller = new $controllerName();
					
					if(!empty($url[0])) {
						
					  $actionName = array_shift($url);
				
					//Check for method exists of the controller
					 if (method_exists ( $controller , $actionName )) {
						  //Get the action Name A.K.A a function name to call and the parameter
						  $controller->{$actionName}(@$url);	
					  } else {
						
					    array_unshift($url,$actionName);
						$controller->index(@$url);
						
					  }
					
					} else {
						
						//Default index page
						$controller->index();
						
					}
					
				} else {
					
					// 404 Not Found
					$flag = TRUE;
					
			   }
			
			//Override 404 Not Found Controller here
			if($flag === TRUE) {
				$controllerName = Config::$defaultError404;
				$controller = new $controllerName();
				$controller->index();
			}
			
		}
	}
	
}