<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbord extends CI_Controller {

	public function index()
	{
		$this->load->view('dashbord/dashbord_v');
	}

	public function search()
	{
		$this->load->model('Employe_m');
		$SearchResult = $this->Employe_m->search();
		echo json_encode($SearchResult);
	}
	public function AddEmp()
	{
		$this->load->model('Employe_m');
		$result =  $this->Employe_m->AddEmploye();
		echo json_encode($result);		
	}
	public function showAllEmployee()
	{
		$this->load->model('Employe_m');
		$result = $this->Employe_m->showAllEmployee();
		echo json_encode($result);	
	}

	public function editEmployee()
	{
		$this->load->model('Employe_m');
		$result = $this->Employe_m->editEmployee();
		echo json_encode($result);
	}

	public function deleteEmployee()
	{
		$this->load->model('Employe_m');
		$result = $this->Employe_m->deleteEmployee();
		echo json_encode($result);
	}
}
