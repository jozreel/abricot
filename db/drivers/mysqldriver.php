<?php
class ab_mysqldriver extends ab_dbdriver 
{
    private $mysqli_inst;
	function __construct($params)
	{
		parent::__construct($params);
		/*if(!empty($this->dbport))
		{
			$this->dbhost .=':'.$this->dbport;
		}*/
		if($this->connection_id ==null)
		{
			//echo "connecting to db";
		$this->connection_id = $this->mysqli_inst = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword,$this->dbport);
		$this->db_sellect($this->dbname);
		}
	    //var_dump($this->connection_id);
	}
	
public function initialize()
	{
		$this->connection_id = $this->mysqli_inst = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword,$this->dbport);
		$this->db_sellect($this->dbname);
	}
	
	public function platform()
	{
		return parent::platform();
	}
	
	
	
	public function db_sellect($dbasename = '')
	{
		
		if($dbasename ==='')
		{
			$dbasename = $this->dbname;
		}
		
		
		if($this->mysqli_inst->select_db($dbasename))
		{
			
			$this->dbname =  $dbasename;
			return true;
		}
		return false;
	}
	
	public function dbdisconnect()
	{
		if($this->mysqli_inst->close($this->connection_id) )
		{
			return true;
		}
		else 
			return false;
	}
	
	public function save()
	{
		$fieldarray =$this->tablefields();
		
			
		$values ='';
		$valuesarray= array();
		$i=0;
		foreach ($fieldarray as $field)
		{
			
			if(isset($this->$field) && (!empty($field)))
			  array_push($valuesarray, $this->$field);
			else 
				unset($fieldarray[$i]);
		    
		    $i++;
				//array_push($valuesarray, '');
		
		}
		
		
		$comasepfields = implode(',', $fieldarray);
		foreach ($valuesarray as $val)
		{
			$values.='\''.mysqli_real_escape_string($this->connection_id, $val).'\',';
		}
		$values = substr($values, 0,-1);
		$query ='';
		if(isset($this->id)&& (!empty($this->id)))
		{
			$update ='';
			foreach($fieldarray as $field)
			{
				$update.=  $field. ' = \''.mysqli_real_escape_string($this->connection_id, $this->$field).'\',';
				
			}
			
			
			$update = substr($update, 0,-1);
			$query = 'update '. $this->table.' set '.$update. ' where id = \''.mysqli_real_escape_string($this->connection_id, $this->id).'\'';
			if(!empty($this->condition))
				$query .= 'where'.$this->condition;
			//echo $query;		
		}
		else {
			$query = 'insert into '.$this->table.' ('.$comasepfields.') values ('.$values.')';
			
		}
		
		$this->executequerystring($query);
	}
	
	//problem here will get duplicates if there are multiple tables with the same name. to be fixed
	public function tablefields()
	{
		$resarr = array();
		$sql_cols =$this->get_all_columns();
		$result = $this->mysqli_inst->query($sql_cols) or die($this->mysqli_inst->error);
		while($row =$result->fetch_row())
		   array_push($resarr, $row[0]);
		$result->free();
		return $resarr;
		
	}
	
	private function sqliexecquerytassocoarray($query)
	{
		$resarr = array();
		$sql_cols =$this->get_all_columns();
		$result = $this->mysqli_inst->query($this->connection_id, $sql) or die($this->mysqli_inst->error);
		while($row =$result->fetch_array($result, MYSQLI_ASSOC))
			array_push($resarr,$row);
		return $resarr;
			
	}
	
	private function executequerystring($query)
	{
		$result = $this->mysqli_inst->query($query) or die($this->mysqli_inst->error);
		
	}
	
	/**
	 * 
	 * @param unknown $resultset
	 * 
	 * This functiom gets an associative array from a resultset passed as the parameter
	 */
	public function  get_array($resultset)
	{
		$resultarray = array();
		while($row = $this->mysqli_inst->fetch_array($resultset, MYSQLI_ASSOC))
		{
		array_push($resultarray, $row);
		}
		return  $resultarray;
		
	}
	
	public function query($query)
	{
		$result;
		echo $query .'<br />';
	 if($this->mysqli_inst != null)
	 {
	 	$result = $this->mysqli_inst->query($query) or die($this->mysqli_inst->error);
	 }
		
	 return $result;
	}
	
	public function search()
	{
		$dataset = array();
		$fields = $this->tablefields();
		$whereclause= '\'1\'=\'1\' and ';
		$from = $this->table.' ';
	    $groupby = 'group by ';
	    $orderBY = 'order by ';
	    $singtable = ab_singular::singularize($this->table);
	    if(isset($this->groupby))
	    {
	    	$groupby .= $this->verifyfield($this->groupby);	   
	    	
	    }
	     else 
	     	$groupby .=$this->table.'.id';
	    if(isset($this->orderby))
	    {
	      $orderBY.= $this->verifyfield($this->orderby);	
	    }
	    else
	    	$orderBY .= $this->table.'.id';
		
		if($this->one_to_one && (isset($this->has_one) && !empty($this->has_one)))
		{
		    foreach ($this->has_one as $hasonealias => $hasonetable)
		    {
		    	$tableName = strtolower($hasonetable);
		    	$singone = ab_singular::singularize($tableName);
		    	$from .='left join '.$tableName. ' as '. $hasonealias;
		    	$from .= ' on '.$this->table.'.'.$singone.'id = '.$tableName.'.id ';
		    }
			
		}
		
		
		
		   // var_dump($this->has_many);
			if($this->one_to_many && (isset($this->has_many) && !empty($this->has_many)))
			{
				
				foreach ($this->has_many as $manyalias => $manytable)
				{
					
					$manytablename = strtolower($manytable);
					$singonetomany = ab_singular::singularize($manytablename);
					$from .='inner join '.$manytablename. ' as '.$manyalias;
					$from.=' on '. $this->table.'.id = '.$manyalias.'.'.$singtable.'id ';				
				}
			}
			
			if($this->many_to_many && (isset($this->has_many_belongs_to_many) && !empty($this->has_many_belongs_to_many)))
			{
				foreach ($this->has_many_belongs_to_many as $MtoM_alias => $MtoM_table)
				{
					
					$MtoM_table_name = strtolower($MtoM_table);
					$singmtom = ab_singular::singularize($MtoM_table_name);
					$tables = array($this->table, $MtoM_table_name);
					
				    sort($tables);
					//var_dump($tables);
					$joined_tables = implode('_', $tables);
					$MtoM_table_name = strtolower($MtoM_table);
					//echo $singtable;
					$from .= 'inner join '.$joined_tables.' on '.$this->table.' .id = '.$joined_tables.'.'.$singtable.'id ';
					$from.='inner join '.$MtoM_table_name.' as '.$MtoM_alias.' on '.$joined_tables.'.'.$singmtom.'id = '.$MtoM_alias.'.id ';				}
			}
			if(isset($this->id))
			{
			 $whereclause.= $this->table.'.id = \''.$this->mysqli_inst->escape_string($this->id).'\' and ';
			}
		$whereclause = substr($whereclause, 0, -4);
		$query = 'select * from '.$from. ' where '. $whereclause. ' '.$groupby. ' '. $orderBY;
		$res = $this->query($query);
		$qresultarray = $this->create_result_structure($res);
		$tmpresult = array();
		while($row = $res->fetch_row())
		{
			
			for($i=0; $i< $res->field_count;$i++)
			{
			 $tmpresult[$qresultarray['tables'][$i]][$qresultarray['fields'][$i]] = $row[$i];
		
			}
			array_push($dataset,$tmpresult);
		}
		//print_r($dataset);
		//echo $dataset[0]['party']['id'];
		return $dataset;
		
		
	}
	
	private function create_result_structure($result)
	{
		$resultset =array();
		$table_set = array();
		$field_set =array();
		//$field_ccount= $result->field_count;
		while($field =$result->fetch_field())
		{
			
			array_push($table_set, $field->table);
			array_push($field_set, $field->name);
		}
		$resultset['tables']=$table_set;
		$resultset['fields']=$field_set;
		return  $resultset;	
		
	}
	
	public function get_indexed_array()
	{
		$resultarray = array();
		while($row = $this->mysqli_inst->fetch_array($resultset, MYSQLI_NUM))
		{
			array_push($resultarray, $row);
		}
		return  $resultarray;
	}
	
	private function verifyfield($fieldname)
	{
		$ret;
		if(in_array($this->$fieldname, $fields))
		{
			$ret= $this->mysqli_inst->escape_string($this->$fieldname);
		}
	}
	
	public function createTables()
	{
	//	var_dump($this);
	if(!$this->check_if_table_exist(get_class($this)))
	         $this->query( $this->createTablequery());
	  $this->createOneToOneConstraints();
	  $this->createManyToManyConstraints();
	}
	
	public   function createTablequery()
	{
	//var_dump($this);
	//$name = get_class($tablenom);
	

	$pk1 = " ";
	$class = get_class($this);
	$quer = 'CREATE TABLE IF NOT EXISTS '.strtolower(ab_singular::singularize($class)).' (';
	$objarr =  get_object_vars($this);
	$field_desc =  $objarr['fields_description'];
	$trmd_arr =  array_map('trim', array_keys($field_desc));
	if(!in_array('id', $trmd_arr))
		array_push($field_desc, 'id');
	foreach ($field_desc as $field => $desc)
	{
		
		if($field == 'id')
		{
		
			$quer.= 'id int NOT NULL ,';
			$pk1 = 'PRIMARY KEY(id),';
		}
		else
		       $quer .= $field. ' '. $desc.' ,';
	}

	
	foreach ($this->has_one as $a => $b)
	{
	if(!(in_array(ab_singular::singularize(strtolower($b)).'id', array_map('trim', array_keys($this->fields_description)))))
	{
		$quer .= ab_singular::singularize(strtolower($b)).'id  int,';
		//echo $ref;
		//echo $quer;
		//echo '<br />'. strtolower($b).'id';
	}
	}
	//$otofk = $this->createOneToOneConstraints($quer);
	$quer .='  '.$pk1;
	$quer = substr($quer, 0, -1);
	//echo $quer;
	//$quer = $quer . $otofk;
	
    $quer.=' )  ';
 
	return $quer;
	//	$quer = 'create table if not exist '.$tablenom
	}
	
	
	public function check_if_table_exist($tablename)
	{
        //  echo $tablename. ' mo';
        
          $querpp = "SHOW TABLES LIKE '".trim(strtolower(ab_singular::singularize($tablename)))."'";
        
		$result = $this->query($querpp);
	//	var_dump($result);
		$tableExists = false;
		if($result->num_rows > 0)
			$tableExists = true;
	//	echo $result->num_rows;
		//echo $tableExists;
		return $tableExists;
	}
	
	public function check_column_exist($tablename, $fieldname)
	{
		$colExists = false;
	
		if($this->check_if_table_exist($tablename))
		{
		$quercc = "SHOW COLUMNS FROM ".trim(strtolower(ab_singular::singularize($tablename)))." LIKE '".trim($fieldname)."' ";
	//	echo $quercc;
		$resultcc = $this->query($quercc);
		//	var_dump($result);
	
		if($resultcc->num_rows > 0)
			$colExists = true;
	//	echo $resultcc->num_rows;
		//echo $tableExists;
		//echo $colExists;
		}
		return $colExists;
		
	}
	
	public function createManyToManyConstraints()
	{
		
		$classhasof = get_class($this);
		$foreign_keysMtoM = ' ';
		$on = ' ';
		foreach ($this->has_many as $aliasmany => $tablemany)
		{
			if(class_exists($tablemany))
			{
			if(!$this->check_if_table_exist($tablemany))
			{
				
					echo $tablemany;
					//echo $this->check_if_table_exist(strtolower(ab_singular::singularize($tablemany)));
					if(!$this->check_if_table_exist($tablemany))
					{
							
						$this->create_table_many($tablemany);
					}
			
			}
			
		     //maybe should check field desc also
		      	if(!isset($tablemany[ab_singular::singularize(strtolower($classhasof)).'id']))
		      	{
		      		if(!$this->check_column_exist($tablemany, ab_singular::singularize(strtolower($classhasof)).'id'))
		      		{
		      		        $queralt = 'ALTER TABLE ' . ab_singular::singularize(strtolower($tablemany)).'  ADD '.ab_singular::singularize(strtolower($classhasof)).'id int';
		      	          //  echo $queralt;
		      		         $this->query($queralt);
		      		}
		      	}
		      	if(!$this->get_constraint("fk_".ab_singular::singularize(strtolower($classhasof))."_".ab_singular::singularize(strtolower($tablemany))))
		      	{
				$foreign_keysMtoM .= " ALTER TABLE  ". ab_singular::singularize(strtolower($tablemany))."   ADD  CONSTRAINT fk_".ab_singular::singularize(strtolower($classhasof))."_".ab_singular::singularize(strtolower($tablemany))." FOREIGN KEY (". ab_singular::singularize(strtolower($classhasof)).'id) REFERENCES '. ab_singular::singularize(strtolower($classhasof)).'(id)';
			//	echo $foreign_keysMtoM;
				$this->query($foreign_keysMtoM);
		      	}
		      }
		}
		
	}
	
	
	public function createOneToOneConstraints()
	{
		$foreign_keys = "  ";
	
		foreach ($this->has_one as $alias => $table)
		{
			if(!$this->check_if_table_exist(ab_singular::singularize(strtolower($table))))
			{
				$a= null;
					if(class_exists($table))
					{
		
						$a = new $table;
					     $a->createTables();
					}
			}
			if($this->check_if_table_exist(ab_singular::singularize(strtolower($table))))
			{
				$classtabne = get_class($this);
				if(!isset($classtabne[ab_singular::singularize(strtolower($table)).'id']))
				{  
					if(! $this->check_column_exist(ab_singular::singularize(strtolower(get_class($this))),  ab_singular::singularize(strtolower($table)).'id'))
					{
					$queralt = 'ALTER TABLE ' . ab_singular::singularize(strtolower(get_class($this))).'  ADD '.ab_singular::singularize(strtolower($table)).'id int';
					$this->query($queralt);
					}
				}
				if(!$this->get_constraint("fk_". ab_singular::singularize(strtolower($table))."_".strtolower(ab_singular::singularize(get_class($this)))))
				{
		               $foreign_keys .= "ALTER TABLE " .strtolower(ab_singular::singularize(get_class($this)))." ADD  CONSTRAINT fk_". ab_singular::singularize(strtolower($table))."_".strtolower(ab_singular::singularize(get_class($this)))." FOREIGN KEY( ". ab_singular::singularize(strtolower($table)).'id)  REFERENCES '. ab_singular::singularize(strtolower($table)).'(id)';
		               $this->query($foreign_keys);   
				}
		                  
			}
						
			}
			
		
		return $foreign_keys;
	}
	
	public function  create_table_many($tablename)
	{
		$classhasoffk = get_class($this);
		if(class_exists($tablename, false))
		{
		//	echo $tablename.'lplp';
	     $mod = new $tablename;
	     
		 $fieldsc = $mod->fields_description;
		 $fldtrm = array_map('trim', array_keys($fieldsc));
		 if(in_array('id',  $fldtrm) ==false)
		 {
		 
		 	array_push($fields, 'id');
		 }
		
	
			//$newtable = $abinst->$tablename;
		    
			$quermm = 'CREATE TABLE IF NOT EXISTS '.strtolower(ab_singular::singularize($tablename)).' (';
            $pk = ' ';
			foreach ($fieldsc as $prop =>$value)
			{
				
				if($prop == 'id')
				{
				
					$quermm.= 'id int NOT NULL ,';
					$pk = 'PRIMARY KEY(id),';
				}
				else
			    	$quermm .= $prop. ' '. $value.' ,';
			}
			
			foreach ($this->has_one as $aa => $bb)
			{
				if(!(in_array(ab_singular::singularize(strtolower($bb)).'id', array_map('trim', array_keys($this->fields_description)))))
				{
					$quermm .= ab_singular::singularize(strtolower($b)).'id  int,';
					//echo $ref;
					//echo $quer;
					//echo '<br />'. strtolower($b).'id';
				}
			}
		
	
		$quermm .='  '.$pk;
		
		//$fk = " FOREIGN KEY( " .ab_singular::singularize(strtolower($classhasoffk)).'id) REFERENCES '. ab_singular::singularize(strtolower($classhasoffk)).'(id) ';
	  //  $quermm = $quermm.$fk;
	    $quermm = substr($quermm, 0, -1);
	    $quermm .=')';
	//   echo $quermm;
	   $this->query($quermm);
	   $mod->createOneToOneConstraints();
	   $mod->createManyToManyConstraints();

		}
	}
	
	
	public function  ab_model_create_table($tablename)
	{
		$classhasoffk = get_class($this);
		if(class_exists($tablename, true))
		{
			$mod = new $tablename;
	
			$fieldsc = $mod->fields_description;
			$fldtrm = array_map('trim', array_keys($fieldsc));
			if(in_array('id',  $fldtrm) ==false)
			{
					
				array_push($fields, 'id');
			}
	
			$mod->createManyToManyConstraints();
			//$newtable = $abinst->$tablename;
	
			$quermm = 'CREATE TABLE IF NOT EXISTS '.strtolower(ab_singular::singularize($tablename)).' (';
			$pk = ' ';
			foreach ($fieldsc as $prop =>$value)
			{
	
				if($prop == 'id')
				{
	
					$quermm.= 'id int NOT NULL ,';
					$pk = 'PRIMARY KEY(id),';
				}
				else
					$quermm .= $prop. ' '. $value.' ,';
			}
				
			 
	
	
			$quermm .='  '.$pk;
	
			$quermm = substr($quermm, 0, -1);
			$quermm .=')';
			//  echo $quermm;
			$this->query($quermm);
		}
	}
	
	public function get_constraint($constname)
	{
		$constQ = "select CONSTRAINT_NAME from information_schema.table_constraints where constraint_schema ='".$this->dbname."'  and CONSTRAINT_NAME= '".$constname."'";
		//echo $constQ;
		$constRes = $this->query($constQ);
		if($constRes->num_rows > 0)
		   return true;
		else 
		  return false;
	
	}
}


