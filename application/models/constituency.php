<?php
class Constituency extends ab_model
{
	public $id;
	public $name;
	function __construct()
	{
		parent::__construct();
		$this->fields_description['id'] = 'int ';
	}
}