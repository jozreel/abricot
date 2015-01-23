<?php
abstract class ab_dbdriver
{
	
	protected $dbhost;
	protected $dbuser;
	protected $dbname;
	protected $dbpassword;
	protected $dbport;
	protected $dbdriver = 'mysql';
	protected $autoinit = true;
	protected $connection_id = false;
	
	
	function __construct($params)
	{
		if(is_array($params))
		{
			foreach ($params as $key=>$val)
			{
				$this->$key = $val;
			}
		}
	}
	
	abstract function dbconnect()
	{
		
	}
	
	public function initialize()
	{
		if($this->connection_id !=false)
		{
			return true;
		}
		$this->connection_id = $this->db_connect();
	}
	
	public function platform()
	{
		return $this->dbdriver;
	}
	

	
}