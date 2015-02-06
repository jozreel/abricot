<?php
/** Configurartion variables for abricot framework **/
define('DEVELOPMENT_ENVIRONMENT',true); /** weather or not abricot is beng used in a development environment. Set to false when deploying web app **/ 
define('DB_NAME', 'defaultdb'); /** The DB instance to which the system should connect **/
define('DB_TYPE', 'MYSQL');     /** The RDBMS the system will be using. current support for MYSQL. POSGRS will be addded in the near future **/
define('DB_HOST', 'localhost'); /** The Hostname or IP addrss of the database server **/
define('DB_PORT', '3306');        /** The port for db **/
define('DB_USER', 'dbuser');    /** The DB user for abricot **/
define('DB_PASSWORD', 'password'); /** The password for abricot DB **/
define('BASE_PATH', 'http://localhost/abricot'); /** The basepath for this application **/
define('PAGINATION_LIMIT', '5'); /** The maximum number to display per page when pagination used **/
define('class_prefix', 'ab_');
define('MODEL_PATH', ROOT.DS.'application'.DS.'models'.DS);
define('VIEW_PATH', ROOT.DS.'application'.DS.'views'.DS);
define("APP_PATH", ROOT.DS.'application'.DS);
define("BASE_LIB", ROOT.DS);
define('CORE_LIB', ROOT.DS.'library'.DS);
define('USR_LIB', APP_PATH.'library'.DS);