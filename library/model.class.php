<?php
global $db;
		if(isset($db['dbdriver']) && !empty($db))
		{			
			if($db['dbdriver']==='mysqli')
			{
				class generalMOdel extends  ab_mysqldriver
				{
					function __construct()
					{
						global $db;
						parent::__construct($db);
					}
				}
				
				       
		  }
		}
		
		class ab_model extends generalMOdel
		{
			protected  $fields_description;
			function __construct()
			{
				parent::__construct();
				$this->fields_description  = array();
			}
			
			
		}
		
	
	
	//extend this classs to tghe sql querry one and use optional parrameters for the constructor
	//pass the defaault connfig database values as default paraneters;
	//therefore when instantiated if no params passed in load views it will use default;
	
