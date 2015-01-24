<?php 
class Test extends ab_controller
{   
	function index($id=null)
	{
		//$tm = new TestModel();
		//$tm->saybla();
		
		
		$als = array();
		$als['title'] = 'this is an example of how to use array';
		$this->load->model('Party');
		$this->Party->id=$id;
		$this->Party->party_name='UWP';
		$this->Party->abbr='Workers';
		$this->Party->save();
		//$this->TestModel->saybla();
		$this->load->view('default/default',$als);
		$this->load->library('session');
		
		//$this->session->foo();
		//$this->load->view('default/sidebar');
		
	}
}