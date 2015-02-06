<?php
abstract class ab_dbdriver
{
	
	protected $dbhost;
	protected $dbuser;
	protected $dbname;
	protected $dbpassword;
	protected $dbport;
	protected $dbdriver = 'mysqli';
	protected $autoinit = true;
	protected $connection_id = false;
	public static $db_instance = false;
	protected $condition;
	protected $table;
	protected $one_to_one = false;
	protected $one_to_many = false;
	protected $many_to_many = false;
	protected $has_one = array();
	protected $has_many = array();
	protected $has_many_belongs_to_many= array();
	protected $orderby;
	protected $groupby;
	protected $order='ASC';
	function __construct($params)
	{
		
	    $this->table = strtolower(get_class($this));
		self::$db_instance = $this;
		if(is_array($params))
		{
			foreach ($params as $key=>$val)
			{
				$this->$key = $val;
				
			}
		}
	    
	}
	
	
	
	//abstract function dbconnect();
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
	
	public static function get_db_instance()
	{
		return  self::$db_instance;
	}
	
	public abstract  function  save();
	
	
	public function get_all_columns()
	{
		$sql = "select distinct column_name from INFORMATION_SCHEMA.COLUMNS where table_name ='".$this->table."'";
		return $sql;
		
	}
	
	public abstract function get_array($resultset);
	public abstract function get_indexed_array();
	public abstract function query($query);
	public abstract function search();
	public  function showHasOne(){$this->one_to_one = true;}
	public  function showhasMany(){$this->one_to_many = true;}
	public  function showManyToMany(){$this->many_to_many = true;}
	
}

