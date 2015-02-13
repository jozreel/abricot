<?php
class Candidates extends ab_model
{
	public $bla;
	//protected  $has_many_belongs_to_many = array('Oders'=>'Orders');
	protected  $has_one = array('Constituency'=>'Constituency');
	public $id;
	public  $name;
    public $constid;

	function __construct()
	{
		parent::__construct();
		$this->fields_description['id'] = 'int ';
		//	$this->fields_description['id'] = 'int(5)';
		$this->fields_description['name'] = 'varchar(4)';
		$this->fields_description['partyid'] = 'int';
		//$this->fields_description['constid'] = 'varchar(4)';
	}


	function saybla()
	{
		$this->bla="say bla";



		echo $this->bla;
	}
}

