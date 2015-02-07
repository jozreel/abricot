<?php

/** check if environment is in development mode, if so turns on display errors if not turns off display errors and logs themn in the logs folder **/

function ab_set_reporting()
{
	if(DEVELOPMENT_ENVIRONMENT == true)
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');

	}
	else
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 'Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
	}

}

/** checks for majic quotes and remove them if found **/

function ab_stripslashes_deep($value)
{
	$value = is_array($value) ? array_map(ab_stripslashes_deep, $value) :stripslashes($value);
	return  $value;
}

function ab_remove_magic_quotes()
{
	if(get_magic_quotes_gpc())
	{ 
		if(!empty($_POST))
			$_POST = ab_stripslashes_deep($_POST);
		if(!empty($_GET))
			$_GET = ab_stripslashes_deep($_GET);
		if(!empty($_COOKIE))
			$_COOKIE = ab_stripslashes_deep($_COOKIE);
	}
	
}

/** Undo register globals if regidter_globals is on < php 5.4 **/
function ab_unregister_globals()
{
	if(ini_get('register_globals'))
	{
		$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
		foreach ($array as $value)
		{
			foreach($GLOBALS[$value] as $key => $var)
			{
				if($var === $GLOBALS[$key])
					unset($GLOBALS[$key]);
			}

		}
	}
}

/** replace special html characters with html entities  **/

function ab_tohtml_entities($value)
{
	$value = is_array($value) ? array_map(ab_tohtml_entities, $value): htmlentities($value);
	return $value;
}

function ab_add_html_ent()
{
	if(!empty($_POST))
		$_POST = ab_tohtml_entities($_POST);
	if(!empty($_GET))
		$_GET = ab_tohtml_entities($_GET);
	if(!empty($_COOKIE))
		$_COOKIE = ab_tohtml_entities($_COOKIE);
}




function  ab_load_class($class, $dir="library")
{
	
	$prefix = 'ab_';
	$name = "";
    static $loaded_classes = array();
    
    if(isset($loaded_classes[$class]))
    { 
    	return $loaded_classes[$class];
    }
    
    foreach(array(APP_PATH,BASE_PATH,BASE_LIB) as $path)
    {
    
    	
    	if(file_exists($path.$dir.DS.$class.'.php'))
    	{    
    		$name = $prefix.$class;
    		if(class_exists($name, false)===false)
    		{
    			require_once($path.$dir.DS.$class.'.php');
    		}
    		break;
    		
    	}
    	if(file_exists($path.$dir.DS.$class.'.class.php'))
    	{
    		
    		$name = $prefix.$class;
    		if(class_exists($name, false)===false)
    		{
    			require_once($path.$dir.DS.$class.'.class.php');
    		}
    		break;
    	
    	}
    }
    if(empty($name))
    {
    	ab_display_err("UNABlE TO LOCATE SPECIFIED FILE");
    	//return;
    	exit('EXIT_UNKNOWN_CLASS');
    }
    if(file_exists(APP_PATH.DS.$dir));
    
    ab_loaded($class);
   
    $loaded_classes[$class] = new $name();
   // print_r($loaded_classes);
    return  $loaded_classes[$class];
    
}


function & ab_loaded($class = "")
{
	static $is_loaded = array();
	if($class !== '')
	{
	   $is_loaded[strtolower($class)]= $class;
	}
	//print_r($is_loaded);
	return $is_loaded;
}






/** call to perform action via controller class and render page **/

function ab_doaction($controller, $action, $querystr=null, $render=0)
{
	$ab_controller_name= ucfirst($controller);
	$ab_controller_child = new $ab_controller_name($controller,action);
	$ab_controller_child->render = $render;
	return call_user_func_array(array($ab_controller_child,$action),$querystr);


}

/** This function rewrites the url replacing matched parterns in the routing array with the replacement value **/
function ab_route_url($url)
{
	global $routing;
	foreach ($routing as $partern => $replacement)
	{
		if(preg_match($partern, $url))
		{
			return	prreg_replace($partern, $replacement, $url);
		}
	}
	return $url;
}

/** compreses output to send to browser **/
function ab_compress_output()
{
	$modules = apache_get_modules();
	//var_dump($modules);
if(ini_get('zlib.output_compression') == 1 ||ini_get('zlib.output_compression_level') > 0 
    	||ini_get('output_handler') == 'ob_gzhandler' )
	return;

else if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip'))
	{
		      //$ob = ob_deflatehandeler();
			  
		         ob_start('ob_gzhandler');
		         //var_dump($modules);
		          
	}
else
	{
		
		ob_start();
		
	}
}

/** autoload the classes that are requires for abricot framework **/

function ab_autoload($class)
{
	//$classs = (strpos('c', class_prefix))?'a':'b';
	//echo $class;
	$class = ((strpos($class, class_prefix))!== false)?(str_replace(class_prefix, '',$class)):$class;
	if(file_exists(ROOT.DS.'library'.DS.strtolower($class).'.class.php'))
	{
		require_once(ROOT.DS.'library'.DS.strtolower($class).'.class.php');
	}
	else if(file_exists(ROOT.DS.'application'.DS.'controllers'.DS.strtolower($class).'.php'))
	{
		require_once(ROOT.DS.'application'.DS.'controllers'.DS.strtolower($class).'.php');
	}
	else if(file_exists(ROOT.DS.'application'.DS.'views'.DS.strtolower($class).'.php'))
	{
		require_once(ROOT.DS.'application'.DS.'views'.DS.strtolower($class).'.php');
	}
	else if(file_exists(ROOT.DS.'application'.DS.'models'.DS.strtolower($class).'.php'))
	{
		//echo $class;
		require_once(ROOT.DS.'application'.DS.'models'.DS.strtolower($class).'.php');
	}
	else if(file_exists(ROOT.DS.'db'.DS.'drivers'.DS.strtolower($class).'.php'))
	{
		//echo $class;
		require_once(ROOT.DS.'db'.DS.'drivers'.DS.strtolower($class).'.php');
	}

}


function ab_display_err($error)
{
	$err = $error;
}




function ab_main()
{
	global $url;
	global $default;
	global $err;

	$query_string = array();
	if(!isset($url))
	{
		$controller = $default['controller'];
		$action = $default['action'];
		
	}
	else{
		$url = ab_route_url($url);
		
		$urlstring_array = array();
		$urlstring_array =explode("/", $url);
		$controller = $urlstring_array[0];
		array_shift($urlstring_array);
		if(isset($urlstring_array[0]))
		{
			$action = $urlstring_array[0];
			array_shift($urlstring_array);
		}
		else
			$action = 'index';
		$query_string = $urlstring_array;

	}

	$ab_controller_name = ucfirst($controller);
	//echo $controller;
	
	
	$ab_child_controller = new $ab_controller_name();
	//$ab_output_inst = new ab_output();
	//$ab_child_controller->output  = $ab_output_inst;
    
	if(method_exists($ab_controller_name, $action))
	{
		if(method_exists($ab_controller_name, 'beforeAction'))
			call_user_func_array(array($ab_child_controller,'beforeAction',$query_string));
		call_user_func_array(array($ab_child_controller,$action), $query_string);
		if(method_exists($ab_controller_name, 'afterAction'))
			call_user_func_array(array($ab_child_controller,'afterAction'), $query_string);
	       
	}
	else
	{
		$err = "Cannot find requested page";
	}

}









