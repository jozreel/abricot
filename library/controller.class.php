<?php
class ab_Controller
{
	protected $_controller;
	protected $_action;
	protected $_template;
	protected $current_ab_controller;
	public static $ab_instance;
	public $output;
	private $noRender;
	
	function __construct($controller, $action)
	{
		
		self::$ab_instance = $this;
		//$this->_controller = ucfirst($controller);
		//$this->_action = $action;
		//$model = ucfirst(singularize($controller)).'Model'
		$this->noRender = 0;
		$this->load = new ab_loadable();
		//$this->output= new ab_output();
		//$this->current_ab_controller = get_class($this);
		
		
	}
	
	public static function & get_ab_instance()
	{
		return self::$ab_instance;
	}
	function __destruct()
	{
		$this->output->render($this->noRender);
	}
}
