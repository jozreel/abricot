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
		var_dump($fieldarray);
		
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
				$update.=  '\''.mysqli_real_escape_string($this->connection_id, $this->$field).'\',';
			}
			
			
			$update = substr($update, 0,-1);
			$query = 'update '. $this->table.'set'.$update;
			if(!empty($this->condition))
				$query .= 'where'.$this->condition;
		
		}
		else {
			$query = 'insert into '.$this->table.' ('.$comasepfields.') values ('.$values.')';
			if(!empty($this->condition))
				$query.='where'.$this.condition;
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
		$result = $this->mysqli_inst->query($query);
		return $result;
	}
	
}


