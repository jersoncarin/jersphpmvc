<?php

class DatabaseConfig {
	
    protected $connection;
	protected $query;
    protected $show_errors = TRUE;
    protected $query_closed = TRUE;
	public $query_count = 0;

	public function __construct() {
		
		$default = Database::$db;
		
		$dbhost = $default["hostname"];
		$dbuser = $default["username"];
		$dbpass = $default["password"];
		$dbname = $default["database"];
		$charset = $default["charset"];
		$port = $default["port"];
		
		if(Config::$enabledDB == true) {
		
			$this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
			if ($this->connection->connect_error) {
				$this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
			}
			$offset = DatabaseConfig::getOffset($default["timezone"]);
			$this->connection->query("SET time_zone = '$offset' ");
			$this->connection->set_charset($charset);
		
		}
	}

	public static function getOffset($timezone) {
		date_default_timezone_set($timezone);
		$now = new DateTime();
		$mins = $now->getOffset() / 60;
		$sgn = ($mins < 0 ? -1 : 1);
		$mins = abs($mins);
		$hrs = floor($mins / 60);
		$mins -= $hrs * 60;
		return sprintf("%+d:%02d",$hrs * $sgn, $mins);
	}
	
    public function query($query) {
        if (!$this->query_closed) {
            $this->query->close();
        }
		if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
				$types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
					if (is_array($args[$k])) {
						foreach ($args[$k] as $j => &$a) {
							$types .= $this->_gettype($args[$k][$j]);
							$args_ref[] = &$a;
						}
					} else {
	                	$types .= $this->_gettype($args[$k]);
	                    $args_ref[] = &$arg;
					}
                }
				array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
           	if ($this->query->errno) {
				$this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
           	}
            $this->query_closed = FALSE;
			$this->query_count++;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
        }
		return $this;
    }
    
    public function escape( $str ) {
    	return $this->connection->real_escape_string($str);
    }

	public function fetchAll($callback = null) {
	    $params = array();
        $row = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback != null && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ($value == 'break') break;
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
		return empty($result) || !isset($result) ? false : $result;
	}
	
	public function insert($tbl, $data,$callback = null)
	{
		$insert = "INSERT INTO `$tbl`(";
		foreach($data as $col => $val) {
	     if($col != $callback)
		   $insert .= $col . ",";
		 }
		$insert = ($insert[strlen($insert)-1] == ",") ? substr_replace($insert, "", strlen($insert)-1) : $insert;
		$insert .= ") VALUES(";
		
		foreach($data as $col => $val) {
		  if($col != $callback) {
			$val = is_null($val) ? "" : $val;
		    $insert .= "'$val',";
		  }
		}
		$insert = ($insert[strlen($insert)-1] == ",") ? substr_replace($insert, "", strlen($insert)-1) : $insert;
		$insert .= ")";
		$res = $this->connection->query($insert);
		$this->query->close();
        $this->query_closed = TRUE;
		return $res;
	}

	public function fetchArray() {
	    $params = array();
        $row = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
		while ($this->query->fetch()) {
			foreach ($row as $key => $val) {
				$result[$key] = $val;
			}
		}
        $this->query->close();
        $this->query_closed = TRUE;
		return empty($result) || !isset($result) ? false : $result;
	}

	public function close() {
		return $this->connection->close();
	}

    public function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

	public function affectedRows() {
		return $this->query->affected_rows;
	}

    public function lastInsertID() {
    	return $this->connection->insert_id;
    }

    public function error($error) {
        if ($this->show_errors) {
            exit($error);
        }
    }
    
    public function errors() {
    	return $this->connection->errors;
    }

	private function _gettype($var) {
	    if (is_string($var)) return 's';
	    if (is_float($var)) return 'd';
	    if (is_int($var)) return 'i';
	    return 'b';
	}
}