<?php
require_once(ROOT.DS.'config'.DS.'config.php');
require_once(ROOT.DS.'config'.DS.'routing.php');
require_once(ROOT.DS.'config'.DS.'template.php');
require_once (ROOT . DS . 'library' . DS . 'common.php');

//$ab_loaded_classes = array();
//echo "yes";

//create a load class function ;
$out =  ab_load_class('output','library');
spl_autoload_register('ab_autoload');
ab_compress_output();

//todo: initialize cache;

//todo: initialize inflect;

ab_set_reporting();
ab_remove_magic_quotes();
ab_unregister_globals();
ab_main();
//$CoN = & ab_load_class('controller','library');
