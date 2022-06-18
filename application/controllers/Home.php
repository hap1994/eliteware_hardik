<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Employee_model');
	}

	public function index()
	{
		$this->load->view('home_view');
	}

	public function employee_from()
	{
		$data['employeeId'] = $this->Employee_model->get_employee_code();

		$this->load->view('employee_from_view', $data);
	}

	public function employee_list(){
		// POST data
	    $postData = $this->input->post();
	    // Get data
	    $data = $this->Employee_model->getEmployees($postData);
	    echo json_encode($data);
	}


	public function employee_submit()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			//var_dump($_POST);
			//exit;

			$image = '';
			if(isset($_FILES["profile_img"]["name"]))  
			{  
				$config['upload_path'] = './assets/images';  
				$config['allowed_types'] = 'jpg|jpeg|png|gif'; 
				$config['max_size'] = 2048; 
				
				$this->load->library('upload', $config);  
				
				if(!$this->upload->do_upload('profile_img')) {  
				 	//echo $this->upload->display_errors(); 
				 	$returnData = [
						'result' => false,
						'error' => strip_tags($this->upload->display_errors())
					];
					echo json_encode($returnData);
				 	return false;
				} else {  
					$data = array('upload_data' => $this->upload->data());
				 	$image= $data['upload_data']['file_name']; 
				}  
	    	}  

	    	$insertData = [
				'emp_code' => $this->input->post('emp_code'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'joining_date' => $this->input->post('joining_date'),
				'profile_img' => $image,
				'created_at' => date('Y-m-d H:s:i')
			];

			$recordId = $this->Employee_model->save_upload($insertData);
			
			if($recordId>0) {
				$returnData = [
					'result' => true
				];
			} else {
				$returnData = [
					'result' => false
				];
			}
			
			echo json_encode($returnData);
		}
	}
}
