<?php
class Party extends ab_model
{
	public $bla;
	protected  $has_many_belongs_to_many = array('Oders'=>'Orders');
	protected  $has_many = array('Candidates'=>'Candidates', 'Akas'=>'Akas');

	protected  $has_one = array('Constituency'=>'Constituency');
	public $id;
	public  $name;
	
	
	function __construct()
	{
		parent::__construct();
		$this->fields_description['id'] = 'int';
		$this->fields_description['constituencyid'] = 'int';
		$this->fields_description['name'] = 'varchar(4)';
	}
	
	
	function saybla()
	{
		$this->bla="say bla";
		
		
		
		echo $this->bla;
	}
}