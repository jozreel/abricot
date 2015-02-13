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
	
	public function includeCss($fileName, $media="")
	{
		
		if($media !==""){$media =  'media="'.$media.'"';}
		$data = '<link href="'.BASE_PATH.'/css/'.$fileName.'.css" rel="stylesheet" '.$media.'  />';
		return $data;
	}
	
	public function includeJavascript($fileName)
	{
	
		$data = '<script src="'.BASE_PATH.'/js/'.$fileName.'.js" "></script>';
		return $data;
	}
	
	function embed($link)
	{
		$ytarray=explode("/", $link);
		$ytendstring=end($ytarray);
		$ytendarray=explode("?v=", $ytendstring);
		$ytendstring=end($ytendarray);
		$ytendarray=explode("&", $ytendstring);
		$ytcode=$ytendarray[0];
	
	
		//echo $link;
		return '<iframe width="640" height="360" src="//www.youtube.com/embed/'.$ytcode.'?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>';
	}
	
}