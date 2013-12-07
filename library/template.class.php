<?php
class ab_template
{
	function render_template($data)
	{ 
		global $template;
		//print_r($template);
		$lada = file_get_contents(VIEW_PATH.DS.'default/default.php');
		$pattern = '/\{([A-Za-z]+)\}/';
		//$output = preg_replace($pattern, '\$$1', $lada);
		
		
		extract($template);
		extract($regions);
		$output = preg_replace($pattern, '\$$1', $lada);
		$output = preg_replace('|{title}|', $title, $lada);
		var_dump($output);
		echo $output;
		
		//echo $subject;
	}
}