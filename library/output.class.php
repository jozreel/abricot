<?php
class ab_output
{
	
	
	protected $output_data;
	protected $ab_ob_level;

	

	function ab_append_output($output, $flush=false)
	{
		
		
		if(empty($this->output_data))
		{
			$this->output_data = $output;
			
		}
		else {
			if(!$flush)
			    $this->output_data .=$output;
			else 
				$this->output_data = $output;
		}
		
		return $this;
	}
	
	public function create_output($viewf,  $vars=array(), $flush=false)
	{
	//	$d = file_get_contents($viewf);
		$this->ab_ob_level = ob_get_level();

		ob_start();
		include($viewf);
		$buffer ='';
		if(ob_get_level() > $this->ab_ob_level +1)
		{
		
		
			ob_end_flush();
		}
		else
		{
			$buffer = ob_get_contents();
		
			@ob_end_clean();
		}
	  $pattern = '/\{(\w+)\}/';
	     $output = preg_replace_callback($pattern,function ($matches)  use ($vars){
	///	global $template;
		$repvars =  $vars;
		return $repvars[$matches[1]];
	
	
	}, $buffer);
	
	 return $output;

	  
	}
	
	
	public function render($donotrender = 0){
		global $template;
		
		if(isset($template['templatable'])&& $template['templatable']==true)
		{
			$tmp = new ab_template();
			$tmp->render_template($this->output_data);
		}	
		else{	
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
	}
	
	
	public function ab_display_output()
	{
		//get the output;
		//ob_start();
		
		echo $this->output_data;
	}
}