<?php
    //Enable realtime errors
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

   //Check for Valid PHP Version?
	$minPHPVersion = '7.2';
	if (phpversion() < $minPHPVersion)
	{
		die("Your PHP version must be {$minPHPVersion} or higher to run JersMVC. Current version: " . phpversion());
	}
	unset($minPHPVersion);
	
	//Start session
	session_start();
	
	// Front Controller Path (Not this path file)
    define("PATH", wp_normalize_path(dirname(realpath(__DIR__))) . "/");
  
    // Registering All Class from the MVC
    // Don't Modify This Code

    function register_class($folder){
        foreach (glob("{$folder}/*.php") as $filename)
        {
            require_once $filename;
        }
    }

    register_class(PATH . "core");
    register_class(PATH . "controllers");
    register_class(PATH . "models");

    function wp_normalize_path( $path ) {
        $path = str_replace( '\\', '/', $path );
        $path = preg_replace( '|(?<=.)/+|', '/', $path );
        if ( ':' === substr( $path, 1, 1 ) ) {
            $path = ucfirst( $path );
        }
        return $path;
    }

/*
 *---------------------------------------------------------------
 * INITIALIZE HEADERS
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
*/

// Ensure the current directory is pointing to the controller's directory
chdir(__DIR__);

// Create an instance to our core
$header = new Headers();
 
// Start our apps
$header->start();