<?php 
class Test extends ab_Controller
{   
	function index()
	{
		//$tm = new TestModel();
		//$tm->saybla();
		$als = array();
		$als['title'] = 'this is an example of how to use array';
		$this->load->model('TestModel');
		//$this->TestModel->saybla();
		$this->load->view('default/default',$als);
		$this->load->view('default/sidebar');
		
	}
}