<?php
class ab_sql
{
	protected $result;
	protected $query;
	protected $table; 
	protected $describe = array();
    protected $extraconditions;
    protected $HO;
	protected $HM;
	protected $HMABTM;
	protected $page;
	protected $limit;
	
	private $db_driver;
	
	function __construct()
	{
		
	
		if(file_exist(BASE_LIB.'config'.DS.'database.php'))
		{
			require(BASE_LIB.'config'.DS.'database.php');
			if($active_schema !='')
				$active_driver = $db[$active_schema]['dbdriver'];
			if(file_exists(BASE_LIB.'db'.DS.$active_driver.'driver.php'))
			{
				require_once(BASE_LIB.'db'.DS.$active_driver.'driver.php');
				$drv_class_name = 'ab_'.$active_driver.'driver';
				if(!class_exists($drv_class_name))
				{
				$db_driver = new $drv_class_name();
				$db_driver->$dbconnect($db[$active_schema]);
				}
			}
		}
	}
	
	
}