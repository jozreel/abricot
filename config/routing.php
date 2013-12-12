<?php
/** this array variable sets the parterns and replacement  to redirect urls such as abricot.com/admin/items/view to abricot.com/admin/items_delete **/
$routing = array('/admin\/(.*?)\/(.*?)\/(.*)/' => 'admin/$1_$2/$3');

/** sets the default controller and action for the abricot application **/
$default['controller'] = 'test';
$default['action'] = 'index';