<?php
class ab_loadable
{
		protected $ab_loaded_classes = array();
		protected $ab_view_path = array(VIEW_PATH);
		protected $ab_library_path;
		protected $ab_models = array();
		protected $ab_model_path = array(MODEL_PATH);
		protected $ab_controller_inst;
		protected $ab_ob_level;
		protected $ab_cached_vars = array();
	public function __construct()
	{
		$this->ab_ob_level = ob_get_level();
	}
	
	public function view($view,$vars=array(), $return = FALSE)
	{
		return $this->ab_load(array('ab_view'=>$view, 'ab_vars'=>$this->ab_convert_obj_to_array($vars),'ab_return'=>$return));
	}
	
	public function model($model, $name="", $db = FALSE)
	{
		if(empty($model))
		{
			return;
		}
		else if(is_array($model))
		{
			foreach ($model as $key=>$val)
			{
			  is_int($key)? model($val,'',$db):model($key,$val,$db);
			}
			return;
		}
		$path = "";
		
		if($ds = strpos($model,'/')!== false)
		{
			$path = substr($model,0,++$ds);
			$model = substr($model,$ds);
		}
		if(empty($name))
		{
			$name=$model;
		}
		if(in_array($name,$this->ab_models, TRUE))
		{
			return;
		
		}
		$ABC = & ab_Controller::get_ab_instance();
	//	echo $ABC->namers;
		if(isset($ABC->$name))
		{
			ab_display_err("The model you are trying to load is already in use");
		}
		if($db !== FALSE)
		{
			if($db === TRUE)
			{
				$db = '';
			}
			//load database here.
		}
		foreach ($this->ab_model_path as $mod_path)
		{
			//echo $this->ab_model_path[0];
			if(!file_exists($mod_path.$path.strtolower($model).'.php'))
			{   
				continue;
			}
			require_once($mod_path.$path.strtolower($model).'.php');
			$ABC->$name = new $model();
			//echo $name;
			
			$this->ab_models[]= $name;
			return;
		}
		
		ab_display_err("Could not load the modle specified".$model);
		
		
	}
	
	
	public function ab_convert_obj_to_array($obj)
	{
		return is_object($obj)?get_object_vars($obj):$obj;
	}
	
	public function loadded($class)
	{
		return aray_search(ucfirst($class),$this->ab_loaded_classes,TRUE);
	}
	
	public function ab_load($ab_data)
	{
		foreach(array('ab_view','ab_vars','ab_path','ab_return') as $ab_val)
		{
			if(isset($ab_data[$ab_val]))
				$$ab_val = $ab_data[$ab_val];
			else $$ab_val = FALSE;
		}
		$file_exist = false;
		if(is_string($ab_path)&&$ab_path !=='')
		{
			$ab_ex = explode(DS, $ab_path);
			$ab_file = end($ab_ex);
		}
		else
		{
			if($ds = strpos($ab_view,'/')!== false)
			{
				
				$the_path = substr($ab_view,0,++$ds);
				$view = substr($ab_view,$ds);
				$this->ab_view_path[] = VIEW_PATH.$the_path;
				$ab_ext = pathinfo($view, PATHINFO_EXTENSION);
				$ab_file = ($ab_ext=='')? $view.".php":$view;
				
			}
			else{
				
			$ab_ext = pathinfo($ab_view, PATHINFO_EXTENSION);
			$ab_file = ($ab_ext=='')? $ab_view.".php":$ab_view;
			}
			foreach($this->ab_view_path as $view_path)
			{  
				if(file_exists($view_path.$ab_file))
				{  
					$ab_path = $view_path.$ab_file;
					$file_exist = true;
					break;
				}
			}
			
		}
		if(!$file_exist && !file_exists($ab_path))
			ab_display_err("Could not load the file specified".$ab_file);
		
		$ABC = & ab_Controller::get_ab_instance();
		foreach(get_object_vars($ABC) as $ab_property => $ab_value)
		{
			if(!isset($this->$ab_property))
				$this->$ab_property = & $ABC->ab_property;
		}
		
		if(is_array($ab_vars))
		{
			$this->ab_cached_vars = array_merge($this->ab_cached_vars, $ab_vars);
		}
		extract($this->ab_cached_vars);
		//print_r($this->ab_cached_vars);
		ob_start();
		
		include($ab_path);
		
	    if($ab_return)
		{
			
			$buffer = ob_get_contents();
			//print_r($buffer);
			@ob_end_clean();
			return $buffer;
		}
		
		
		
	//	echo ob_get_level();
		if(ob_get_level() > $this->ab_ob_level +1)
		{
			
			ob_end_flush();
		}
		else 
		{
		
			//$buff = ob_get_contents();
			//
			$ABC->output->ab_append_output(ob_get_contents());
			@ob_end_clean();
			
			//echo $buff;
			
			
		}
			
	}
		
}