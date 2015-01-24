<?php
class Party extends ab_model
{
	public $bla;
	
	function saybla()
	{
		$this->bla="say bla";
		echo $this->bla;
	}
}