<?php
class TestModel extends ab_Model
{
	public $bla;
	
	function saybla()
	{
		$this->bla="say bla";
		echo $this->bla;
	}
}