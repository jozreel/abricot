<?php
class ab_html{
	
	public function escape_data($data)
	{
		mysql_real_escape_string($data);
	}
	
	public function link($text, $path, $prompt = false, $confirmMessage = "Are you sure?")
	{
		
		$path = str_replace(',', '-', $path);
		if($prompt)
		{
			$data = '<a href ="javascript:void(0);"onClick="javascritp:jumpTo(\''.BASE_PATH.'/'.$path.'\',\''.$confirmMessage.'\')">'.$text.'</a>';
		}
		else
			$bpath = trim(BASE_PATH, '/');
		    
			$data = '<a href ="'.$bpath.'/'.$path.'">'.$text.'</a>';
		return $data;
	}
}