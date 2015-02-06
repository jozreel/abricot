<?php
class Party extends ab_model
{
	public $bla;
	protected  $has_many_belongs_to_many = array('Oders'=>'Orders');
	protected  $has_many = array('Candidates'=>'Candidates');
	
	function saybla()
	{
		$this->bla="say bla";
		
		echo $this->bla;
	}
}