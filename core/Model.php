<?php

class Model {
	
	public $db;
	public $security;
	
	public function __construct() {
		
		$this->security = new Security();
		$this->db = new DatabaseConfig();
		
	}
	
}