<?php
class ab_template
{
	
	public static function set_vals($matches)
	{
		global $template;
		
		$regions =  $template['regions'];
		
		return $regions[$matches[1]];
		
	}
	
	function render_template($data)
	{ 
		
	
		$pattern = '/\{(\w+)\}/';
		
		
		
	
		$output = preg_replace_callback($pattern,"self::set_vals", $data);
		
		
	
		
		echo $output;
	}
	
	
 
}