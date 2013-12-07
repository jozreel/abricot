<?php
class ab_output
{
	
	
	protected $output_data;
	
	function ab_append_output($output)
	{
		if(empty($this->output_data))
		{
			$this->output_data = $output;
			
		}
		else {
			$this->output_data .=$output;
		}
		
		return $this;
	}
	
	
	public function render($donotrender = 0){
		
		if(file_exists(ROOT.DS.'application'.DS.'views'.DS.'header.php') && $donotrender==0)
		{
			require_once(ROOT.DS.'application'.DS.'views'.DS.'header.php');
		}
	     $this->ab_display_output();
		if(file_exists(ROOT.DS.'application'.DS.'views'.DS.'footer.php') && $donotrender ==0)
		{
			require_once(ROOT.DS.'application'.DS.'views'.DS.'footer.php');
		}
	}
	
	
	public function ab_display_output()
	{  
		echo $this->output_data;
	}
}