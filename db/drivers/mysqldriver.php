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
		
		$this->connection_id = $this->mysqli_inst = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword,$this->dbport);
		$this->db_sellect($this->dbname);
	    //var_dump($this->connection_id);
	}
	
public function initialize()
	{
		
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
		//echo $query;
		$result = $this->mysqli_inst->query($query) or die($this->mysqli_inst->error);
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
	
}


