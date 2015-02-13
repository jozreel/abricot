<?php
class ab_controller
{
	protected $_controller;
	protected $_action;
	protected $_template;
	protected $current_ab_controller;
	public static $ab_instance;
	public $output;
	private $noRender;
	private $dbdriver;
	public  $load;
	
	function  __construct() 
	{
		//$this->load_dbdriver();
		self::$ab_instance = $this;
		//$this->_controller = ucfirst($controller);
		//$this->_action = $action;
		//$model = ucfirst(singularize($controller)).'Model'
		
		
		foreach (ab_loaded() as $key => $class)
		{
			//echo "tyuoto";
			$this->$key = ab_load_class($class);
			//echo ab_load_class($class)->ab_display_output();
		}
		
		$this->load = new ab_loadable();
		$this->noRender = 0;
		//$this->output= new ab_output();
		//$this->current_ab_controller = get_class($this);
		
		
	}
	
	public static function & get_ab_instance()
	{
		return self::$ab_instance;
	}
	// place this in model.class constructor instead.
	
	
	function __destruct()
	{
		$this->output->render($this->noRender);
	}
	
	public function writeModel()
	{
		$models = array();
		$models = $this->load->getLoadedModels();
		foreach ($models as $model)
		{
			
			//var_dump($this->$model);
			$this->$model->createTables();
		}
	}
}
