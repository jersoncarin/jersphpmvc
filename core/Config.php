<?php

class Config {
	
	/*
	|--------------------------------------------------------------------------
	| Base Site URL
	|--------------------------------------------------------------------------
	|
	| URL to your JERSMVC root. Typically this will be your base URL,
	| WITH a trailing slash:
	|
	|	http://example.com/
	|
	| If this is not set then JersMVC will try guess the protocol, domain
	| and path to your installation. However, you should always configure this
	| explicitly and never rely on auto-guessing, especially in production
	| environments.
	|
	*/
	public static $baseURL = '';
	
	/*
	|--------------------------------------------------------------------------
	| HomePage
	|--------------------------------------------------------------------------
	| This is the default of landing page or home page
	|
	*/
	public static $defaultHomePage = "Home";
	
	/*
	|--------------------------------------------------------------------------
	| 404 Page
	|--------------------------------------------------------------------------
	| This is the default of 404 not found page
	|
	*/
	public static $defaultError404 = "Error404";
	
	/*
	|--------------------------------------------------------------------------
	| Header XSS Filter
	|--------------------------------------------------------------------------
	| Enable XSS Protection in your header
	|
	*/
	public static $header_xss_filter = true;
	
	/*
	|--------------------------------------------------------------------------
	| X-Frame-Options
	|--------------------------------------------------------------------------
	| Allow X-Frame-Options otherwise
	|
	*/
	public static $allow_x_frame_option = true;

	/*
	|--------------------------------------------------------------------------
	| Strict Security Transport
	|--------------------------------------------------------------------------
	| Allow Strict Security Transport otherwise
	|
	*/
	public static $strict_security_transport = true;

	/*
	|--------------------------------------------------------------------------
	| X-Content-Type-Options
	|--------------------------------------------------------------------------
	| Allow X-Content-Type-Options otherwise
	|
	*/
	public static $allow_x_content_type_option = true;

	/*
	|--------------------------------------------------------------------------
	| Cross-Origin Resource Sharing
	|--------------------------------------------------------------------------
	| Allow Cross-Origin Resource Sharing otherwise
	|
	*/
	public static $allow_cross_origin = false;
	
	/*
	|--------------------------------------------------------------------------
	| Default Locale
	|--------------------------------------------------------------------------
	|
	| The Locale roughly represents the language and location that your visitor
	| is viewing the site from. It affects the language strings and other
	| strings (like currency markers, numbers, etc), that your program
	| should run under for this request.
	|
	*/
	public static $defaultLocale = '';
	
	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| The default timezone that will be used in your application to display
	| dates with the date helper, and can be retrieved through app_timezone()
	|
	*/
	public static $appTimezone = 'Asia/Manila';

	/*
	|--------------------------------------------------------------------------
	| Default Character Set
	|--------------------------------------------------------------------------
	|
	| This determines which character set is used by default in various methods
	| that require a character set to be provided.
	|
	| See http://php.net/htmlspecialchars for a list of supported charsets.
	|
	*/
	public static $charset = 'UTF-8';
	
	/*
	|--------------------------------------------------------------------------
	| Content Security Policy
	|--------------------------------------------------------------------------
	| Enables the Response's Content Secure Policy to restrict the sources that
	| can be used for images, scripts, CSS files, audio, video, etc. If enabled,
	| the Response object will populate default values for the policy from the
	| ContentSecurityPolicy.php file. Controllers can always add to those
	| restrictions at run time.
	|
	| For a better understanding of CSP, see these documents:
	|   - http://www.html5rocks.com/en/tutorials/security/content-security-policy/
	|   - http://www.w3.org/TR/CSP/
	*/
	public static $CSPEnabled = false;
	
	/*
	|--------------------------------------------------------------------------
	| Database Engine on
	|--------------------------------------------------------------------------
	| Enable this to use MYSQL Database otherwise disable if you don't want to use database
	|
	*/
	public static $enabledDB = true;
	
	
	/*
	|--------------------------------------------------------------------------
	| Cache
	|--------------------------------------------------------------------------
	| Enable Caching in this application
	|
	*/
	public static $enabledCache = false;
	
}