<?php
class ab_singular
{
	public static function singularize($word)
	{
		
		$rules = array(
				'ss' => false,
				'os' => 'o',
				'ies' => 'y',
				'xes' => 'x',
				'oes' => 'o',
				'ies' => 'y',
				'ves' => 'f',
				's' => '');
		$string= $word;
		foreach ($rules as $wordend =>$Singular)
		{
			$len = strlen($wordend);
		
			 $str = substr($word, -$len);
			 if($str === $wordend)
			 {
			   $string =  substr($word, 0,-$len);
			   $string .=$Singular;
			   break;
			 }
		}
		return  $string;
	} 
}