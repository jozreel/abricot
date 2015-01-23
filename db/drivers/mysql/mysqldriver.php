<?php
class ab_mysqldriver extends ab_db_driver
{

	function __construct($params)
	{
		parent::__construct($params);
		if(!empty($this->dbport))
		{
			$this->dbhost .=':'.$this->dbport;
		}
	}
	
public function initialize()
	{
		
	}
	
	public function platform()
	{
		return parent::platform();
	}
	
	public function  dbconnect()
	{
		$this->connection_id = mysql_connect($this->dbhost, $this->dbuser,$this->dbpassword);
		
	}
	
	public function db_sellect($dbasename = '')
	{
		if($dbasename ='')
		{
			$dbasename = $this->dbname;
		}
		
		if(mysql_select_db($dbasename, $this->connection_id))
		{
			$this->dbname =  $dbasename;
			return true;
		}
		return false;
	}
	
	public function dbdisconnect()
	{
		if(mysql_close($this->connection_id))
		{
			return true;
		}
		else 
			return false;
	}
}