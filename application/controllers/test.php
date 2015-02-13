<?php 
class Test extends ab_controller
{   
	function index($id=2)
	{
		//$tm = new TestModel();
		//$tm->saybla();
		
		
		$als = array();
		$als['title'] = 'this is an example of how to use array';
		$this->load->model('Party');
		$this->load->model('Candidates');
		$this->Party->id=$id;
        $this->writeModel();
		//$this->Party->party_name='LABA';
		//$this->Party->abbr='DLP';
		//$this->Party->save();
		//$this->Party->showhasMany();
		//$this->Party->showManyToMany();
		//$this->Party->search();
		//$this->TestModel->saybla();
		$this->load->view('abwisiwig/abwisiwig',$als);
		//$this->load->library('session');
		
		//$this->session->foo();
		//$this->load->view('default/sidebar');
		
	}
	
	function top($var=0){
		echo "testing 123";
	}
}